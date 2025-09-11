<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Créer votre compte ')" :description="__('Veuillez saisir les informations demandées')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        
        <!-- Account Type -->
        <flux:select
            wire:model.live="account_type"
            :label="__('Type de compte')"
            required
            class="rounded-md border border-red-600"
        >
            <option value="benevole" >{{ __('Bénévole') }}</option>
            <option value="organisation">{{ __('Organisation') }}</option>
        </flux:select>

        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Nom')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nom Complet')"
            class="rounded-md border border-red-600"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Adresse E-mail')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
            class="rounded-md border border-red-600"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Mot de passe')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Mot de passe')"
            viewable
            class="rounded-md border border-red-600"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirmer Mot Passe')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirmer Mot Passe')"
            viewable
            class="rounded-md border border-red-600"
        />

        <!-- location -->
        <flux:input
            wire:model="location"
            :label="__('Localisation')"
            type="text"
            class="rounded-md border border-red-600"
        />

        <!-- Champs spécifiques -->
        @if($account_type === 'benevole')
            <!-- Téléphone bénévole -->
            <flux:input
                wire:model="phone"
                :label="__('Téléphone')"
                type="text"
                required
                placeholder="+237 6XX XXX XXX"
                class="rounded-md border border-red-600"
            />

            <!-- date_birth -->
            <flux:input
                wire:model="date_birth"
                :label="__('Date de Naissance')"
                type="date"
                class="rounded-md border border-red-600"
            />

            <!-- availability -->
            <flux:input
                wire:model="availability"
                :label="__('Votre disponibilité')"
                type="text"
                placeholder="Ex: Lundi, Mardi, Mercredi, ..."
                class="rounded-md border border-red-600"
            />
            
            <!-- Compétences -->
            <flux:input
                wire:model="skills"
                :label="__('Compétences')"
                type="text"
                placeholder="Ex: secourisme, organisation d’événements"
                class="rounded-md border border-red-600"
            />

            <!-- why_to_volonteer -->
            <flux:textarea
                wire:model="why_to_volonteer"
                :label="__('Vos Motivations')"
                placeholder="Présentez-vous en quelques lignes..."
                class="rounded-md border border-red-600"
            />

        @elseif($account_type === 'organisation')

            <!-- name -->
            <flux:input
                wire:model="organisation_name"
                :label="__('Nom de l\'organisation')"
                type="text"
                required
                placeholder="UNESCO"
                class="rounded-md border border-red-600"
            />
            
            <!-- representative -->
            <flux:input
                wire:model="representative"
                :label="__('Nom du Représentant')"
                type="text"
                required
                placeholder="Paul Joule"
                class="rounded-md border border-red-600"
            />
           
            <!-- creation_date -->
            <flux:input
                wire:model="creation_date"
                :label="__('Date de création')"
                type="date"
                required
                class="rounded-md border border-red-600"
            />
            
            <!-- activiy_domain -->
            <flux:input
                wire:model="activiy_domain"
                :label="__('Domaine d\'activité')"
                type="text"
                required
                placeholder="Santé"
                class="rounded-md border border-red-600"
            />

            <!-- Site web -->
            <flux:input
                wire:model="website"
                :label="__('Site web')"
                type="url"
                placeholder="https://exemple.org"
                class="rounded-md border border-red-600"
            />

            <!-- Description organisation -->
            <flux:textarea
                wire:model="description"
                :label="__('Description de l\'organisation')"
                placeholder="Parlez de vos objectifs, actions, valeurs..."
                class="rounded-md border border-red-600"
            />
        @endif

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="danger" class="w-full">
                {{ __('Créer') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('Avez-vous déjà un compte?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Se Connecter') }}</flux:link>
    </div>
</div>
