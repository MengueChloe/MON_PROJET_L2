<x-layouts.app :title="__('Dashboard')">
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 dark:text-white">{{ __('Tableau de bord') }}</h1>

        @if (auth()->user()->type === 'admin')
            <!-- Admin Dashboard: Global Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Utilisateurs inscrits</h3>
                    <div class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                    <div class="mt-4 space-y-1 text-sm">
                        <p>Admins: {{ $totalAdmins }} | Organisations: {{ $totalOrganisations }} | Bénévoles: {{ $totalBenevoles }}</p>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Missions créées</h3>
                    <div class="text-2xl font-bold text-green-600">{{ $totalMissions }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">ONGs inscrites</h3>
                    <div class="text-2xl font-bold text-purple-600">{{ $totalOrganisations }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Candidatures soumises</h3>
                    <div class="text-2xl font-bold text-orange-600">{{ $totalCandidatures }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
            </div>

            <!-- Admin Charts: One per Row -->
            <div class="space-y-8 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Aujourd'hui</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="adminDailyChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Cette semaine</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="adminWeeklyChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Ce mois</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="adminMonthlyChart"></canvas>
                    </div>
                </div>
            </div>

        @elseif (auth()->user()->type === 'organisation')
            <!-- Organisation Dashboard: Stats in 4 Columns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Missions créées</h3>
                    <div class="text-2xl font-bold text-green-600">{{ $orgTotalMissions }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Candidatures reçues</h3>
                    <div class="text-2xl font-bold text-orange-600">{{ $orgTotalCandidatures }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Activités assignées</h3>
                    <div class="text-2xl font-bold text-blue-600">{{ $orgTotalActivities }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 opacity-50">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">&nbsp;</h3>
                    <div class="text-2xl font-bold text-gray-600">-</div>
                    <p class="text-sm text-gray-500 mt-1">&nbsp;</p>
                </div>
            </div>

            <!-- Organisation Charts: One per Row -->
            <div class="space-y-8 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Aujourd'hui</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="orgDailyChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Cette semaine</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="orgWeeklyChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Ce mois</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="orgMonthlyChart"></canvas>
                    </div>
                </div>
            </div>

        @elseif (auth()->user()->type === 'benevole')
            <!-- Benevole Dashboard: Stats in 4 Columns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Candidatures soumises</h3>
                    <div class="text-2xl font-bold text-orange-600">{{ $benevoleTotalCandidatures }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Activités assignées</h3>
                    <div class="text-2xl font-bold text-blue-600">{{ $benevoleTotalActivities }}</div>
                    <p class="text-sm text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 opacity-50">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">&nbsp;</h3>
                    <div class="text-2xl font-bold text-gray-600">-</div>
                    <p class="text-sm text-gray-500 mt-1">&nbsp;</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 opacity-50">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">&nbsp;</h3>
                    <div class="text-2xl font-bold text-gray-600">-</div>
                    <p class="text-sm text-gray-500 mt-1">&nbsp;</p>
                </div>
            </div>

            <!-- Benevole Charts: One per Row -->
            <div class="space-y-8 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Aujourd'hui</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="benevoleDailyChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Cette semaine</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="benevoleWeeklyChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Ce mois</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="benevoleMonthlyChart"></canvas>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            @if (auth()->user()->type === 'admin')
                <a href="{{ route('users.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Gérer les utilisateurs</h3>
                    <p class="text-sm text-gray-500 mt-2">Voir et modifier les comptes</p>
                </a>
                <a href="{{ route('missions.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Missions</h3>
                    <p class="text-sm text-gray-500 mt-2">Gérer les missions</p>
                </a>
                <a href="{{ route('candidacies.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Candidatures</h3>
                    <p class="text-sm text-gray-500 mt-2">Gérer les candidatures</p>
                </a>
            @elseif (auth()->user()->type === 'organisation')
                <a href="{{ route('missions.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Mes missions</h3>
                    <p class="text-sm text-gray-500 mt-2">Créer et gérer</p>
                </a>
                <a href="{{ route('candidatures.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Candidatures</h3>
                    <p class="text-sm text-gray-500 mt-2">Voir et répondre</p>
                </a>
                <a href="{{ route('tasks.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Activités</h3>
                    <p class="text-sm text-gray-500 mt-2">Assigner et gérer</p>
                </a>
            @else
                <a href="{{ route('missions.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Trouver des missions</h3>
                    <p class="text-sm text-gray-500 mt-2">Découvrir des opportunités</p>
                </a>
                <a href="{{ route('candidatures.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Mes candidatures</h3>
                    <p class="text-sm text-gray-500 mt-2">Suivre l'avancement</p>
                </a>
                <a href="{{ route('tasks.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700">Mes activités</h3>
                    <p class="text-sm text-gray-500 mt-2">Gérer mes tâches</p>
                </a>
            @endif
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        // Chart.js Configuration
        const primaryColor = '#e2001a';
        const secondaryColor = '#ff7f00';
        const blueColor = '#2563eb';
        const greenColor = '#16a34a';
        const purpleColor = '#9333ea';
        const orangeColor = '#f97316';

        // Chart options for consistency
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: { position: 'top' }
            }
        };

        @if (auth()->user()->type === 'admin')
            // Admin Daily Chart
            new Chart(document.getElementById('adminDailyChart'), {
                type: 'bar',
                data: {
                    labels: ['Utilisateurs', 'Missions', 'Candidatures'],
                    datasets: [
                        {
                            label: 'Admins',
                            data: [{{ $dailyAdmins }}, 0, 0],
                            backgroundColor: blueColor
                        },
                        {
                            label: 'Organisations',
                            data: [{{ $dailyOrganisations }}, 0, 0],
                            backgroundColor: purpleColor
                        },
                        {
                            label: 'Bénévoles',
                            data: [{{ $dailyBenevoles }}, 0, 0],
                            backgroundColor: greenColor
                        },
                        {
                            label: 'Missions',
                            data: [0, {{ $dailyMissions }}, 0],
                            backgroundColor: primaryColor
                        },
                        {
                            label: 'Candidatures',
                            data: [0, 0, {{ $dailyCandidatures }}],
                            backgroundColor: orangeColor
                        }
                    ]
                },
                options: chartOptions
            });

            // Admin Weekly Chart
            new Chart(document.getElementById('adminWeeklyChart'), {
                type: 'bar',
                data: {
                    labels: ['Utilisateurs', 'Missions', 'Candidatures'],
                    datasets: [
                        {
                            label: 'Admins',
                            data: [{{ $weeklyAdmins }}, 0, 0],
                            backgroundColor: blueColor
                        },
                        {
                            label: 'Organisations',
                            data: [{{ $weeklyOrganisations }}, 0, 0],
                            backgroundColor: purpleColor
                        },
                        {
                            label: 'Bénévoles',
                            data: [{{ $weeklyBenevoles }}, 0, 0],
                            backgroundColor: greenColor
                        },
                        {
                            label: 'Missions',
                            data: [0, {{ $weeklyMissions }}, 0],
                            backgroundColor: primaryColor
                        },
                        {
                            label: 'Candidatures',
                            data: [0, 0, {{ $weeklyCandidatures }}],
                            backgroundColor: orangeColor
                        }
                    ]
                },
                options: chartOptions
            });

            // Admin Monthly Chart
            new Chart(document.getElementById('adminMonthlyChart'), {
                type: 'bar',
                data: {
                    labels: ['Utilisateurs', 'Missions', 'Candidatures'],
                    datasets: [
                        {
                            label: 'Admins',
                            data: [{{ $monthlyAdmins }}, 0, 0],
                            backgroundColor: blueColor
                        },
                        {
                            label: 'Organisations',
                            data: [{{ $monthlyOrganisations }}, 0, 0],
                            backgroundColor: purpleColor
                        },
                        {
                            label: 'Bénévoles',
                            data: [{{ $monthlyBenevoles }}, 0, 0],
                            backgroundColor: greenColor
                        },
                        {
                            label: 'Missions',
                            data: [0, {{ $monthlyMissions }}, 0],
                            backgroundColor: primaryColor
                        },
                        {
                            label: 'Candidatures',
                            data: [0, 0, {{ $monthlyCandidatures }}],
                            backgroundColor: orangeColor
                        }
                    ]
                },
                options: chartOptions
            });

        @elseif (auth()->user()->type === 'organisation')
            // Organisation Daily Chart
            new Chart(document.getElementById('orgDailyChart'), {
                type: 'bar',
                data: {
                    labels: ['Missions', 'Candidatures', 'Activités'],
                    datasets: [
                        {
                            label: 'Missions',
                            data: [{{ $orgDailyMissions }}, 0, 0],
                            backgroundColor: primaryColor
                        },
                        {
                            label: 'Candidatures',
                            data: [0, {{ $orgDailyCandidatures }}, 0],
                            backgroundColor: orangeColor
                        },
                        {
                            label: 'Activités',
                            data: [0, 0, {{ $orgDailyActivities }}],
                            backgroundColor: blueColor
                        }
                    ]
                },
                options: chartOptions
            });

            // Organisation Weekly Chart
            new Chart(document.getElementById('orgWeeklyChart'), {
                type: 'bar',
                data: {
                    labels: ['Missions', 'Candidatures', 'Activités'],
                    datasets: [
                        {
                            label: 'Missions',
                            data: [{{ $orgWeeklyMissions }}, 0, 0],
                            backgroundColor: primaryColor
                        },
                        {
                            label: 'Candidatures',
                            data: [0, {{ $orgWeeklyCandidatures }}, 0],
                            backgroundColor: orangeColor
                        },
                        {
                            label: 'Activités',
                            data: [0, 0, {{ $orgWeeklyActivities }}],
                            backgroundColor: blueColor
                        }
                    ]
                },
                options: chartOptions
            });

            // Organisation Monthly Chart
            new Chart(document.getElementById('orgMonthlyChart'), {
                type: 'bar',
                data: {
                    labels: ['Missions', 'Candidatures', 'Activités'],
                    datasets: [
                        {
                            label: 'Missions',
                            data: [{{ $orgMonthlyMissions }}, 0, 0],
                            backgroundColor: primaryColor
                        },
                        {
                            label: 'Candidatures',
                            data: [0, {{ $orgMonthlyCandidatures }}, 0],
                            backgroundColor: orangeColor
                        },
                        {
                            label: 'Activités',
                            data: [0, 0, {{ $orgMonthlyActivities }}],
                            backgroundColor: blueColor
                        }
                    ]
                },
                options: chartOptions
            });

        @elseif (auth()->user()->type === 'benevole')
            // Benevole Daily Chart
            new Chart(document.getElementById('benevoleDailyChart'), {
                type: 'bar',
                data: {
                    labels: ['Candidatures', 'Activités'],
                    datasets: [
                        {
                            label: 'Candidatures',
                            data: [{{ $benevoleDailyCandidatures }}, 0],
                            backgroundColor: orangeColor
                        },
                        {
                            label: 'Activités',
                            data: [0, {{ $benevoleDailyActivities }}],
                            backgroundColor: blueColor
                        }
                    ]
                },
                options: chartOptions
            });

            // Benevole Weekly Chart
            new Chart(document.getElementById('benevoleWeeklyChart'), {
                type: 'bar',
                data: {
                    labels: ['Candidatures', 'Activités'],
                    datasets: [
                        {
                            label: 'Candidatures',
                            data: [{{ $benevoleWeeklyCandidatures }}, 0],
                            backgroundColor: orangeColor
                        },
                        {
                            label: 'Activités',
                            data: [0, {{ $benevoleWeeklyActivities }}],
                            backgroundColor: blueColor
                        }
                    ]
                },
                options: chartOptions
            });

            // Benevole Monthly Chart
            new Chart(document.getElementById('benevoleMonthlyChart'), {
                type: 'bar',
                data: {
                    labels: ['Candidatures', 'Activités'],
                    datasets: [
                        {
                            label: 'Candidatures',
                            data: [{{ $benevoleMonthlyCandidatures }}, 0],
                            backgroundColor: orangeColor
                        },
                        {
                            label: 'Activités',
                            data: [0, {{ $benevoleMonthlyActivities }}],
                            backgroundColor: blueColor
                        }
                    ]
                },
                options: chartOptions
            });
        @endif
    </script>
</x-layouts.app>