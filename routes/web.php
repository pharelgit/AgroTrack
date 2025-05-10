<?php

use App\Http\Controllers\InterventionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\parcelles\ParcelleController;
use App\Http\Controllers\admin\DashboardController;

Route::get('/', function () { return view('welcome'); })->name('home');


//Route pour la redirection en fonction des role
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('dashboard/parcelles/create', [ParcelleController::class, 'create'])->name('parcelles.create');
    Route::post('dashboard/parcelles/store', [ParcelleController::class, 'store'])->name('parcelles.store');
    Route::get('dashboard/parcelles', [ParcelleController::class, 'index'])->name('parcelles.index');
    Route::get('dashboard/parcelles/{id}/edit', [ParcelleController::class, 'edit'])->name('parcelles.edit');
    Route::put('dashboard/parcelles/{id}', [ParcelleController::class, 'update'])->name('parcelles.update');
    Route::delete('dashboard/parcelles/{id}', [ParcelleController::class, 'destroy'])->name('parcelles.destroy');
    Route::get('dashboard/parcelles/{parcelle}', [ParcelleController::class, 'show'])->name('parcelles.show');
    Route::get('dashboard/parcelles/{id}/rapport', [InterventionsController::class, 'rapportParcelle'])->name('parcelles.rapport');
    Route::get('dashboard/parcelles/{id}/rapport/pdf', [InterventionsController::class, 'rapportParcellePdf'])->name('parcelles.rapport.pdf');


// Liste des interventions
    Route::get('/interventions', [InterventionsController::class, 'index'])->name('interventions.index');

// Formulaire de création d'une intervention
    Route::get('/interventions/create', [InterventionsController::class, 'create'])->name('interventions.create');

// Enregistrer une nouvelle intervention
    Route::post('/interventions', [InterventionsController::class, 'store'])->name('interventions.store');


    Route::get('/interventions/filtered', [InterventionsController::class, 'filtered'])->name('interventions.filtered');

    Route::resource('users', UserController::class);

// Formulaire de modification d'une intervention
    Route::get('/interventions/{id}/edit', [InterventionsController::class, 'edit'])->name('interventions.edit');

// Mettre à jour une intervention existante
    Route::put('/interventions/{id}', [InterventionsController::class, 'update'])->name('interventions.update');

// Supprimer une intervention
    Route::delete('/interventions/{id}', [InterventionsController::class, 'destroy'])->name('interventions.destroy');

    Route::get('/profile', [App\Http\Controllers\ProfilController::class, 'show'])->name('profile.show');
    Route::put('/profile', [App\Http\Controllers\ProfilController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfilController::class, 'updatePassword'])->name('profile.password.update');
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route for login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'store']);

// Route for registration
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

//Route logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');




