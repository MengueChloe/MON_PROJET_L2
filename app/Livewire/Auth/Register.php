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

    public string $phone = '';

    // Champs spécifiques bénévoles
    public string $skills = '';
    public string $date_birth = '';
    public string $availability = '';
    public string $why_to_volonteer = '';
    public string $location = '';

    // Champs spécifiques organisations
    public string $organisation_name = '';
    public string $activiy_domain = '';
    public string $description = '';
    public string $website = '';
    public string $representative = '';
    public string $postal_code = '';
    public string $creation_date = '';

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
                'phone' => ['nullable', 'string', 'max:20'],
                'skills' => ['required', 'string'],
                'date_birth' => ['required', 'date'],
                'availability' => ['required', 'string', 'max:100'],
                'why_to_volonteer' => ['required', 'string'],
                'location' => ['nullable', 'string', 'max:50'],
            ]);

            Benevole::create([
                'user_id' => $user->id,
                'phone' => $this->phone,
                'name' => $this->name,
                'skills' => $this->skills,
                'date_birth' => $this->date_birth,
                'availability' => $this->availability,
                'why_to_volonteer' => $this->why_to_volonteer,
                'location' => $this->location,
            ]);
        }

        if ($this->account_type === 'organisation') {
            $this->validate([
                'organisation_name' => ['required', 'string', 'max:50'],
                'activiy_domain' => ['required', 'string', 'max:50'],
                'description' => ['required', 'string'],
                'location' => ['nullable', 'string', 'max:50'],
                'website' => ['nullable', 'url'],
                'representative' => ['required', 'string', 'max:50'],
                'postal_code' => ['nullable', 'string', 'max:50'],
                'creation_date' => ['required', 'date'],
            ]);

            Organisation::create([
                'user_id' => $user->id,
                'name' => $this->organisation_name, // ici le "name" est celui de l’orga
                'address' => $this->address,
                'website' => $this->website,
                'description' => $this->description,
                'activiy_domain' => $this->activiy_domain,
                'location' => $this->location,
                'representative' => $this->representative,
                'postal_code' => $this->postal_code,
                'creation_date' => $this->creation_date,
                'phone' => $this->phone,
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
