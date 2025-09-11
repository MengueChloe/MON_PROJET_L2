<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Organisation::with('missions')->get();
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
            'user_id'     => 'required|exists:users,id',
            'name'        => 'required|string',
            'address'     => 'nullable|string',
            'website'     => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        return Organisation::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organisation $organisation)
    {
        return $organisation->load('missions');
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
    public function update(Request $request, Organisation $organisation)
    {
        $organisation->update($request->all());
        return $organisation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation)
    {
        $organisation->delete();
        return response()->noContent();
    }
}
