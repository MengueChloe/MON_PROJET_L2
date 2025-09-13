<x-layouts.app :title="__('Gestion des Activités')">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Tableau des Activités') }}</h1>
            @if (auth()->user()->type === 'organisation')
                <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    + Nouvelle Activité
                </a>
            @endif
        </div>

        <div class="kanban-board flex overflow-x-auto space-x-4 pb-4">
            @forelse ($activites as $missionId => $missionActivites)
                @php
                    $mission = $missionActivites->first()->mission;
                @endphp
                <div class="kanban-column bg-white shadow rounded-lg min-w-[300px] flex-shrink-0">
                    <div class="column-header bg-gray-100 px-4 py-3 border-b">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $mission->title }}</h2>
                    </div>
                    <div class="column-body p-4 space-y-4">
                        @foreach ($missionActivites as $activite)
                            <div class="activite-card bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                                <h3 class="text-md font-medium text-gray-800 mb-2">{{ $activite->title }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($activite->description, 100) }}</p>
                                <p class="text-sm text-gray-500 mb-1"><i class="fas fa-map-marker-alt mr-1"></i>{{ $activite->location ?? 'Non spécifié' }}</p>
                                <p class="text-sm text-gray-500 mb-1"><i class="fas fa-clock mr-1"></i>
                                    @if ($activite->start_time)
                                        Du {{ $activite->start_time }} 
                                        @if ($activite->end_time)
                                            au {{ $activite->end_time }}
                                        @endif
                                    @else
                                        Non spécifié
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500 mb-1"><i class="fas fa-bullseye mr-1"></i>{{ Str::limit($activite->objective, 50) ?? 'Non spécifié' }}</p>
                                <p class="text-sm text-gray-500 mb-1"><i class="fas fa-user-check mr-1"></i>Responsable: {{ $activite->responsable->name ?? 'Non assigné' }}</p>
                                <p class="text-sm text-gray-500 mb-2"><i class="fas fa-user mr-1"></i>Bénévole: {{ $activite->benevole->user->name ?? 'Non assigné' }}</p>
                                
                                @if (auth()->user()->type === 'organisateur')
                                    <div class="flex space-x-2">
                                        <a href="{{ route('activites.edit', $activite) }}" class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('activites.destroy', $activite) }}" onsubmit="return confirm('Confirmer la suppression ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                                Supprimer
                                            </button>
                                        </form>
                                        @if (!$activite->benevole_id)
                                            <form method="POST" action="{{ route('activites.assign', $activite) }}">
                                                @csrf
                                                <select name="benevole_id" class="form-select text-sm rounded-lg border-gray-300" onchange="this.form.submit()">
                                                    <option value="">Assigner un bénévole</option>
                                                    @foreach ($mission->candidatures->where('status', 'accepted') as $candidature)
                                                        <option value="{{ $candidature->benevole_id }}">{{ $candidature->benevole->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @if (auth()->user()->type === 'organisation')
                            <a href="{{ route('tasks.create', ['mission_id' => $missionId]) }}" class="block text-center px-4 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">
                                + Ajouter une activité
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="w-full text-center text-gray-500">
                    Aucune activité trouvée.
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .kanban-board {
            scrollbar-width: thin;
            scrollbar-color: #d1d5db #f3f4f6;
        }
        .kanban-board::-webkit-scrollbar {
            height: 12px;
        }
        .kanban-board::-webkit-scrollbar-track {
            background: #f3f4f6;
        }
        .kanban-board::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 20px;
            border: 3px solid #f3f4f6;
        }
    </style>
</x-layouts.app>