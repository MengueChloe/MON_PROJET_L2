<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\Candidacy;
use App\Models\Activity;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->type === 'admin') {
            // Global stats
            $totalUsers = User::count();
            $totalAdmins = User::where('type', 'admin')->count();
            $totalOrganisations = User::where('type', 'organisation')->count();
            $totalBenevoles = User::where('type', 'benevole')->count();
            $totalMissions = Mission::count();
            $totalCandidatures = Candidacy::count();
            $totalActivities = Activity::count();

            // Daily stats (today)
            $today = Carbon::today();
            $dailyAdmins = User::where('type', 'admin')->whereDate('created_at', $today)->count();
            $dailyOrganisations = User::where('type', 'organisation')->whereDate('created_at', $today)->count();
            $dailyBenevoles = User::where('type', 'benevole')->whereDate('created_at', $today)->count();
            $dailyMissions = Mission::whereDate('created_at', $today)->count();
            $dailyCandidatures = Candidacy::whereDate('created_at', $today)->count();
            $dailyActivities = Activity::whereDate('created_at', $today)->count();

            // Weekly stats (this week)
            $weekStart = Carbon::now()->startOfWeek();
            $weeklyAdmins = User::where('type', 'admin')->whereBetween('created_at', [$weekStart, $today])->count();
            $weeklyOrganisations = User::where('type', 'organisation')->whereBetween('created_at', [$weekStart, $today])->count();
            $weeklyBenevoles = User::where('type', 'benevole')->whereBetween('created_at', [$weekStart, $today])->count();
            $weeklyMissions = Mission::whereBetween('created_at', [$weekStart, $today])->count();
            $weeklyCandidatures = Candidacy::whereBetween('created_at', [$weekStart, $today])->count();
            $weeklyActivities = Activity::whereBetween('created_at', [$weekStart, $today])->count();

            // Monthly stats (this month)
            $monthStart = Carbon::now()->startOfMonth();
            $monthlyAdmins = User::where('type', 'admin')->whereBetween('created_at', [$monthStart, $today])->count();
            $monthlyOrganisations = User::where('type', 'organisation')->whereBetween('created_at', [$monthStart, $today])->count();
            $monthlyBenevoles = User::where('type', 'benevole')->whereBetween('created_at', [$monthStart, $today])->count();
            $monthlyMissions = Mission::whereBetween('created_at', [$monthStart, $today])->count();
            $monthlyCandidatures = Candidacy::whereBetween('created_at', [$monthStart, $today])->count();
            $monthlyActivities = Activity::whereBetween('created_at', [$monthStart, $today])->count();

            return view('dashboard', compact(
                'totalUsers', 'totalAdmins', 'totalOrganisations', 'totalBenevoles',
                'totalMissions', 'totalCandidatures', 'totalActivities',
                'dailyAdmins', 'dailyOrganisations', 'dailyBenevoles', 'dailyMissions', 'dailyCandidatures', 'dailyActivities',
                'weeklyAdmins', 'weeklyOrganisations', 'weeklyBenevoles', 'weeklyMissions', 'weeklyCandidatures', 'weeklyActivities',
                'monthlyAdmins', 'monthlyOrganisations', 'monthlyBenevoles', 'monthlyMissions', 'monthlyCandidatures', 'monthlyActivities'
            ));
        } elseif ($user->type === 'organisation') {
            $organisation = $user->organisation;

            $orgTotalMissions = Mission::where('organisation_id', $organisation->id)->count();
            $orgTotalCandidatures = Candidacy::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->count();
            $orgTotalActivities = Activity::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->count();

            $today = Carbon::today();
            $orgDailyMissions = Mission::where('organisation_id', $organisation->id)->whereDate('created_at', $today)->count();
            $orgDailyCandidatures = Candidacy::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->whereDate('created_at', $today)->count();
            $orgDailyActivities = Activity::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->whereDate('created_at', $today)->count();

            $weekStart = Carbon::now()->startOfWeek();
            $orgWeeklyMissions = Mission::where('organisation_id', $organisation->id)->whereBetween('created_at', [$weekStart, $today])->count();
            $orgWeeklyCandidatures = Candidacy::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->whereBetween('created_at', [$weekStart, $today])->count();
            $orgWeeklyActivities = Activity::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->whereBetween('created_at', [$weekStart, $today])->count();

            $monthStart = Carbon::now()->startOfMonth();
            $orgMonthlyMissions = Mission::where('organisation_id', $organisation->id)->whereBetween('created_at', [$monthStart, $today])->count();
            $orgMonthlyCandidatures = Candidacy::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->whereBetween('created_at', [$monthStart, $today])->count();
            $orgMonthlyActivities = Activity::whereHas('mission', fn($q) => $q->where('organisation_id', $organisation->id))->whereBetween('created_at', [$monthStart, $today])->count();

            return view('dashboard', compact(
                'orgTotalMissions', 'orgTotalCandidatures', 'orgTotalActivities',
                'orgDailyMissions', 'orgDailyCandidatures', 'orgDailyActivities',
                'orgWeeklyMissions', 'orgWeeklyCandidatures', 'orgWeeklyActivities',
                'orgMonthlyMissions', 'orgMonthlyCandidatures', 'orgMonthlyActivities'
            ));
        } elseif ($user->type === 'benevole') {
            $benevole = $user->benevole;

            $benevoleTotalCandidatures = Candidacy::where('benevole_id', $benevole->id)->count();
            $benevoleTotalActivities = Activity::where('benevole_id', $benevole->id)->count();

            $today = Carbon::today();
            $benevoleDailyCandidatures = Candidacy::where('benevole_id', $benevole->id)->whereDate('created_at', $today)->count();
            $benevoleDailyActivities = Activity::where('benevole_id', $benevole->id)->whereDate('created_at', $today)->count();

            $weekStart = Carbon::now()->startOfWeek();
            $benevoleWeeklyCandidatures = Candidacy::where('benevole_id', $benevole->id)->whereBetween('created_at', [$weekStart, $today])->count();
            $benevoleWeeklyActivities = Activity::where('benevole_id', $benevole->id)->whereBetween('created_at', [$weekStart, $today])->count();

            $monthStart = Carbon::now()->startOfMonth();
            $benevoleMonthlyCandidatures = Candidacy::where('benevole_id', $benevole->id)->whereBetween('created_at', [$monthStart, $today])->count();
            $benevoleMonthlyActivities = Activity::where('benevole_id', $benevole->id)->whereBetween('created_at', [$monthStart, $today])->count();

            return view('dashboard', compact(
                'benevoleTotalCandidatures', 'benevoleTotalActivities',
                'benevoleDailyCandidatures', 'benevoleDailyActivities',
                'benevoleWeeklyCandidatures', 'benevoleWeeklyActivities',
                'benevoleMonthlyCandidatures', 'benevoleMonthlyActivities'
            ));
        }

        return view('dashboard');
    }
}