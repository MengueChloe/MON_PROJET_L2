<?php

namespace App\Http\Controllers;

use App\Models\Candidacy;
use Illuminate\Http\Request;

class CandidacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Candidature::with(['benevole', 'mission'])->get();
        return view('candidacies');
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

        return Candidature::create($validated);
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
            'motivation' => 'nullable|string',
            'status'     => 'in:pending,accepted,rejected',
        ]);

        $candidature->update($validated);
        return $candidature;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidacy $candidacy)
    {
        $candidature->delete();
        return response()->noContent();
    }
}
