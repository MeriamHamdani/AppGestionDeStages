<?php
use Illuminate\Support\Facades\Route;


Route::prefix('enseignant')->group(function () {
    Route::view('/', 'enseignant.dashboard')->name('dash_enseignant');
    Route::view('/encadrement/liste-demandes', 'enseignant.encadrement.Liste_demandes_encadrement')->name('liste_demandes');
    Route::view('/encadrement/liste-stages-actifs','enseignant.encadrement.Liste_stages_actifs' )->name('liste_stages_actifs');
    Route::view('/paiement/liste-stages-paye','enseignant.paiement.liste_stages_paye' )->name('liste_stages_paye');
    Route::view('/paiement/liste-stages-non-paye','enseignant.paiement.liste_stages_non_paye' )->name('liste_stages_non_paye');
});