<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Benevole;
use App\Models\Candidature;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques
        $missionsCount = Mission::count();
        $benevolesCount = Benevole::count();
        $candidaturesCount = Candidature::count();

        // Dernières missions
        $dernieresMissions = Mission::latest()->take(5)->get();

        // Missions par mois pour graphique
        $missionsParMois = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths(11 - $i);
            $missionsParMois['labels'][] = $month->format('M');
            $missionsParMois['data'][] = Mission::whereYear('created_at', $month->year)
                                                ->whereMonth('created_at', $month->month)
                                                ->count();
        }

        return view('dashboard', compact(
            'missionsCount',
            'benevolesCount',
            'candidaturesCount',
            'dernieresMissions',
            'missionsParMois'
        ));
    }
}
