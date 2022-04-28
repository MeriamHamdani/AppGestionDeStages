<?php


use App\Imports\EnseignantsImport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\AnneeUniversitaireController;
use App\Http\Controllers\TypeStageController;
use Maatwebsite\Excel\Facades\Excel;

/*Route::prefix('admin')->group(function () {
});*/
//-------------------------------------------------------------------------------------------------
Route::middleware(['auth','role:admin|superadmin'])->group(function(){
    Route::prefix('admin')->group(function () {
        // -----------------------------------ADMINISTRATION-------------------------------------

        Route::get('administration/liste-admin', [AdminController::class,'index'])->name('liste_admin');
        Route::view('administration/ajouter-admin', 'admin.administration.ajouter_admin')->name('ajouter_admin');
        Route::post('administration/ajouter-admin', [AdminController::class,'store'])->name('ajout_admin');
        Route::view('administration/modifier-admin', 'admin.administration.modifier_infos_admin')->name('modifier_admin');
        Route::get('administration/modifier-admin/{id_admin}', [AdminController::class,'edit'])->whereNumber('id_admin')->name('admin.edit');
        Route::patch('administration/modifier/{id_admin}', [AdminController::class,'update'])->whereNumber('id_admin')->name('admin.update');
        Route::get('administration/activer-desactiver-admin/{id}', [AdminController::class,'activer_desactiver'])->whereNumber('id')->name('activer_desactiver_admin');

        Route::get('administration/supprimer-admin/{id_user}', [AdminController::class,'destroy'])->whereNumber('id_admin')->name('admin.destroy');

        // ----------------------------------STAGE-----------------------------------

        Route::prefix('stage/demandes-stage')->group(function () {
            Route::view('1ere-2eme-licence-master', 'admin.stage.listes_demandes_stage.sv12lm')->name('demandes_stage.sv12lm');
            Route::view('2eme-licence', 'admin.stage.listes_demandes_stage.so2l')->name('demandes_stage.so2l');
            Route::view('3eme-licence', 'admin.stage.listes_demandes_stage.so3l')->name('demandes_stage.so3l');
            Route::view('3eme-licence-info', 'admin.stage.listes_demandes_stage.so3Info')->name('demandes_stage.so3Info');
            Route::view('2eme-master', 'admin.stage.listes_demandes_stage.so2m')->name('demandes_stage.so2m');
            Route::view('modifier', 'admin.stage.listes_demandes_stage.modifier_demande_stage')->name('demandes_stage.modifier_demande');
        });
        Route::view('stage/gerer-cahiers-stages', 'admin.stage.gerer_cahiers_stages')->name('gerer_cahiers_stages');
        Route::view('stage/cahier-de-stage', 'admin.stage.cahier_de_stage')->name('cahier_de_stage');

        //---------------------------------- ETABLISSEMENT--------------------------

        // ***************************** E N S E I G N A N T ********************

        Route::get('etablissement/liste-enseignants', [EnseignantController::class,'index'])->name('liste_enseignants');
        Route::get('etablissement/ajouter-enseignant', [EnseignantController::class,'create'])->name('ajouter_enseignant');
        Route::post('etablissement/ajouter-enseignant', [EnseignantController::class,'store'])->name('sauvegarder_enseignant');
        Route::get('etablissement/modifier-enseignant/{enseignant}', [EnseignantController::class,'edit'])->name('modifier_enseignant');
        Route::patch('etablissement/update-ens/{enseignant}', [EnseignantController::class,'update'])->name('update_enseignant');
        Route::get('etablissement/supprimer-enseignant/{enseignant}', [EnseignantController::class,'destroy'])->name('supprimer_enseignant');
        Route::post('import/liste-enseignants',[EnseignantController::class,'importData'])->name('file-import');
        Route::post('export/liste-enseignants', [EnseignantController::class, 'exportData'])->name('file-export');

        // ***************************** E T U D I A N T ********************

        Route::get('etablissement/liste-etudiants', [EtudiantController::class,'index'])->name('liste_etudiants');
        Route::get('etablissement/ajouter-etudiant', [EtudiantController::class,'create'])->name('ajouter_etudiant');
        Route::post('etablissement/ajouter-etudiant', [EtudiantController::class,'store'])->name('sauvegarder_etudiant');
        Route::get('etablissement/modifier-etudiant/{etudiant}', [EtudiantController::class,'edit'])->name('modifier_etudiant');
        Route::patch('etablissement/update-etd/{etudiant}', [EtudiantController::class,'update'])->name('update_etudiant');
        Route::get('etablissement/supprimer-etudiant/{etudiant}', [EtudiantController::class,'destroy'])->name('supprimer_etudiant');

        // ***************************** D E P A R T E M E N T  ***********************

        Route::resource('departement', DepartementController::class);
        Route::get('etablissement/liste-departements', [DepartementController::class,'showAll'])->name('liste_departements');
        //Route::view('etablissement/modifier-departement', 'admin.etablissement.departement.modifier_departement')->name('modifier_departement');
        //Route::get('etablissement/ajouter-departement', [DepartementController::class,'create'])->name('create_departement');
        //Route::post('etablissement/liste-departements/ajouter-departement',[DepartementController::class,'store'])->name('store_departement');
        Route::get('/etablissement/modifier-departement/{id}', [DepartementController::class, 'edit'])->whereNumber('id')->name('departement.edit');
        Route::patch('/etablissement/update/{id}', [DepartementController::class, 'update'])->whereNumber('id')->name('departement.update');
        Route::get('/etablissement/supprimer-departement/{id}', [DepartementController::class, 'destroy'])->whereNumber('id')->name('departement.destroy');


        // ENTRPRISE
        Route::get('entreprise/liste-entreprises', [EntrepriseController::class,'index'])->name('list_entreprises');
        Route::view('entreprise/ajouter-entreprise', 'admin.entreprise.ajouter_entreprise')->name('ajouter_entreprise');
        Route::post('entreprise/ajouter', [EntrepriseController::class,'store'])->name('entreprise.store');
        Route::get('entreprise/modifier-entreprise/{id}', [EntrepriseController::class,'edit'])->whereNumber('id')->name('modifier_entreprise');
        Route::post('entreprise/modifier/{id}', [EntrepriseController::class,'update'])->whereNumber('id')->name('entreprise.update');
        Route::get('entreprise/supprimer-entreprise/{id}', [EntrepriseController::class, 'destroy'])->whereNumber('id')->name('entreprise.destroy');


        // ******************************** S P E C I A L I T E ************************

        Route::get('etablissement/liste-specialites', [SpecialiteController::class, 'index'])->name('liste_specialites');
        Route::get('etablissement/ajouter-specialite', [SpecialiteController::class, 'create'])->name('ajouter_specialite');
        Route::post('etablissement/ajouter-specialite', [SpecialiteController::class, 'store'])->name('sauvegarder_specialite');
        Route::get('etablissement/modifier-specialite/{specialite}', [SpecialiteController::class, 'edit'])->name('modifier_specialite');
        Route::patch('etablissement/update-spec/{specialite}', [SpecialiteController::class,'update'])->name('update_specialite');
        Route::get('etablissement/supprimer-specialite/{specialite}', [SpecialiteController::class,'destroy'])->name('supprimer_specialite');

        // ************************************* C L A S S E ******************************

        Route::get('etablissement/liste-classes', [ClasseController::class, 'index'])->name('liste_classes');
        Route::get('etablissement/ajouter-classe', [ClasseController::class, 'create'])->name('ajouter_classe');
        Route::post('etablissement/ajouter-classe', [ClasseController::class, 'store'])->name('sauvegarder_classe');
        Route::get('etablissement/modifier-classe/{classe}', [ClasseController::class, 'edit'])->name('modifier_classe');
        Route::patch('etablissement/update-cls/{classe}', [ClasseController::class,'update'])->name('update_classe');
        Route::get('etablissement/supprimer-classe/{classe}', [ClasseController::class,'destroy'])->name('supprimer_classe');





        //---------------------------------------DEPOT-----------------------------


        Route::view('depot/gerer-depot', 'admin.depot.gerer_depot')->name('gerer_depot');

        //-----------------------------------------SOUTENANCE----------------------------

        Route::view('soutenance/planifier', 'admin.soutenance.planifier_soutenance')->name('planifier_soutenance');
        Route::view('soutenance/liste', 'admin.soutenance.liste_soutenances')->name('list_soutenances');
        Route::view('soutenance/evaluer', 'admin.soutenance.evaluer_soutenance')->name('evaluer_soutenance');

        //---------------------------------------PAIEMENT-------------------------------------

        Route::view('paiement/details-paiement-ens', 'admin.paiement.details_paiement_ens')->name('details_paiement_ens');

        //-----------------------------------------CONFIGURATION---------------------------------

        Route::prefix('configuration/generale')->group(function () {
            Route::get('coordonnees', [EtablissementController::class,'edit'])->name('coordonnees');
            Route::post('coordonnees', [EtablissementController::class,'update'])->name('valider_coordonnees');
            Route::view('montant-selon-grade', 'admin.configuration.generale.montant_selon_grade')->name('montant_selon_grade');
            Route::view('dates-stages', 'admin.configuration.generale.dates_stages')->name('dates_stages');
            Route::view('liste-grille', 'admin.configuration.generale.liste_grille')->name('liste_grille');
            Route::view('config-grille', 'admin.configuration.generale.configuration_grille')->name('configurer_grille');

            Route::get('typeStage-classe/ajouter',[TypeStageController::class,'index'])->name('typeStage.index');
            Route::get('typeStage-classe/store',[TypeStageController::class,'store'])->name('typeStage.store');
        });
        Route::get('configuration/annee-universitaire', [AnneeUniversitaireController::class, 'create'])->name('config_annee_universitaire');
        Route::post('configuration/ajouter-annee-universitaire', [AnneeUniversitaireController::class, 'store'])->name('ajouter_annee_universitaire');



    });
    //--------------------------------------------------------------------------------------------


    Route::prefix('dashboard')->group(
        function () {
        Route::view('dashboard-02', 'admin.dashboard.dashboard-02')->name('dashboard-02');
        Route::view('default-dashboard', 'admin.dashboard.default')->name('default_dash');
    }
    );
});
