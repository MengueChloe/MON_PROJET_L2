<x-layouts.app :title="__('Missions')">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="dark:text-white text-2xl font-bold text-gray-800">{{ __('Liste des missions') }}</h1>
           
            <a href="{{ route('missions.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                + Nouvelle mission
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date début</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date fin</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($missions as $mission)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $mission->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $mission->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($mission->description, 50) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $mission->start_date }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $mission->end_date }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('missions.show', $mission) }}"
                                   class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">
                                    Voir
                                </a>
                                <a href="{{ route('missions.edit', $mission) }}"
                                   class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('missions.destroy', $mission) }}"
                                      onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucune mission trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination si nécessaire --}}
        <div class="mt-4">
            {{ $missions->links() }}
        </div>
    </div>
</x-layouts.app>
