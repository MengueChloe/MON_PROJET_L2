<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use App\Models\Candidacy;

class MissionController extends Controller
{
    public function all(Request $request)
    {
        // On récupère toutes les missions
        // $missions = Mission::latest()->paginate();

        // On envoie ça vers la vue
        // return view('missions.public-index', compact('missions'));

        $query = Mission::query()->where('is_published', true);
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }
        $missions = $query->with('organisation')->paginate(10);
        return view('missions.public-index', compact('missions'));
    }

    public function showDetails(int $id)
    {
        $mission = Mission::with(['organisation'])->find($id);

        $existingCandidature = auth()->check() && auth()->user()->type === 'benevole'
            ? Candidacy::where('benevole_id', auth()->user()->benevole->id)
                        ->where('mission_id', $mission->id)
                        ->first()
            : null;

        return view('missions.public-details', ['mission' => $mission, 'existingCandidature'=>  $existingCandidature]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::with('organisation')
            ->where('organisation_id', auth()->user()->organisation->id)
            ->paginate();
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
