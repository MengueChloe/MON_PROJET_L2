<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
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
        return view('tasks',['activites' => $activites]);
        //
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
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
