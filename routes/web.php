<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenevoleController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\CandidacyController;
use App\Http\Controllers\TaskController;
// use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/show/missions', [MissionController::class, 'all'])->name('missions.public');
Route::get('/show/missions/{id}', [MissionController::class, 'showDetails'])->name('missions.public-details');
Route::get('/apply/mission/{id}', [CandidacyController::class, 'apply'])->name('missions.apply');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Route::apiResource('users', UserController::class);
Route::resource('volunteers', BenevoleController::class);
Route::resource('organisations', OrganisationController::class);
Route::resource('missions', MissionController::class);
Route::resource('candidacies', CandidacyController::class);
Route::resource('tasks', TaskController::class);

require __DIR__.'/auth.php';
