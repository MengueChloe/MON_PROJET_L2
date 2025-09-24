<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
        }

        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->paginate();

        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name'     => 'required|string',
        //     'email'    => 'required|email|unique:users',
        //     'password' => 'required|string|min:8',
        //     'type'     => 'required|in:benevole,organisation,admin',
        // ]);

        if (auth()->user()->type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'type' => 'required|in:benevole,organisation,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'is_blocked' => false,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
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
    public function edit(User $user)
    {
        if (auth()->user()->type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'type' => 'required|in:benevole,organisation,admin',
        ]);

        $user->update([
            'name' => $request->name,
            // 'email' => $request->email,
            'type' => $request->type,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function toggleBlock(int $id)
    {
        if (auth()->user()->type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée.');
        }

        $user = User::find($id);

        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas bloquer/débloquer votre propre compte.');
        }

        $user->update(['is_blocked' => !$user->is_blocked]);

        return redirect()->route('users.index')->with('success', $user->is_blocked ? 'Utilisateur bloqué avec succès.' : 'Utilisateur débloqué avec succès.');
    }
}
