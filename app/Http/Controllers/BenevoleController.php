<?php

namespace App\Http\Controllers;

use App\Models\Benevole;
use Illuminate\Http\Request;

class BenevoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Benevole::with(['user', 'candidatures'])->get();
    }
    
    public function byMission()
    {
        return Benevole::with(['user', 'candidatures'])->where('mission_id', )->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone'   => 'nullable|string',
            'skills'  => 'nullable|string',
            'bio'     => 'nullable|string',
        ]);

        return Benevole::create($validated);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Benevole $benevole)
    {
        return $benevole->load(['user', 'candidatures']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Benevole $benevole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Benevole $benevole)
    {
        $benevole->update($request->all());
        return $benevole;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benevole $benevole)
    {
        $benevole->delete();
        return response()->noContent();
    }
}
