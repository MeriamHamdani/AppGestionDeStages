<?php

use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DepotMemoireController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\StageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CahierStageController;


Route::middleware(['auth','role:enseignant'])->group(function(){
    Route::prefix('enseignant')->group(function () {

        Route::get('profil', [EnseignantController::class,'editProfil'])->name('profil_ens');
        Route::patch('coordonnees', [EnseignantController::class,'updateProfil'])->name('update_profil_ens');

        Route::get('/encadrement/liste-demandes', [StageController::class,'liste_demandes_pour_enseignant'])->name('liste_demandes');
        Route::get('/encadrement/liste-demandes/accepter-demande/{stage}', [StageController::class,'confirmer_demande_enseignant'])->name('confirmer_demande_enseignant');
        Route::get('/encadrement/liste-stages-actifs',[EnseignantController::class,'liste_stages_actifs'] )->name('liste_stages_actifs');
        Route::view('/encadrement/liste-stages-actifs/cahier-stage-etud','enseignant.encadrement.cahier_stage_etud' )->name('cahier_stage_etud');
        Route::get('/encadrement/liste-stages-actifs/cahier-stage-etud/{cahier}', [CahierStageController::class,'show_for_enc'])->name('detail_cahier_stage');
        Route::get('/encadrement/liste-stages-actifs/details-stage/{stage}',[EnseignantController::class,'details_stage'] )->name('details_stage');

        Route::view('/paiement/liste-stages-paye','enseignant.paiement.liste_stages_paye' )->name('liste_stages_paye');
        Route::view('/paiement/liste-stages-non-paye','enseignant.paiement.liste_stages_non_paye' )->name('liste_stages_non_paye');


        Route::view('/encadrement/demandes', 'enseignant.encadrement.demandes')->name('demandes');

        Route::get('/depot/traiter-depot', [DepotMemoireController::class,'liste_demandes_depot_enseignant'])->name('depots');
        Route::get('/depot/memoire/{memoire}/{code_classe}', [DepotMemoireController::class, 'telecharger_memoire'])->where('memoire', '[A-Za-z0-9\-\_\.]+')->name('telecharger_memoire_ens');
        Route::get('/depot/traiter-depot/details-depot/{demande_depot}',[CommentaireController::class, 'index'])->name('details_depot');
        Route::post('/depot/traiter-depot/details-depot/{demande_depot}/refuser',[CommentaireController::class, 'store'])->name('refuser_depot');
        Route::get('/depot/traiter-depot/details-depot/{demande_depot}/valider',[DepotMemoireController::class, 'valider_par_encadrant'])->name('valider_depot');


        Route::view('/soutenance/liste-role-encadrant', 'enseignant.soutenance.role_encadrant')->name('role_encadrant');
        Route::view('/soutenance/liste-role-membre-jury', 'enseignant.soutenance.role_membre_jury')->name('role_membre_jury');
        Route::view('/soutenance/info', 'enseignant.soutenance.info_soutenance')->name('info_soutenance_ens');
        //Route::view('/stage/demande-refuse', 'etudiant.stage.demande_refuse')->name('demande_refuse');
    });
});
