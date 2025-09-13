<x-layouts.app :title="__('Nouvelle Activité')">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Créer une nouvelle activité') }}</h1>

        <form method="POST" action="{{ route('activities.store') }}" class="bg-white shadow rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="mission_id" class="block text-sm font-medium text-gray-700">Mission</label>
                <select name="mission_id" id="mission_id" class="form-select mt-1 block w-full rounded-lg border-gray-300" required>
                    <option value="">Sélectionner une mission</option>
                    @foreach ($missions as $mission)
                        <option value="{{ $mission->id }}" {{ old('mission_id', $mission->id ?? '') == $mission->id ? 'selected' : '' }}>{{ $mission->title }}</option>
                    @endforeach
                </select>
                @error('mission_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="benevole_id" class="block text-sm font-medium text-gray-700">Bénévole</label>
                <select name="benevole_id" id="benevole_id" class="form-select mt-1 block w-full rounded-lg border-gray-300" required>
                    <option value="">Sélectionner un bénévole</option>
                    @foreach ($benevoles as $benevole)
                        <option value="{{ $benevole->id }}">{{ $benevole->user->name }}</option>
                    @endforeach
                </select>
                @error('benevole_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300" required>
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="form-textarea mt-1 block w-full rounded-lg border-gray-300" rows="5" required>{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300">
                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Date et heure de début</label>
                <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300">
                @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="end_time" class="block text-sm font-medium text-gray-700">Date et heure de fin</label>
                <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300">
                @error('end_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="objective" class="block text-sm font-medium text-gray-700">Objectif</label>
                <textarea name="objective" id="objective" class="form-textarea mt-1 block w-full rounded-lg border-gray-300" rows="4">{{ old('objective') }}</textarea>
                @error('objective') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="responsable_id" class="block text-sm font-medium text-gray-700">Responsable</label>
                <select name="responsable_id" id="responsable_id" class="form-select mt-1 block w-full rounded-lg border-gray-300">
                    <option value="">Aucun responsable</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('responsable_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('responsable_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Créer</button>
                <a href="{{ route('activites.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Annuler</a>
            </div>
        </form>
    </div>
</x-layouts.app>