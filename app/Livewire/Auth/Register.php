<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Organisation;
use App\Models\Benevole;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $account_type = 'benevole';

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    // Champs spécifiques bénévoles
    public string $phone = '';
    public string $skills = '';
    public string $bio = '';

    // Champs spécifiques organisations
    public string $address = '';
    public string $website = '';
    public string $description = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // $validated = $this->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $validated['password'] = Hash::make($validated['password']);

        // event(new Registered(($user = User::create($validated))));

        // Auth::login($user);

        // $this->redirect(route('dashboard', absolute: false), navigate: true);

        // 1. Validation de base (user)
        $validatedUser = $this->validate([
            'account_type' => ['required', 'in:benevole,organisation'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validatedUser['password'] = Hash::make($validatedUser['password']);
        $validatedUser['type'] = $this->account_type;

        // 2. Création de l’utilisateur
        $user = User::create($validatedUser);

        // 3. Enregistrement des infos spécifiques
        if ($this->account_type === 'benevole') {
            $this->validate([
                'phone' => ['required', 'string', 'max:20'],
                'skills' => ['nullable', 'string'],
                'bio' => ['nullable', 'string'],
            ]);

            Benevole::create([
                'user_id' => $user->id,
                'phone' => $this->phone,
                'name' => $this->name,
                'skills' => $this->skills,
                'bio' => $this->bio,
            ]);
        }

        if ($this->account_type === 'organisation') {
            $this->validate([
                'address' => ['required', 'string', 'max:255'],
                'website' => ['nullable', 'url'],
                'description' => ['nullable', 'string'],
            ]);

            Organisation::create([
                'user_id' => $user->id,
                'name' => $this->name, // ici le "name" est celui de l’orga
                'address' => $this->address,
                'website' => $this->website,
                'description' => $this->description,
            ]);
        }

        // 4. Événement Laravel
        event(new Registered($user));

        // 5. Auto-login
        Auth::login($user);

        // 6. Redirection
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
