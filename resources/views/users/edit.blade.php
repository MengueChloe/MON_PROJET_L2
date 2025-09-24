<x-layouts.app :title="__('Modifier Utilisateur')">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Modifier l\'utilisateur') }}</h1>

        <form method="POST" action="{{ route('users.update', $user) }}" class="bg-white shadow rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div> -->

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe (optionnel)</label>
                <input type="password" name="password" id="password" class="form-input mt-1 block w-full rounded-lg border-gray-300">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type" class="form-select mt-1 block w-full rounded-lg border-gray-300" required>
                    <option value="benevole" {{ old('type', $user->type) === 'benevole' ? 'selected' : '' }}>Bénévole</option>
                    <option value="organisation" {{ old('type', $user->type) === 'organisation' ? 'selected' : '' }}>Organisation</option>
                    <option value="admin" {{ old('type', $user->type) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Mettre à jour</button>
                <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Annuler</a>
            </div>
        </form>
    </div>
</x-layouts.app>