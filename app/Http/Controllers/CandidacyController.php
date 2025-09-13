<?php

namespace App\Http\Controllers;

use App\Models\Candidacy;
use Illuminate\Http\Request;
use App\Notifications\CandidacyStatusUpdated;
use App\Notifications\CandidacyReceived;

class CandidacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return Candidature::with(['benevole', 'mission'])->get();
        // $candidacies = Candidacy::where('benevole_id', auth()->user()->benevole->id)->paginate();

        $query = auth()->user()->type === 'benevole'
        ? Candidacy::where('benevole_id', auth()->user()->benevole->id)
        : Candidacy::whereHas('mission', fn($q) => $q->where('organisation_id', auth()->user()->organisation->id));

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('mission', fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->orWhereHas('benevole.user', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        }

        $candidacies = $query->with(['mission', 'benevole.user'])->paginate();

        return view('candidacies', ['candidacies' => $candidacies]);
    }
    
    public function apply(int $id)
    {
        $mission = Mission::find($id);
        return view(candidacies.apply, ['mission' => $mission]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'benevole_id' => 'required|exists:benevoles,id',
            'mission_id'  => 'required|exists:missions,id',
            'motivation'  => 'nullable|string',
            'status'      => 'in:pending,accepted,rejected',
        ]);

        $candidature = Candidacy::create($validated);

        $candidacies = Candidacy::where('benevole_id', $validated['benevole_id'])->paginate();

        // Send notification to the bénévole
        $candidature->benevole->user->notify(new CandidacyReceived($candidature));

        return view('candidacies', ['candidacies' => $candidacies]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidacy $candidacy)
    {
        return $candidature->load(['benevole', 'mission']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidacy $candidacy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidacy $candidacy)
    {
        $validated = $request->validate([
            // 'motivation' => 'nullable|string',
            'status'     => 'in:pending,accepted,rejected',
        ]);

        if (auth()->user()->type === 'organisation' && $candidacy->mission->organisation_id === auth()->user()->organisation->id) {
            $candidacy->update(['status' => $request->status]);
            
            // Send notification to the bénévole if status is accepted or rejected
            if (in_array($request->status, ['accepted', 'rejected'])) {
                $candidacy->benevole->user->notify(new CandidacyStatusUpdated($candidacy));
            }

            return redirect()->route('candidacies.index')->with('success', 'Statut mis à jour.');
        }
        
        return redirect()->route('candidacies.index')->with('error', 'Action non autorisée.');
        
        // $candidature->update($validated);
        // return $candidature;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidacy $candidacy)
    {
        // $candidature->delete();
        // return response()->noContent();

        if (auth()->user()->type === 'benevole' && $candidacy->benevole_id === auth()->user()->benevole->id && $candidacy->status === 'pending') {
            $candidacy->delete();
            return redirect()->route('candidacies.index')->with('success', 'Candidature annulée.');
        }
        return redirect()->route('candidacies.index')->with('error', 'Action non autorisée.');
    }
}
