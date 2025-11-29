<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\LIVREController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\RetardController;



Route::post('/login', [App\Http\Controllers\authController::class, 'login'])->name('auth.login');
Route::post('/register', [App\Http\Controllers\authController::class, 'createUser'])->name('auth.register');


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/profile', [App\Http\Controllers\authController::class, 'profile'])->name('auth.profile');
        Route::post('/logout', [App\Http\Controllers\authController::class, 'logout'])->name('auth.logout');
        Route::post('/refresh', [App\Http\Controllers\authController::class, 'refreshToken'])->name('auth.refresh');
    });
    Route::middleware('can:gerer users')->group(function () {
        Route::apiResource('user', App\Http\Controllers\UserController::class);
        Route::prefix('roles')->group(function () {
            Route::apiResource('/', App\Http\Controllers\RoleController::class)->name('','roles');
            Route::post('assign-roles', [App\Http\Controllers\RoleController::class, 'assignRoles'])->name('roles.assign');
            Route::delete('revoke-roles', [App\Http\Controllers\RoleController::class, 'revokeRoles'])->name('roles.revoke');
            Route::post('assign-permissions', [App\Http\Controllers\RoleController::class, 'assignPermissions'])->name('roles.permissions.assign');
            Route::delete('revoke-permissions', [App\Http\Controllers\RoleController::class, 'revokePermissions'])->name('roles.permissions.revoke');
            Route::get('roles', [App\Http\Controllers\RoleController::class, 'getAllRoles'])->name('roles.all');
            Route::get('permissions', [App\Http\Controllers\RoleController::class, 'getAllPermissions'])->name('roles.permissions.all');
        });

    });
    Route::middleware('can:gerer etudiants')->group(function () {
        Route::apiResource('etudiant', App\Http\Controllers\EtudiantController::class)->name('','etudiant');
    });
    Route::middleware('can:gerer personnels')->group(function () {
        Route::apiResource('personnel', App\Http\Controllers\PersonnelController::class)->name('','personnel');
    });
    Route::middleware('can:gerer livres')->group(function () {
        Route::apiResource('livre', App\Http\Controllers\LIVREController::class)->name('','livres');
        Route::get('livre-by-genre/{genre}', [App\Http\Controllers\LIVREController::class, 'getLivresByGenre'])->name('livre.by.genre');
        Route::get('livre-by-author/{author}', [App\Http\Controllers\LIVREController::class, 'getLivresByAuthor'])->name('livre.by.author');
        Route::get('search-livre/{query}', [App\Http\Controllers\LIVREController::class, 'searchLivres'])->name('livre.search');
    });
    Route::middleware('can:gerer les emprunts, gerer  les details emprunts')->group(function () {
        Route::apiResource('emprunt', App\Http\Controllers\EmpruntController::class);
        Route::get('emprunt-by-etudiant/{etudiant}', [App\Http\Controllers\EmpruntController::class, 'getEmpruntsByEtudiant'])->name('emprunt.by.etudiant');
        Route::get('emprunt-by-livre/{livre}', [App\Http\Controllers\EmpruntController::class, 'getEmpruntsByLivre'])->name('emprunt.by.livre');
        Route::get('emprunt-by-date/{date}', [App\Http\Controllers\EmpruntController::class, 'getEmpruntsByDate'])->name('emprunt.by.date');
    });
    Route::middleware('can:gerer les retards')->group(function () {
        Route::apiResource('retard', App\Http\Controllers\RetardController::class);
        Route::get('retard-by-etudiant/{etudiant}', [App\Http\Controllers\RetardController::class, 'getRetardsByEtudiant'])->name('retard.by.etudiant');
        Route::get('retard-by-date/{date}', [App\Http\Controllers\RetardController::class, 'getRetardsByDate'])->name('retard.by.date');
    });
});
