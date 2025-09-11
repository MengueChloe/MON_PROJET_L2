<x-layouts.app :title="__('Détails de la mission')">
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $mission->title }}</h1>
                <p class="text-gray-600 mt-1">Publié par {{ $mission->organisation->name ?? 'Organisation inconnue' }}</p>
            </div>

            <div class="flex space-x-2">
                @if(auth()->user()->type === 'organisateur')
                    <a href="{{ route('missions.edit', $mission) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition">
                        Modifier
                    </a>
                @endif

                <a href="{{ route('missions.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    Retour
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            {{-- Localisation --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500">📍 Localisation</h2>
                <p class="mt-1 text-gray-800">{{ $mission->location }}</p>
            </div>

            {{-- Compétences requises --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500">🛠 Compétences requises</h2>
                <p class="mt-1 text-gray-800">{{ $mission->skills_required }}</p>
            </div>

            {{-- Description --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500">📝 Description</h2>
                <p class="mt-1 text-gray-800 whitespace-pre-line">{{ $mission->description }}</p>
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h2 class="text-sm font-semibold text-gray-500">📅 Date de début</h2>
                    <p class="mt-1 text-gray-800">{{ \Carbon\Carbon::parse($mission->start_date)->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-500">📅 Date de fin</h2>
                    <p class="mt-1 text-gray-800">{{ \Carbon\Carbon::parse($mission->end_date)->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Bouton candidater pour les bénévoles --}}
        @if(auth()->user()->type === 'benevole')
            <div class="mt-6">
                <form method="POST" action="{{ route('candidatures.store') }}">
                    @csrf
                    <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                        Candidater à cette mission
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-layouts.app>
