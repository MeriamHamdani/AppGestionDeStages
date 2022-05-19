<?php

use App\Http\Controllers\CahierStageController;
use App\Http\Controllers\EntrepriseController;


use App\Http\Controllers\EtudiantController;

use App\Http\Controllers\StageController;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:etudiant'])->group(function () {
    Route::prefix('etudiant')->group(function () {

        Route::get('profil', [EtudiantController::class, 'editProfil'])->name('profil_etd');
        Route::patch('coordonnees', [EtudiantController::class, 'updateProfil'])->name('update_profil_etd');

        Route::view('/', 'etudiant.dashboard')->name('dash_etudiant');
        Route::get('/stage/demandes-stages', [EtudiantController::class, 'mes_demandes_stages'])->name('demandes_stages');
        Route::get('/stage/liste-stages', [EtudiantController::class, 'mes_demandes_confirmer'])->name('liste_stages');
        //Route::view('/stage/liste-stages', 'etudiant.stage.liste_stages')->name('liste_stages');
        Route::view('/stage/demande-refuse', 'etudiant.stage.demande_refuse')->name('demande_refuse');
        Route::view('/stage/demande-refuse', 'etudiant.stage.demande_refuse')->name('demande_refuse');
        Route::view('/stage/demande-accepte', 'etudiant.stage.demande_accepte')->name('demande_accepte');
        Route::view('/stage/demande-en-cours', 'etudiant.stage.demande_en_cours')->name('demande_en_cours');
        Route::view('/stage/pas-de-demande', 'etudiant.stage.pas_de_demande')->name('pas_de_demande');

        Route::get('/stage/demander-stage', [StageController::class,'create'])->name('demande_stage');
        Route::post('/stage/demander', [StageController::class,'store'])->name('demander_stage');
        Route::get('/stage/liste-stages/{demande}', [StageController::class,'download_lettre_affect'])
                                                            ->name('telecharger_lettre_affect');
        Route::get('/stage/gerer-cahier-stage', [CahierStageController::class,'index'])->name('gestion_cahier_stage');
        Route::view('/stage/cahier-stage', 'etudiant.stage.cahier_stage')->name('cahier_stage');


        Route::get('entreprise/liste-entreprises', [EntrepriseController::class, 'indexEtd'])->name('liste_entreprises');
        Route::get('entreprise/ajouter-entreprise', [EntrepriseController::class, 'createEtd'])->name('ajout_entreprise');
        Route::post('entreprise/ajouter-entreprise', [EntrepriseController::class, 'storeEtd'])->name('sauvegarder_entreprise');
        // Route::post('entreprise/ajouter', /**/[EntrepriseController::class,'store'])->name('entreprise.store');
        //Route::get('entreprise/modifier-entreprise/{id}', [EntrepriseController::class,'edit'])->whereNumber('id')->name('modifier_entreprise');
        //Route::post('entreprise/modifier/{id}', [EntrepriseController::class,'update'])->whereNumber('id')->name('entreprise.update');
        //Route::get('entreprise/supprimer-entreprise/{id}', [EntrepriseController::class, 'destroy'])->whereNumber('id')->name('entreprise.destroy');

        // Route::view('/entreprise/liste-entreprises', 'etudiant.entreprise.liste_entreprises')->name('liste_entreprises');

        //  Route::view('/entreprise/liste-entreprises', 'etudiant.entreprise.liste_entreprises')->name('liste_entreprises');
        // Route::view('/entreprise/ajouter-entreprise', 'etudiant.entreprise.ajouter_entreprise')->name('ajouter-entreprise');

        Route::view('/depot/gerer-depot', 'etudiant.depot.depot_memoire')->name('depot');
        Route::view('/depot/deposer', 'etudiant.depot.deposer')->name('deposer');
        Route::view('/depot/gerer-depot/remarques-encadrant', 'etudiant.depot.remarques_encadrant')->name('remarques_encadrant');


        Route::view('/soutenance/liste_soutenances', 'etudiant.soutenance.liste_soutenances')->name('liste_soutenances');
        Route::view('/soutenance/info', 'etudiant.soutenance.info_soutenance')->name('info_soutenance');

        Route::get('/stage/fiche_demande/{fiche_demande}', [StageController::class, 'telecharger_fiche_demande'])->where('fiche_demande', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_demande');
      /*  Route::get('/stage/fiche_assurance/{fiche_assurance}', [StageController::class, 'telecharger_fiche_assurance'])->where('fiche_assurance', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_assurance');
        Route::get('/stage/fiche_2Dinars/{fiche_2Dinars}', [StageController::class, 'telecharger_fiche_2Dinars'])->where('fiche_2Dinars', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_2Dinars');*/

    });
});
