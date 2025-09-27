<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Mission;
use App\Notifications\TaskAssigned;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For bénévoles, show only their activities; for organisateurs, show activities for their missions
        if (auth()->user()->type === 'admin') {
            $activites =  Activity::query()
                ->with(['mission', 'benevole.user', 'responsable'])
                ->get()
                ->groupBy('mission_id');
        } else if(auth()->user()->type === 'benevole') {
            $activites =  Activity::where('benevole_id', auth()->user()->benevole->id)
                ->with(['mission', 'benevole.user', 'responsable'])
                ->get()
                ->groupBy('mission_id');
        } else {
            $activites = Activity::whereHas('mission', fn($q) => $q->where('organisation_id', auth()->user()->organisation->id))
                ->with(['mission', 'benevole.user', 'responsable'])
                ->get()
                ->groupBy('mission_id');
        }

        // $activites = auth()->user()->type === 'benevole'
        //     ? Activity::where('benevole_id', auth()->user()->benevole->id)
        //         ->with(['mission', 'benevole.user', 'responsable'])
        //         ->get()
        //         ->groupBy('mission_id')
        //     : Activity::whereHas('mission', fn($q) => $q->where('organisation_id', auth()->user()->organisation->id))
        //         ->with(['mission', 'benevole.user', 'responsable'])
        //         ->get()
        //         ->groupBy('mission_id');

        return view('tasks',['activites' => $activites]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Only organisateurs can create activities
        if (auth()->user()->type !== 'organisation') {
            return redirect()->route('tasks.index')->with('error', 'Action non autorisée.');
        }

        $missionId = $request->query('mission_id');
        $mission = $missionId ? Mission::findOrFail($missionId) : null;
        $missions = auth()->user()->organisation->missions;
        
        $benevoles = $mission ? $mission->candidatures->where('status', 'accepted')->pluck('benevole') : collect([]);
        $users = \App\Models\User::where('type', 'organisation')->get();

        return view('tasks.create', compact('mission', 'missions', 'benevoles', 'users'));
    }

    public function getAllVolunteers(Request $request)
    {
        if (auth()->user()->type !== 'organisation') {
            return response()->json(['error' => 'Action non autorisée.'], 403);
        }

        $request->validate([
            'mission_id' => 'required|exists:missions,id',
        ]);

        $mission = Mission::findOrFail($request->mission_id);

        // Ensure the mission belongs to the organisation
        if ($mission->organisation_id !== auth()->user()->organisation->id) {
            return response()->json(['error' => 'Mission non autorisée.'], 403);
        }

        $benevoles = $mission->candidatures->where('status', 'accepted')->map(function ($candidature) {
            return [
                'id' => $candidature->benevole->id,
                'user' => [
                    'name' => $candidature->benevole->user->name,
                ],
            ];
        });

        return response()->json(['benevoles' => $benevoles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       if (auth()->user()->type !== 'organisation') {
            return redirect()->route('tasks.index')->with('error', 'Action non autorisée.');
        }

        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'benevole_id' => 'required|exists:benevoles,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'objective' => 'nullable|string',
            // 'responsable_id' => 'nullable|exists:users,id',
            'responsable_id' => 'required|exists:benevoles,id',
        ]);

        // Ensure the mission belongs to the organisation
        if (Mission::find($request->mission_id)->organisation_id !== auth()->user()->organisation->id) {
            return redirect()->route('tasks.index')->with('error', 'Mission non autorisée.');
        }

        $activite = Activity::create($request->all());

        // Send notification to the assigned bénévole
        if ($activite->benevole_id) {
            $activite->benevole->user->notify(new TaskAssigned($activite));
        }

        return redirect()->route('tasks.index')->with('success', 'Activité créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user->load(['benevole', 'organisation']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisation $organisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       $validated = $request->validate([
            'name'     => 'sometimes|string',
            'email'    => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'type'     => 'sometimes|in:benevole,organisateur,admin',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
