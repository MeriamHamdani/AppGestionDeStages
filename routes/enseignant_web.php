<?php
use Illuminate\Support\Facades\Route;


Route::prefix('enseignant')->group(function () {
    Route::view('/', 'enseignant.dashboard')->name('dash_enseignant');
    Route::view('/encadrement/demandes', 'enseignant.encadrement.demandes')->name('demandes');
    //Route::view('/stage/demande-refuse', 'etudiant.stage.demande_refuse')->name('demande_refuse');
});
