<?php
use Illuminate\Support\Facades\Route;


Route::prefix('enseignant')->group(function () {
    Route::view('/', 'enseignant.dashboard')->name('dash_enseignant');

    Route::view('/encadrement/liste-demandes', 'enseignant.encadrement.Liste_demandes_encadrement')->name('liste_demandes');
    Route::view('/encadrement/liste-stages-actifs','enseignant.encadrement.Liste_stages_actifs' )->name('liste_stages_actifs');
    Route::view('/paiement/liste-stages-paye','enseignant.paiement.liste_stages_paye' )->name('liste_stages_paye');
    Route::view('/paiement/liste-stages-non-paye','enseignant.paiement.liste_stages_non_paye' )->name('liste_stages_non_paye');


    Route::view('/encadrement/demandes', 'enseignant.encadrement.demandes')->name('demandes');

    Route::view('/depot/traiter-depot', 'enseignant.depot.liste-depots')->name('depots');

    Route::view('/soutenance/liste-role-encadrant', 'enseignant.soutenance.role_encadrant')->name('role_encadrant');
    Route::view('/soutenance/liste-role-membre-jury', 'enseignant.soutenance.role_membre_jury')->name('role_membre_jury');
    Route::view('/soutenance/info', 'enseignant.soutenance.info_soutenance')->name('info_soutenance');
    //Route::view('/stage/demande-refuse', 'etudiant.stage.demande_refuse')->name('demande_refuse');
});