<x-layouts.app :title="__('Candidatures')">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Liste des candidatures') }}</h1>
            <form action="{{ route('candidacies.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" class="form-control rounded-l-lg border-gray-300 focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Rechercher une candidature..." value="{{ request('search') }}">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-r-lg hover:bg-red-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Mission</th>
                        @if (auth()->user()->type === 'organisateur')
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Bénévole</th>
                        @endif
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Motivation</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Statut</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date de candidature</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($candidacies as $candidature)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $candidature->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">
                                <a href="{{ route('missions.show', $candidature->mission) }}" class="text-primary hover:underline">
                                    {{ $candidature->mission->title }}
                                </a>
                            </td>
                            @if (auth()->user()->type === 'organisateur')
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $candidature->benevole->user->name }}</td>
                            @endif
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $candidature->motivation ? Str::limit($candidature->motivation, 50) : 'Aucune' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ ($candidature->status === 'accepted') ? 'bg-green-100 text-green-800' : 
                                       ($candidature->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                       'bg-yellow-100 text-yellow-800') }}"
                                >
                                    {{ ($candidature->status === 'pending' ? 'En attente' : 
                                       ($candidature->status === 'accepted' ? 'Acceptée' : 'Refusée')) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $candidature->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                @if (auth()->user()->type === 'benevole')
                                    @if ($candidature->status === 'pending')
                                        <form method="POST" action="{{ route('candidacies.destroy', $candidature) }}"
                                              onsubmit="return confirm('Confirmer l\'annulation de la candidature ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                                Annuler
                                            </button>
                                        </form>
                                    @endif
                                @elseif (auth()->user()->type === 'organisation')
                                    <form method="POST" action="{{ route('candidacies.update', $candidature) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="form-select text-sm rounded-lg border-gray-300 focus:ring focus:ring-primary focus:ring-opacity-50">
                                            <option value="pending" {{ $candidature->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                            <option value="accepted" {{ $candidature->status === 'accepted' ? 'selected' : '' }}>Accepter</option>
                                            <option value="rejected" {{ $candidature->status === 'rejected' ? 'selected' : '' }}>Refuser</option>
                                        </select>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->type === 'organisateur' ? 6 : 5 }}" class="px-6 py-4 text-center text-gray-500">
                                Aucune candidature trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $candidacies->appends(request()->query())->links() }}
        </div>
    </div>
</x-layouts.app>