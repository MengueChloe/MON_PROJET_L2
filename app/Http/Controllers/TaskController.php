<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Models\Activity;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For bénévoles, show only their activities; for organisateurs, show activities for their missions
        $activites = auth()->user()->type === 'benevole'
            ? Activity::where('benevole_id', auth()->user()->benevole->id)
                ->with(['mission', 'benevole.user', 'responsable'])
                ->get()
                ->groupBy('mission_id')
            : Activity::whereHas('mission', fn($q) => $q->where('organisation_id', auth()->user()->organisation->id))
                ->with(['mission', 'benevole.user', 'responsable'])
                ->get()
                ->groupBy('mission_id');

        return view('tasks',['activites' => $activites]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only organisateurs can create activities
        if (auth()->user()->type !== 'organisateur') {
            return redirect()->route('tasks.index')->with('error', 'Action non autorisée.');
        }

        $missionId = $request->query('mission_id');
        $mission = $missionId ? Mission::findOrFail($missionId) : null;
        $missions = auth()->user()->organisation->missions;
        $benevoles = $mission ? $mission->candidatures->where('status', 'accepted')->pluck('benevole') : collect([]);
        $users = \App\Models\User::where('type', 'organisateur')->get();

        return view('tasks.create', compact('mission', 'missions', 'benevoles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'type'     => 'required|in:benevole,organisateur,admin',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        return User::create($validated);
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
