<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        {{-- 🔳 Cartes principales --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            
            {{-- Missions --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6 shadow hover:shadow-lg transition">
                <h2 class="text-xl font-bold mb-4">📋 Missions</h2>
                <p class="text-sm text-gray-500 mb-4">Liste des missions publiées par votre association.</p>
                <ul class="text-gray-700 dark:text-gray-200 list-disc list-inside space-y-1 h-3/4 overflow-y-auto">
                    @forelse($missions ?? [] as $mission)
                        <li>{{ $mission->titre }} ({{ $mission->created_at->format('d/m/Y') }})</li>
                    @empty
                        <li class="italic text-gray-400">Aucune mission publiée pour le moment.</li>
                    @endforelse
                </ul>
                <a href="{{ route('missions.index') }}" class="absolute bottom-4 right-4 px-4 py-2 bg-blue-500 text-white rounded-lg font-bold hover:bg-blue-600 transition">Voir</a>
            </div>

            {{-- Candidatures --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6 shadow hover:shadow-lg transition">
                <h2 class="text-xl font-bold mb-4">📩 Candidatures</h2>
                <p class="text-sm text-gray-500 mb-4">Bénévoles ayant postulé aux missions.</p>
                <ul class="text-gray-700 dark:text-gray-200 list-disc list-inside space-y-1 h-3/4 overflow-y-auto">
                    @forelse($candidatures ?? [] as $candidature)
                        <li>{{ $candidature->benevole->nom }} - {{ $candidature->mission->titre }}</li>
                    @empty
                        <li class="italic text-gray-400">Aucune candidature reçue pour le moment.</li>
                    @endforelse
                </ul>
                <a href="{{ route('candidatures.index') }}" class="absolute bottom-4 right-4 px-4 py-2 bg-green-500 text-white rounded-lg font-bold hover:bg-green-600 transition">Voir</a>
            </div>

            {{-- Tâches --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6 shadow hover:shadow-lg transition">
                <h2 class="text-xl font-bold mb-4">✅ Tâches</h2>
                <p class="text-sm text-gray-500 mb-4">Tâches assignées aux bénévoles acceptés.</p>
                <ul class="text-gray-700 dark:text-gray-200 list-disc list-inside space-y-1 h-3/4 overflow-y-auto">
                    @forelse($taches ?? [] as $tache)
                        <li>{{ $tache->titre }} - Assignée à {{ $tache->benevole->nom }}</li>
                    @empty
                        <li class="italic text-gray-400">Aucune tâche assignée pour le moment.</li>
                    @endforelse
                </ul>
                <a href="{{ route('taches.index') }}" class="absolute bottom-4 right-4 px-4 py-2 bg-yellow-500 text-white rounded-lg font-bold hover:bg-yellow-600 transition">Voir</a>
            </div>

        </div>

        {{-- Quatrième fonctionnalité : Événements / Activités --}}
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6 shadow hover:shadow-lg transition">
            <h2 class="text-xl font-bold mb-4">🎉 Événements</h2>
            <p class="text-sm text-gray-500 mb-4">Gestion des événements et activités organisés par l'association.</p>
            <ul class="text-gray-700 dark:text-gray-200 list-disc list-inside space-y-1 h-5/6 overflow-y-auto">
                @forelse($evenements ?? [] as $evenement)
                    <li>{{ $evenement->titre }} - {{ $evenement->date->format('d/m/Y') }}</li>
                @empty
                    <li class="italic text-gray-400">Aucun événement prévu pour le moment.</li>
                @endforelse
            </ul>
            <a href="{{ route('evenements.index') }}" class="absolute bottom-4 right-4 px-4 py-2 bg-purple-500 text-white rounded-lg font-bold hover:bg-purple-600 transition">Voir</a>
        </div>

    </div>
</x-layouts.app>
