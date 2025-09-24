<x-layouts.app :title="__('Gestion des utilisateurs')">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Liste des utilisateurs') }}</h1>
            <div class="flex items-center space-x-4">
                <form action="{{ route('users.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" class="form-control rounded-l-lg border-gray-300 focus:ring focus:ring-blue-600 focus:ring-opacity-50" placeholder="Rechercher un utilisateur..." value="{{ request('search') }}">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    + Nouvel utilisateur
                </a>
            </div>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Statut</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $user->type === 'benevole' ? 'Bénévole' : ($user->type === 'organisation' ? 'Organisation' : 'Admin') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="px-2 py-1 rounded-full text-xs {{ $user->is_blocked ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $user->is_blocked ? 'Bloqué' : 'Actif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('users.edit', $user) }}" class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Modifier
                                </a>
                                @if ($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Confirmer la suppression ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                            Supprimer
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('users.toggleBlock', $user) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 text-sm {{ $user->is_blocked ? 'bg-green-500 hover:bg-green-600' : 'bg-orange-500 hover:bg-orange-600' }} text-white rounded">
                                            {{ $user->is_blocked ? 'Débloquer' : 'Bloquer' }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucun utilisateur trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
</x-layouts.app>