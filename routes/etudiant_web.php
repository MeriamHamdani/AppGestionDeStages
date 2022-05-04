<?php

use App\Http\Controllers\StageController;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:etudiant'])->group(function(){
    Route::prefix('etudiant')->group(function () {
        Route::view('/', 'etudiant.dashboard')->name('dash_etudiant');
        Route::view('/stage/demandes-stages', 'etudiant.stage.demandes_stages')->name('demandes_stages');
        Route::view('/stage/demande-refuse', 'etudiant.stage.demande_refuse')->name('demande_refuse');
        Route::view('/stage/demande-refuse', 'etudiant.stage.demande_refuse')->name('demande_refuse');
        Route::view('/stage/demande-accepte', 'etudiant.stage.demande_accepte')->name('demande_accepte');
        Route::view('/stage/demande-en-cours', 'etudiant.stage.demande_en_cours')->name('demande_en_cours');
        Route::view('/stage/pas-de-demande', 'etudiant.stage.pas_de_demande')->name('pas_de_demande');
        Route::get('/stage/demander-stage', [StageController::class,'create'])->name('demande_stage');
        Route::post('/stage/demander', [StageController::class,'store'])->name('demander_stage');
        Route::get('stage/{fiche_demande}', function($fiche_demande)
            {

                $file_path = public_path() .'/storage/fiches_demande/'. $fiche_demande;
                if (file_exists($file_path))
                    {
                    return Response::download($file_path, $fiche_demande);
                    }
                else
                    {
                    //Error
                    exit('fiche de demande inexistante !');
                    }
            })->where('fiche_demande', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_demande');

        //Route::get('/stage/telecharger-fiche/{fiche_demande}', [StageController::class,'download'])->name('telecharger_fiche_demande');
        Route::view('/stage/liste-stages', 'etudiant.stage.liste_stages')->name('liste_stages');
        Route::view('/stage/gerer-cahier-stage', 'etudiant.stage.gestion_cahier_stage')->name('gestion_cahier_stage');
        Route::view('/stage/cahier-stage', 'etudiant.stage.cahier_stage')->name('cahier_stage');


        Route::view('/entreprise/liste-entreprises', 'etudiant.entreprise.liste_entreprises')->name('liste_entreprises');
        Route::view('/entreprise/ajouter-entreprise', 'etudiant.entreprise.ajouter_entreprise')->name('ajouter-entreprise');

        Route::view('/depot/gerer-depot', 'etudiant.depot.depot_memoire')->name('depot');
        Route::view('/depot/deposer', 'etudiant.depot.deposer')->name('deposer');
        Route::view('/depot/gerer-depot/remarques-encadrant', 'etudiant.depot.remarques_encadrant')->name('remarques_encadrant');


        Route::view('/soutenance/liste_soutenances', 'etudiant.soutenance.liste_soutenances')->name('liste_soutenances');
        Route::view('/soutenance/info', 'etudiant.soutenance.info_soutenance')->name('info_soutenance');
    });
});
/*Route::prefix('etudiant')->group(function () {*/


/*});*/