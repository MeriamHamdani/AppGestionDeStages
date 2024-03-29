<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepotMemoireController;
use App\Http\Controllers\FraisEncadrementController;
use App\Imports\EnseignantsImport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnneeUniversitaireController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\TypeStageController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\CahierStageController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EtablissementController;




/*Route::prefix('admin')->group(function () {
});*/
//-------------------------------------------------------------------------------------------------
Route::middleware(['auth', 'role:admin|superadmin', 'clearClasse'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/encad', [DashboardController::class, 'encadrementChart'])->name('encadrementChart');
        Route::get('dashboard/ts', [DashboardController::class, 'typeSujetChart'])->name('typeSujetChart');
        Route::get('dashboard/sv', [DashboardController::class, 'stagesVolontairesChart'])->name('stagesVolontairesChart');
        Route::get('dashboard/cl', [DashboardController::class, 'etdsVsNiveauChart'])->name('etdsVsNiveauChart');
        Route::get('profil', [AdminController::class, 'editProfil'])->name('profil');
        Route::patch('coordonnees', [AdminController::class, 'updateProfil'])->name('update_profil');
        // -----------------------------------ADMINISTRATION-------------------------------------

        Route::get('administration/liste-admin', [AdminController::class, 'index'])->name('liste_admin');
        Route::view('administration/ajouter-admin', 'admin.administration.ajouter_admin')->name('ajouter_admin');
        Route::post('administration/ajouter-admin', [AdminController::class, 'store'])->name('ajout_admin');
        Route::view('administration/modifier-admin', 'admin.administration.modifier_infos_admin')->name('modifier_admin');
        Route::get('administration/modifier-admin/{id_admin}', [AdminController::class, 'edit'])->whereNumber('id_admin')->name('admin.edit');
        Route::patch('administration/modifier/{id_admin}', [AdminController::class, 'update'])->whereNumber('id_admin')->name('admin.update');
        Route::get('administration/activer-desactiver-admin/{id}', [AdminController::class, 'activer_desactiver'])->whereNumber('id')->name('activer_desactiver_admin');

        Route::get('administration/supprimer-admin/{id_user}', [AdminController::class, 'destroy'])->whereNumber('id_admin')->name('admin.destroy');

        // ----------------------------------STAGE-----------------------------------

        Route::prefix('stage/demandes-stage')->group(function () {
            Route::post('filtre', [AnneeUniversitaireController::class, 'filtre_par_an'])->name('filtre_par_an');
            Route::get('1ere-licence-master', [StageController::class, 'list_vol_1ere_licence_1ere_master'])->name('demandes_stage.sv1lm');
            Route::get('stage/valider/{stage}', [StageController::class, 'valider_stage_non_terminale'])->name('valider_stage_non_terminale');
            Route::get('stage/invalider/{stage}', [StageController::class, 'invalider_stage_non_terminale'])->name('invalider_stage_non_terminale');
            Route::get('2eme-licence-info', [StageController::class, 'list_oblig_2eme_licence_info'])->name('demandes_stage.so2lInfo');
            Route::get('2eme-licence', [StageController::class, 'list_oblig_2eme_licence_non_info'])->name('demandes_stage.so2l');
            Route::get('3eme-licence', [StageController::class, 'list_oblig_3eme_licence_non_info'])->name('demandes_stage.so3l');
            Route::get('3eme-licence-info', [StageController::class, 'list_oblig_3eme_licence_info'])->name('demandes_stage.so3Info');
            Route::get('2eme-master', [StageController::class, 'list_oblig_2eme_master'])->name('demandes_stage.so2m');
            Route::get('modifier/{stage_id}', [StageController::class, 'modifier_demande'])->name('demandes_stage.modifier_demande');
            Route::patch('modifier/{stage_id}', [StageController::class, 'edit'])->name('edit');
            Route::get('confirmer/{stage_id}', [StageController::class, 'confirmer_demande'])->name('confirmer_demande');
            Route::get('refuser/{stage_id}', [StageController::class, 'refuser_demande'])->name('refuser_demande');
            Route::get('ficheDemande/{stage}/{fiche_demande}/{code_classe}',[StageController::class, 'telecharger_fiche_demande'])->where('fiche_demande', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_demande');
            Route::get('fiche2Dinars/{stage}/{fiche_2Dinars}/{code_classe}', [StageController::class, 'telecharger_fiche_2Dinars'])->where('fiche_2Dinars', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_2Dinars');
            Route::get('ficheAssurance/{stage}/{fiche_assurance}/{code_classe}', [StageController::class, 'telecharger_fiche_assurance'])->where('fiche_assurance', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_assurance');
        });
        Route::get('stage/gerer-cahiers-stages', [CahierStageController::class, 'all_cahier_stage'])->name('gerer_cahiers_stages');
        Route::get('stage/cahier-stage/{cahier}', [CahierStageController::class, 'show'])->name('cahier_de_stage');
        Route::get('stage/gerer-cahier-stage/telecharger/{cahier}', [CahierStageController::class, 'download_all_cs'])->name('download_all_cs');
        Route::get('/stage/gerer-cahier-stage/telecharger/{semaine}/{taches}', [TacheController::class, 'telecharger'])->name('telecharger_cahier');
        //---------------------------------- ETABLISSEMENT--------------------------

        // ***************************** E N S E I G N A N T ********************

        Route::get('etablissement/liste-enseignants', [EnseignantController::class, 'index'])->name('liste_enseignants');
        Route::get('etablissement/ajouter-enseignant', [EnseignantController::class, 'create'])->name('ajouter_enseignant');
        Route::post('etablissement/ajouter-enseignant', [EnseignantController::class, 'store'])->name('sauvegarder_enseignant');
        Route::get('etablissement/modifier-enseignant/{enseignant}', [EnseignantController::class, 'edit'])->name('modifier_enseignant');
        Route::patch('etablissement/update-ens/{enseignant}', [EnseignantController::class, 'update'])->name('update_enseignant');
        Route::get('etablissement/supprimer-enseignant/{enseignant}', [EnseignantController::class, 'destroy'])->name('supprimer_enseignant');
        Route::post('import/liste-enseignants', [EnseignantController::class, 'importData'])->name('file-import');
        Route::post('export/liste-enseignants', [EnseignantController::class, 'exportData'])->name('file-export');

        // ***************************** E T U D I A N T ********************

        Route::get('etablissement/liste-etudiants', [EtudiantController::class, 'index'])->name('liste_etudiants');
        Route::get('etablissement/ajouter-etudiant', [EtudiantController::class, 'create'])->name('ajouter_etudiant');
        Route::post('etablissement/ajouter-etudiant', [EtudiantController::class, 'store'])->name('sauvegarder_etudiant');
        Route::get('etablissement/modifier-etudiant/{etudiant}', [EtudiantController::class, 'edit'])->name('modifier_etudiant')->middleware('verifierAU');
        Route::patch('etablissement/update-etd/{etudiant}', [EtudiantController::class, 'update'])->name('update_etudiant');
        Route::get('etablissement/supprimer-etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('supprimer_etudiant')->middleware('verifierAU');
        Route::post('etablissement/ajouter-etudiants', [EtudiantController::class, 'importData'])->name('sauvegarder_etudiants_csv');
        Route::post('export/liste-etudiants', [EtudiantController::class, 'exportData'])->name('Etudiants-parClasse-export');
        Route::post('export/liste-etudiants_specialite', [EtudiantController::class, 'exportDataBySpec'])->name('Etudiants-parSpecialite-export');
        // ***************************** D E P A R T E M E N T  ***********************

        Route::resource('departement', DepartementController::class);
        Route::get('etablissement/liste-departements', [DepartementController::class, 'showAll'])->name('liste_departements');
        //Route::view('etablissement/modifier-departement', 'admin.etablissement.departement.modifier_departement')->name('modifier_departement');
        //Route::get('etablissement/ajouter-departement', [DepartementController::class,'create'])->name('create_departement');
        //Route::post('etablissement/liste-departements/ajouter-departement',[DepartementController::class,'store'])->name('store_departement');
        Route::get('/etablissement/modifier-departement/{id}', [DepartementController::class, 'edit'])->whereNumber('id')->name('departement.edit');
        Route::patch('/etablissement/update/{id}', [DepartementController::class, 'update'])->whereNumber('id')->name('departement.update');
        Route::get('/etablissement/supprimer-departement/{id}', [DepartementController::class, 'destroy'])->whereNumber('id')->name('departement.destroy');


        // ENTRPRISE
        Route::get('entreprise/liste-entreprises', [EntrepriseController::class, 'index'])->name('list_entreprises');
        Route::view('entreprise/ajouter-entreprise', 'admin.entreprise.ajouter_entreprise')->name('ajouter_entreprise');
        Route::post('entreprise/ajouter', [EntrepriseController::class, 'store'])->name('entreprise.store');
        Route::get('entreprise/modifier-entreprise/{id}', [EntrepriseController::class, 'edit'])->whereNumber('id')->name('modifier_entreprise');
        Route::post('entreprise/modifier/{id}', [EntrepriseController::class, 'update'])->whereNumber('id')->name('entreprise.update');
        Route::get('entreprise/supprimer-entreprise/{id}', [EntrepriseController::class, 'destroy'])->whereNumber('id')->name('entreprise.destroy');


        // ******************************** S P E C I A L I T E ************************

        Route::get('etablissement/liste-specialites', [SpecialiteController::class, 'index'])->name('liste_specialites');
        Route::get('etablissement/ajouter-specialite', [SpecialiteController::class, 'create'])->name('ajouter_specialite');
        Route::post('etablissement/ajouter-specialite', [SpecialiteController::class, 'store'])->name('sauvegarder_specialite');
        Route::get('etablissement/modifier-specialite/{specialite}', [SpecialiteController::class, 'edit'])->name('modifier_specialite');
        Route::patch('etablissement/update-spec/{specialite}', [SpecialiteController::class, 'update'])->name('update_specialite');
        Route::get('etablissement/supprimer-specialite/{specialite}', [SpecialiteController::class, 'destroy'])->name('supprimer_specialite');

        // ************************************* C L A S S E ******************************

        Route::get('etablissement/liste-classes', [ClasseController::class, 'index'])->name('liste_classes');
        Route::get('etablissement/ajouter-classe', [ClasseController::class, 'create'])->name('ajouter_classe');
        Route::post('etablissement/ajouter-classe', [ClasseController::class, 'store'])->name('sauvegarder_classe');
        Route::get('etablissement/modifier-classe/{classe}', [ClasseController::class, 'edit'])->name('modifier_classe');
        Route::patch('etablissement/update-cls/{classe}', [ClasseController::class, 'update'])->name('update_classe');
        Route::get('etablissement/supprimer-classe/{classe}', [ClasseController::class, 'destroy'])->name('supprimer_classe');


        //---------------------------------------DEPOT-----------------------------


        Route::get('/depot/gerer-depots', [DepotMemoireController::class, 'liste_demandes_depot_admin'])->name('demande_depots');
        Route::get('/depot/gerer-depots/{demande_depot}/valider_depot', [DepotMemoireController::class, 'valider_par_admin'])->name('valider_par_admin');
        Route::get('/depot/gerer-depots/{demande_depot}/refuser_depot', [DepotMemoireController::class, 'refuser_par_admin'])->name('refuser_par_admin');
        Route::get('/depot/gerer-depots/memoire/{stage}/{memoire}/{code_classe}', [DepotMemoireController::class, 'telecharger_memoire'])->name('telecharger_memoire_adm');
        Route::get('/depot/gerer-depots/fiche_plagiat/{stage}/{fiche_plagiat}/{code_classe}', [DepotMemoireController::class, 'telecharger_fiche_plagiat'])->where('fiche_plagiat', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_plagiat');
        Route::get('/depot/gerer-depots/fiche_biblio/{stage}/{fiche_biblio}/{code_classe}', [DepotMemoireController::class, 'telecharger_fiche_biblio'])->where('fiche_biblio', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_biblio');
        Route::get('/depot/gerer-depots/fiche_tech/{stage}/{fiche_tech}/{code_classe}', [DepotMemoireController::class, 'telecharger_fiche_tech'])->where('fiche_tech', '[A-Za-z0-9\-\_\.]+')->name('telecharger_fiche_tech');
        Route::get('/depot/gerer-depots/attestation/{stage}/{attestation}/{code_classe}', [DepotMemoireController::class, 'telecharger_attestation'])->where('attestation', '[A-Za-z0-9\-\_\.]+')->name('telecharger_attestation');
        Route::get('/depot/gerer-depots/questionnaire/{stage}/{questionnaire}/{code_classe}', [DepotMemoireController::class, 'telecharger_questionnaire'])->name('telecharger_questionnaire');
        Route::post('/depot/gerer-depots/exporter-liste',[DepotMemoireController::class,'exporter_liste_depots'])->name('exporter_liste_depots');


        //-----------------------------------------SOUTENANCE----------------------------

        //Route::view('soutenance/planifier', 'admin.soutenance.planifier_soutenance')->name('planifier_soutenance');
        Route::get('soutenances/liste', [SoutenanceController::class,'list_stnc'])->name('list_soutenances_admin');
        Route::view('soutenance/evaluer', 'admin.soutenance.evaluer_soutenance')->name('evaluer_soutenance');
        Route::get('soutenance/planifier', [SoutenanceController::class, 'index'])->name('planifier_soutenance');
        Route::post('soutenance/store', [SoutenanceController::class, 'store'])->name('creer_soutenance');
        Route::patch('soutenance/update/{id}', [SoutenanceController::class, 'update'])->name('dragNdDrop');
        Route::patch('soutenance/edit/{id}', [SoutenanceController::class, 'edit'])->name('editer_soutenance');
        Route::delete('soutenance/delete/{id}', [SoutenanceController::class, 'destroy'])->name('supprimer_soutenance');
        Route::post('soutenance/PV',[SoutenanceController::class,'telecharger_pv_stnc'])->name('telecharger_pv_stnc');
        Route::post('soutenance/liste',[SoutenanceController::class,'telecharger_liste_stnc'])->name('telecharger_liste_stnc');
        Route::get('soutenance/liste/pvIndiv/{pvIndiv}',[SoutenanceController::class,'telecharger_pv_indiv'])->name('telecharger_pv_indiv');
        Route::get('soutenance/liste/grilleEvalNonInfo/{grilleLicNonInfo}',[SoutenanceController::class,'telecharger_grille_lic_non_info'])->name('telecharger_grille_lic_non_info');
        Route::get('soutenance/liste/grilleEvalInfo/{grilleLicInfo}',[SoutenanceController::class,'telecharger_grille_lic_info'])->name('telecharger_grille_lic_info');
        Route::get('soutenance/liste/grilleEvalMaster/{grilleMas}',[SoutenanceController::class,'telecharger_grille_mastere'])->name('telecharger_grille_mastere');
        Route::get('soutenance/liste/evaluerSoutenance/{soutenance}',[SoutenanceController::class,'evaluer_soutenance'])->name('evaluer_soutenance');
        Route::post('soutenance/notifier-soutenance/{id}',[SoutenanceController::class,'notifier'])->name('notifierSoutenance');
        //---------------------------------------PAIEMENT-------------------------------------

        Route::view('paiement/details-paiement-ens', 'admin.paiement.details_paiement_ens')->name('details_paiement_ens');
        Route::get('paiement/details/{id}', [EnseignantController::class, 'getDetails'])->name('getDetails');
        Route::post('paiement/details-paie/telecharger-attrayant', [EnseignantController::class, 'telecharger_attrayant_ens'])->name('telecharger_attrayant_ens');


        //-----------------------------------------CONFIGURATION---------------------------------

        Route::prefix('configuration/generale')->group(function () {
            Route::get('coordonnees', [EtablissementController::class, 'edit'])->name('coordonnees');
            Route::patch('coordonnees', [EtablissementController::class, 'update'])->name('valider_coordonnees');
            Route::get('frais-encadrement', [FraisEncadrementController::class, 'index'])->name('frais_encadrement');
            Route::get('ajouter-frais', [FraisEncadrementController::class, 'create'])->name('ajouter_frais');
            Route::post('ajouter-frais', [FraisEncadrementController::class, 'store'])->name('sauvegarder_frais');
            Route::get('supprimer-frais/{fraisEncadrement}', [FraisEncadrementController::class, 'destroy'])->name('supprimer_frais');
            Route::get('modifier-frais/{fraisEncadrement}', [FraisEncadrementController::class, 'edit'])->name('modifier_frais');
            Route::post('modifier-frais/{fraisEncadrement}', [FraisEncadrementController::class, 'update'])->name('update_frais');
            Route::view('dates-stages', 'admin.configuration.generale.dates_stages')->name('dates_stages');
            Route::view('liste-grille', 'admin.configuration.generale.liste_grille')->name('liste_grille');
            Route::view('config-grille', 'admin.configuration.generale.configuration_grille')->name('configurer_grille');
            Route::get('liste-sessions-depot', [TypeStageController::class, 'listeSessions'])->name('liste_sessions_depot');
            Route::get('session-depot', [TypeStageController::class, 'ts_cette_annee'])->name('config_session_depot');
            Route::post('session-depot/creer', [TypeStageController::class, 'new_session_depot'])->name('new_session_depot');
            Route::get('session-depot/modifier/{session}', [TypeStageController::class, 'editSession'])->name('modifier_session');
            Route::patch('session-depot/modifier/{session}', [TypeStageController::class, 'updateSession'])->name('update_session');
            Route::get('session-depot/supprimer/{session}', [TypeStageController::class, 'destroySession'])->name('supprimer_session');
            //Route::get('typeStage-classe/ajouter/{classe}',[TypeStageController::class,'create'])->name('typeStage.create');
            //Route::put('typeStage-classe/store/{classe}',[TypeStageController::class,'store'])->name('typeStage.store');
            Route::get('liste-classes-typeStages', [TypeStageController::class, 'index'])->name('typeStage.index');
            Route::get('typeStage-classe/modifier-typeStage/{typeStage:id}', [TypeStageController::class, 'edit'])->name('modifier_type_stage');
            Route::get('typeStage-classe/fiche_demande/{fiche_demande}', [TypeStageController::class, 'telechargement_fiche_demande'])->where('fiche_demande', '[A-Za-z0-9\-\_\.]+')->name('fiche_demande');
            Route::patch('typeStage-classe/update-typeStage/{typeStage:id}', [TypeStageController::class, 'update'])->name('update_type_stage');
            Route::get('typeStage-classe/supprimer-typeStage/{typeStage:id}', [TypeStageController::class, 'destroy'])->name('supprimer_type_stage');
            Route::patch('etablissement/update-cls/{classe}', [ClasseController::class, 'update'])->name('update_classe');


        });
        Route::get('configuration/liste-annees-universitaires', [AnneeUniversitaireController::class, 'index'])->name('liste_annee_universitaire');
        Route::get('configuration/annee-universitaire', [AnneeUniversitaireController::class, 'create'])->name('config_annee_universitaire');
        Route::post('configuration/ajouter-annee-universitaire', [AnneeUniversitaireController::class, 'store'])->name('ajouter_annee_universitaire');
        Route::get('configuration/modifier-annee-universitaire/{anneeUniversitaire}', [AnneeUniversitaireController::class, 'edit'])->name('modifier_annee_universitaire');
        Route::patch('configuration/modifier-annee-universitaire/{anneeUniversitaire}', [AnneeUniversitaireController::class, 'update'])->name('update_annee_universitaire');
        Route::get('configuration/lettre-affectation/{annee}/{lettre_affectation}', [AnneeUniversitaireController::class, 'telecharger_lettre_affectation'])->name('telecharger_lettre_affectation');
        Route::get('configuration/fiche-encadrement/{annee}/{fiche_encadrement}', [AnneeUniversitaireController::class, 'telecharger_fiche_encadrement'])->name('telecharger_fiche_encadrement');
        Route::get('configuration/attrayant/{annee}/{attrayant}', [AnneeUniversitaireController::class, 'telecharger_attrayant'])->name('telecharger_attrayant');
        Route::get('configuration/grille-evaluation-licence/{annee}/{grille_evaluation_licence}', [AnneeUniversitaireController::class, 'telecharger_grille_licence'])->name('telecharger_grille_licence');
        Route::get('configuration/grille-evaluation-info/{annee}/{grille_evaluation_info}', [AnneeUniversitaireController::class, 'telecharger_grille_info'])->name('telecharger_grille_info');
        Route::get('configuration/grille-evaluation-master/{annee}/{grille_evaluation_master}', [AnneeUniversitaireController::class, 'telecharger_grille_master'])->name('telecharger_grille_master');
        Route::get('configuration/pv-individuel/{annee}/{pv_individuel}', [AnneeUniversitaireController::class, 'telecharger_pv_individuel'])->name('telecharger_pv_individuel');
        Route::get('configuration/pv-global/{annee}/{pv_global}', [AnneeUniversitaireController::class, 'telecharger_pv_global'])->name('telecharger_pv_global');

    });
    //--------------------------------------------------------------------------------------------


    /*Route::prefix('dashboard')->group(
        function () {
        Route::view('dashboard-02', 'admin.dashboard.dashboard-02')->name('dashboard-02');
        Route::view('default-dashboard', 'admin.dashboard.default')->name('default_dash');
    }
    );*/
});
Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::prefix('admin/configuration/generale')->group(function () {
        Route::get('typeStage-classe/ajouter/{classe}', [TypeStageController::class, 'create'])->name('typeStage.create');
        Route::put('typeStage-classe/store/{classe}', [TypeStageController::class, 'store'])->name('typeStage.store');
    });
});
