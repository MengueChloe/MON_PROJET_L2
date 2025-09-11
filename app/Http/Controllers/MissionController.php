<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::with('organisation')->paginate();
        return view('missions', ['missions' => $missions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('missions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'organisation_id' => 'required|exists:organisations,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'skills_required' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $validated['organisation_id'] = auth()->user()->organisation->id;

        Mission::create($validated);

        return $this->returnAllMissions();
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        return view('missions.show', ['mission' => $mission->load('organisation', 'candidatures')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        return view('missions.edit', ['mission' => $mission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mission $mission)
    {
        $mission->update($request->all());
        return $this->returnAllMissions();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        // return response()->noContent();
        return $this->returnAllMissions();
    }
    
    private function returnAllMissions()
    {
        $missions = Mission::where('organisation_id', auth()->user()->organisation->id)
            ->with('organisation')
            ->paginate();

        return view('missions', ['missions' => $missions]);
    }
}
