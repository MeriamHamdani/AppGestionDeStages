<?php

use App\Models\Soutenance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StageController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\CahierStageController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DepotMemoireController;
use App\Http\Controllers\PaiementEnseignantController;


Route::middleware(['auth','role:enseignant|encadrant'])->group(function(){
    Route::prefix('enseignant')->group(function () {

        Route::get('profil', [EnseignantController::class,'editProfil'])->name('profil_ens');
        Route::patch('coordonnees', [EnseignantController::class,'updateProfil'])->name('update_profil_ens');

        Route::get('/encadrement/liste-demandes', [StageController::class,'liste_demandes_pour_enseignant'])->name('liste_demandes');
        Route::get('/encadrement/liste-demandes/accepter-demande/{stage}', [StageController::class,'confirmer_demande_enseignant'])->name('confirmer_demande_enseignant');
        Route::get('/encadrement/liste-demandes/refuser-demande/{stage}',[StageController::class,'refuser_demande_enseignant'])->name('refuser_demande_enseignant');

        Route::get('/encadrement/liste-stages-actifs',[EnseignantController::class,'liste_stages_actifs'] )->name('liste_stages_actifs');
        Route::view('/encadrement/liste-stages-actifs/cahier-stage-etud','enseignant.encadrement.cahier_stage_etud' )->name('cahier_stage_etud');
        Route::get('/encadrement/liste-stages-actifs/cahier-stage-etud/{cahier}', [CahierStageController::class,'show_for_enc'])->name('detail_cahier_stage');
        Route::get('/encadrement/liste-stages-actifs/details-stage/{stage}',[EnseignantController::class,'details_stage'] )->name('details_stage');
        Route::get('/encadrement/liste-stages-actifs/telecharge-fiche-encadrement/{stage}',[StageController::class,'download_fiche_encadrement'] )->name('telecharger_fiche_enc');

        Route::get('/payement/stages-frais',[PaiementEnseignantController::class,'stagesEtFraisEncadrement'] )->name('liste_stages_a_paye');
        Route::get('/payement/stages-frais',[PaiementEnseignantController::class,'stagesEtFraisEncadrement'] )->name('liste_stages_a_paye');



        Route::view('/encadrement/demandes', 'enseignant.encadrement.demandes')->name('demandes');

        Route::get('/depot/traiter-depot', [DepotMemoireController::class,'liste_demandes_depot_enseignant'])->name('depots');
        Route::get('/depot/memoire/{stage}/{memoire}/{code_classe}', [DepotMemoireController::class, 'telecharger_memoire'])->where('memoire', '[A-Za-z0-9\-\_\.]+')->name('telecharger_memoire_ens');
        Route::get('/depot/traiter-depot/details-depot/{demande_depot}',[CommentaireController::class, 'index'])->name('details_depot');
        Route::post('/depot/traiter-depot/details-depot/{demande_depot}/refuser',[CommentaireController::class, 'store'])->name('refuser_depot');
        Route::get('/depot/traiter-depot/details-depot/{demande_depot}/valider',[DepotMemoireController::class, 'valider_par_encadrant'])->name('valider_depot');

        Route::get('/soutenance/liste-role-encadrant',  [SoutenanceController::class,'soutenance_encadrant'])->name('soutenance_role_encadrant');
        Route::get('/soutenance/liste-role-membre-jury', [SoutenanceController::class,'soutenance_membre_jury'])->name('soutenance_role_membre_jury');
        Route::get('/soutenance/liste-role-membre-jury/grille-evaluation/{soutenance}', [SoutenanceController::class,'telecharger_grille_evaluation'])->name('telecharger_grille_evaluation');
        Route::post('/soutenance/liste-role-membre-jury/evaluer', [SoutenanceController::class,'evaluer_soutenance_par_president'])->name('evaluer_soutenance_par_president');
        Route::get('/soutenance/info/{soutenance}', [SoutenanceController::class,'details_soutenance_encadrant'])->name('info_soutenance_ens');
        Route::get('/soutenance/info/{soutenance}', [SoutenanceController::class,'details_soutenance_membre'])->name('info_soutenance_membre');
        Route::get('/soutenance/telechargement-memoire/{stage_id}',[SoutenanceController::class,'telecharger_memoire'])->name('telecharger_memoire');
    });
});
