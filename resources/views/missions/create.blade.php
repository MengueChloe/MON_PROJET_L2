
<x-layouts.app :title="__('Nouvelle Mission')">
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Créer une nouvelle mission') }}</h1>
            <p class="text-gray-600 mt-1">Remplissez le formulaire ci-dessous pour ajouter une mission.</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <form method="POST" action="{{ route('missions.store') }}" class="space-y-5">
                @csrf

                {{-- Nom --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Nom de la mission</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title') }}"
                           class="dark:text-black mt-1 p-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Localisation --}}
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Localisation de la mission</label>
                    <input type="text" name="location" id="location"
                           value="{{ old('location') }}"
                           class="dark:text-black mt-1 p-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm"
                           required>
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- skills_required --}}
                <div>
                    <label for="skills_required" class="block text-sm font-medium text-gray-700">Compétences Requises </label>
                    <input type="text" name="skills_required" id="skills_required"
                           value="{{ old('skills_required') }}"
                           class="dark:text-black mt-1 p-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm"
                           required>
                    @error('skills_required')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="dark:text-black mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date de début --}}
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                    <input type="date" name="start_date" id="start_date"
                           value="{{ old('start_date') }}"
                           class="dark:text-black mt-1 p-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm"
                           required>
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date de fin --}}
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                    <input type="date" name="end_date" id="end_date"
                           value="{{ old('end_date') }}"
                           class="dark:text-black mt-1 p-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm"
                           required>
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Boutons --}}
                <div class="flex items-center justify-between">
                    <a href="{{ route('missions.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
