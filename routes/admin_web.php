<?php

use App\Http\Controllers\AnneeUniversitaireController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementController;

/*Route::prefix('admin')->group(function () {
});*/
//-------------------------------------------------------------------------------------------------
Route::middleware(['auth','role:admin|superadmin'])->group(function(){
Route::prefix('admin')->group(function () {
// ADMINISTRATION
    Route::view('administration/liste-admin', 'admin.administration.liste_des_admin')->name('liste_admin');
    Route::view('administration/ajouter-admin', 'admin.administration.ajouter_admin')->name('ajouter_admin');
    Route::view('administration/modifier-admin', 'admin.administration.modifier_infos_admin')->name('modifier_admin');
    // STAGE
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
// ETABLISSEMENT
    Route::view('etablissement/liste-enseignants', 'admin.etablissement.enseignant.liste_enseignants')->name('liste_enseignants');
    Route::view('etablissement/liste-enseignants/ajouter-enseignant', 'admin.etablissement.enseignant.ajouter_enseignant')->name('ajouter_enseignant');
    Route::view('etablissement/liste-enseignants/modifier-enseignant', 'admin.etablissement.enseignant.modifier_enseignant')->name('modifier_enseignant');
    // *********** E T U D I A N T **********
    Route::view('etablissement/liste-etudiants', 'admin.etablissement.etudiant.liste_etudiants')->name('liste_etudiants');
    Route::view('etablissement/liste-etudiants/ajouter-etudiant', 'admin.etablissement.etudiant.ajouter_etudiant')->name('ajouter_etudiant');
    Route::view('etablissement/liste-etudiants/modifier-etudiant', 'admin.etablissement.etudiant.modifier_etudiant')->name('modifier_etudiant');
     // *********** DEPARTEMENT  **********
     Route::resource('departement', DepartementController::class);

     Route::get('etablissement/liste', [DepartementController::class,'showAll'])->name('liste_departements');
     Route::view('etablissement/liste-departements/modifier-departement', 'admin.etablissement.departement.modifier_departement')->name('modifier_departement');
     //Route::get('etablissement/ajouter-departement', [DepartementController::class,'create'])->name('create_departement');
     //Route::post('etablissement/liste-departements/ajouter-departement',[DepartementController::class,'store'])->name('store_departement');
    // *********** SPECIALITE  **********
    Route::view('etablissement/liste-specialites', 'admin.etablissement.specialite.liste_specialites')->name('liste_specialites');
    Route::view('etablissement/liste-specialites/ajouter-specialite', 'admin.etablissement.specialite.ajouter_specialite')->name('ajouter_specialite');
    Route::view('etablissement/liste-specialites/modifier-specialite', 'admin.etablissement.specialite.modifier_specialite')->name('modifier_specialite');
 // *********** CLASSE  **********
    Route::view('etablissement/liste-classes', 'admin.etablissement.classe.liste_classes')->name('liste_classes');
    Route::view('etablissement/liste-classes/ajouter-classe', 'admin.etablissement.classe.ajouter_classe')->name('ajouter_classe');
    Route::view('etablissement/liste-classes/modifier-classe', 'admin.etablissement.classe.modifier_classe')->name('modifier_classe');

// ENTRPRISE
    Route::view('entreprise/liste-entreprises', 'admin.entreprise.liste_entreprises')->name('list_entreprises');
    Route::view('entreprise/ajouter-entreprise', 'admin.entreprise.ajouter_entreprise')->name('ajouter_entreprise');
    Route::view('entreprise/modifier-entreprise', 'admin.entreprise.modifier_entreprise')->name('modifier_entreprise');
    // DEPOT
    Route::view('depot/gerer-depot', 'admin.depot.gerer_depot')->name('gerer_depot');
// SOUTENANCE
    Route::view('soutenance/planifier', 'admin.soutenance.planifier_soutenance')->name('planifier_soutenance');
    Route::view('soutenance/liste', 'admin.soutenance.liste_soutenances')->name('list_soutenances');
    Route::view('soutenance/evaluer', 'admin.soutenance.evaluer_soutenance')->name('evaluer_soutenance');
// PAIEMENT
    Route::view('paiement/details-paiement-ens', 'admin.paiement.details_paiement_ens')->name('details_paiement_ens');
// CONFIGURATION
    Route::prefix('configuration/generale')->group(function () {
        Route::view('coordonnees', 'admin.configuration.generale.coordonnees')->name('coordonnees');
        Route::view('montant-selon-grade', 'admin.configuration.generale.montant_selon_grade')->name('montant_selon_grade');
        Route::view('dates-stages', 'admin.configuration.generale.dates_stages')->name('dates_stages');
        Route::view('liste-grille', 'admin.configuration.generale.liste_grille')->name('liste_grille');
        Route::view('config-grille', 'admin.configuration.generale.configuration_grille')->name('configurer_grille');

    });
    Route::get('configuration/annee-universitaire',  [AnneeUniversitaireController::class, 'create'])->name('config_annee_universitaire');
    Route::post('configuration/ajouter-annee-universitaire',  [AnneeUniversitaireController::class, 'store'])->name('ajouter_annee_universitaire');

});
Route::prefix('dashboard')->group(function () {
    Route::view('dashboard-02', 'admin.dashboard.dashboard-02')->name('dashboard-02');
    Route::view('default-dashboard', 'admin.dashboard.default')->name('default_dash');
});});
