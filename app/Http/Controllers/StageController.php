<?php

namespace App\Http\Controllers;

use App\Models\FraisEncadrement;
use App\Models\PaiementEnseignant;
use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Notifications\DemandeStageRefuseNotification;
use App\Notifications\DownloadFicheEncadrementNotification;
use App\Notifications\EncadrementAccepteNotifiaction;
use App\Notifications\EncadrementRefuseNotifiaction;
use Barryvdh\DomPDF\PDF;
use App\Models\TypeStage;
use App\Models\Enseignant;
use App\Models\Entreprise;
use App\Models\Specialite;
use App\Models\CahierStage;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\ElseIf_;
use App\Mail\ConfirmerEncadrement;
use App\Models\AnneeUniversitaire;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Notifications\DemandeEncadrementNotification;
use App\Notifications\DownloadLettreAffectationNotification;


class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function list_vol_1ere_licence_1ere_master()
    {

        $all_stages = Stage::All();
        $stages_volontaires = new Collection();

        foreach ($all_stages as $stage) {

            $etudiant = Etudiant::findOrFail($stage->etudiant_id);
            $classe = Classe::findOrFail($etudiant->classe_id);
            $niveau = $classe->niveau;
            $cycle = $classe->cycle;

            $specialite = Specialite::findOrFail($classe->specialite_id);
            $departement_nom = Departement::findOrFail($specialite->departement_id)->nom;


            $is_licence = (strtoupper($cycle) === strtoupper('licence'));
            $is_master = (strtoupper($cycle) === strtoupper('master'));
            $is_1_or_2 = ($niveau == 1 || $niveau == 2);
            $dep_is_info = strpos('departement ' . strtoupper($departement_nom), strtoupper('informatique')) > 0;

            //if (($dep_is_info && $is_licence && $is_1_or_2) || ($niveau == 1 && $is_master) || ($niveau == 1 && $is_licence)) {
            if (($niveau == 1 && $is_master) || ($niveau == 1 && $is_licence)) {

                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));
                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages_volontaires->push($stage);
            }

        }
        //dd($stages_volontaires);

        return view('admin.stage.listes_demandes_stage.sv1lm', compact(['stages_volontaires']));
    } */
///////1 ere master & licence volontaire
    static function stages1ereLicMaster()
    {
        $stages = Stage::with('typeStage')->get();
        $stages_volontaires = new Collection();
        foreach ($stages as $stage) {
            $ts_id = $stage->typeStage->id;
            $ts = TypeStage::findOrFail($ts_id);
            $type = Arr::last((TypeStageController::decouper_nom($ts->nom)));
            if ($type == "Volontaire") {
                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));
                $stage->file = $fiche;
                $stage->code_classe = $stage->etudiant->classe->code;
                $stages_volontaires->push($stage);
            }
        }
        return $stages_volontaires;
    }

    public function list_vol_1ere_licence_1ere_master()
    {
        $current_date = Carbon::now();
        $ann = Session::get('annee');
        if (isset($ann)) {
            $stages_volontaires = $this->stages1ereLicMaster()->where('annee_universitaire_id', $ann->id);
            return view('admin.stage.listes_demandes_stage.sv1lm', compact(['stages_volontaires', 'current_date']));
        }
        $an=$this->current_annee_univ();
        $stages_volontaires = $this->stages1ereLicMaster()->where('annee_universitaire_id', $an->id);
        //dd($stages_volontaires);

        return view('admin.stage.listes_demandes_stage.sv1lm', compact(['stages_volontaires', 'current_date']));
    }
///////
////////2 eme licnece info
    public function stages2emeLicInfo()
    {
        $stages = Stage::with('typeStage')->get();
        $stages_2lInfo = new Collection();
        foreach ($stages as $stage) {
            $etudiant = $stage->etudiant;
            $departement_nom = Departement::findOrFail($etudiant->classe->specialite->departement_id)->nom;
            $is_licence = (strtoupper($etudiant->classe->cycle) === strtoupper('licence'));
            $dep_is_info = strpos('departement ' . strtoupper($departement_nom), strtoupper('informatique')) > 0;
            $niveau = $etudiant->classe->niveau;
            if ($dep_is_info && $is_licence && $niveau == 2) {
                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));
                $stage->file = $fiche;
                $stage->code_classe = $stage->etudiant->classe->code;
                $stages_2lInfo->push($stage);
            }
        }
        return $stages_2lInfo;

    }

    public function list_oblig_2eme_licence_info()
    {
        $current_date = Carbon::now();
        $ann = Session::get('annee');
        if (isset($ann)) {
            $stages_2lInfo = $this->stages2emeLicInfo()->where('annee_universitaire_id', $ann->id);
            return view('admin.stage.listes_demandes_stage.so2lInfo', compact(['stages_2lInfo', 'current_date']));
        }

        $an =$this->current_annee_univ();
        $stages_2lInfo = $this->stages2emeLicInfo()->where('annee_universitaire_id', $an->id);

        return view('admin.stage.listes_demandes_stage.so2lInfo', compact(['stages_2lInfo', 'current_date']));
    }
//////////
////////2 eme licnece
    public function stages2emeLic()
    {
        $all_stages = Stage::All();
        $stages = new Collection();
        foreach ($all_stages as $stage) {
            $etudiant = Etudiant::findOrFail($stage->etudiant_id);
            $classe = Classe::findOrFail($etudiant->classe_id);
            $niveau = $classe->niveau;
            $cycle = $classe->cycle;
            $specialite = Specialite::findOrFail($classe->specialite_id);
            $departement_nom = Departement::findOrFail($specialite->departement_id)->nom;
            $is_licence = (strtoupper($cycle) === strtoupper('licence'));
            $is_master = (strtoupper($cycle) === strtoupper('master'));
            $is_1_or_2 = ($niveau == 1 || $niveau == 2);
            $dep_is_info = strpos('departement ' . strtoupper($departement_nom), strtoupper('informatique')) > 0;
            if ((!$dep_is_info && $is_licence && $niveau == 2)) {
                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));
                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);
            }
        }
        return $stages;
    }

    public function list_oblig_2eme_licence_non_info()
    {
        $current_date = Carbon::now();
        $ann = Session::get('annee');
        if (isset($ann)) {
            $stages = $this->stages2emeLic()->where('annee_universitaire_id', $ann->id);
            return view('admin.stage.listes_demandes_stage.so2l', compact(['stages', 'current_date']));
        }

        $an =  $this->current_annee_univ();

        $stages = $this->stages2emeLic()->where('annee_universitaire_id', $an->id);
        return view('admin.stage.listes_demandes_stage.so2l', compact(['stages', 'current_date']));
    }

///////////3 eme licence non info
    static function stages3emeLic()
    {
        $all_stages = Stage::All();
        $stages = new Collection();
        foreach ($all_stages as $stage) {
            $etudiant = Etudiant::findOrFail($stage->etudiant_id);
            $classe = Classe::findOrFail($etudiant->classe_id);
            $niveau = $classe->niveau;
            $cycle = $classe->cycle;
            $specialite = Specialite::findOrFail($classe->specialite_id);
            $departement_nom = Departement::findOrFail($specialite->departement_id)->nom;
            $is_licence = (strtoupper($cycle) === strtoupper('licence'));
            $dep_is_info = strpos('departement ' . strtoupper($departement_nom), strtoupper('informatique')) > 0;
            if ((!$dep_is_info && $is_licence && $niveau == 3)) {
                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));
                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);
            }
        }
        return $stages;
    }

    public function list_oblig_3eme_licence_non_info()
    {
        $current_date = Carbon::now();
        $ann = Session::get('annee');
        if (isset($ann)) {
            $stages = $this->stages3emeLic()->where('annee_universitaire_id', $ann->id);
            return view('admin.stage.listes_demandes_stage.so3l', compact(['stages', 'current_date']));
        }
        $an = $this->current_annee_univ();
        $stages = $this->stages3emeLic()->where('annee_universitaire_id', $an->id);
        return view('admin.stage.listes_demandes_stage.so3l', compact(['stages', 'current_date']));
    }

////////////
///////////3 eme licence info

    public function stages3emeLicInfo()
    {
        $all_stages = Stage::All();
        $stages = new Collection();
        foreach ($all_stages as $stage) {
            $etudiant = Etudiant::findOrFail($stage->etudiant_id);
            $classe = Classe::findOrFail($etudiant->classe_id);
            $niveau = $classe->niveau;
            $cycle = $classe->cycle;
            $specialite = Specialite::findOrFail($classe->specialite_id);
            $departement_nom = Departement::findOrFail($specialite->departement_id)->nom;
            $is_licence = (strtoupper($cycle) === strtoupper('licence'));
            $dep_is_info = strpos('departement ' . strtoupper($departement_nom), strtoupper('informatique')) > 0;
            if (($dep_is_info && $is_licence && $niveau == 3)) {
                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));
                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);
            }
        }
        return $stages;
    }

    public function list_oblig_3eme_licence_info()
    {
        $current_date = Carbon::now(); //dd($this->current_annee_univ());
        $ann = Session::get('annee');
        if (isset($ann)) {
            $stages = $this->stages3emeLicInfo()->where('annee_universitaire_id', $ann->id);
            return view('admin.stage.listes_demandes_stage.so3Info', compact(['stages', 'current_date']));
        }
        $an =$this->current_annee_univ();
        $stages = $this->stages3emeLicInfo()->where('annee_universitaire_id', $an->id);
        return view('admin.stage.listes_demandes_stage.so3Info', compact(['stages', 'current_date']));
    }

//////////2 eme master
    public function stages2emeMaster()
    {
        $all_stages = Stage::All();
        $stages = new Collection();
        foreach ($all_stages as $stage) {
            $etudiant = Etudiant::findOrFail($stage->etudiant_id);
            $classe = Classe::findOrFail($etudiant->classe_id);
            $niveau = $classe->niveau;
            $cycle = $classe->cycle;
            $is_master = (strtoupper($cycle) === strtoupper('master'));
            if (($is_master && $niveau == 2)) {
                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));
                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);
            }
        }
        return $stages;
    }

    public function list_oblig_2eme_master()
    {
        $current_date = Carbon::now();
        $ann = Session::get('annee');
        if (isset($ann)) {
            $stages = $this->stages2emeMaster()->where('annee_universitaire_id', $ann->id);
            return view('admin.stage.listes_demandes_stage.so2m', compact(['stages', 'current_date']));
        }
        $an = $this->current_annee_univ();
        $stages = $this->stages2emeMaster()->where('annee_universitaire_id', $an->id);
        return view('admin.stage.listes_demandes_stage.so2m', compact(['stages', 'current_date']));
    }

/////////////////

    public function liste_demandes_pour_enseignant()
    {
        $user_id = Auth::user()->id;
        $ens = Enseignant::all()->where('user_id', $user_id)->first();
        $stages = (Stage::where('enseignant_id', $ens->id))
            ->where('confirmation_encadrant', null)
            ->where('confirmation_admin', 0)
            ->get();
        return view('enseignant.encadrement.Liste_demandes_encadrement', compact(['stages']));
    }

    public function confirmer_demande_enseignant(Stage $stage)
    {
        if ($stage->confirmation_encadrant == null && $stage->date_fin > Carbon::now()) {
            $stage->confirmation_encadrant = 1;
            $user = Auth::user();
            $user->assignRole('encadrant');
            $etudiant = $stage->etudiant;
            $enseignant = $stage->enseignant;
            // dd($enseignant);
            $stage->update();
            $user->update();
            $stage->save();
            $current_date = Carbon::now();
            $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
            $etudiant->notify(new EncadrementAccepteNotifiaction($data));
            return back();
        } else abort(404);
    }

    public function refuser_demande_enseignant(Stage $stage)
    {
        if ($stage->confirmation_encadrant == null) {
            $stage->confirmation_encadrant = -1;
            $enseignant = $stage->enseignant;
            $etudiant = $stage->etudiant;
            $stage->update();
            $current_date = Carbon::now();
            $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
            $etudiant->notify(new EncadrementRefuseNotifiaction($data));
            return back();
        } else abort(404);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enseignants = Enseignant::all();
        $entreprises = Entreprise::all();
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->latest()->first();
        $classe = Classe::findOrFail($etudiant->classe_id);
        $type_stage = TypeStage::findOrFail($classe->type_stage_id);
        $typesSujet = new Collection();
        if (isset($type_stage->type_sujet)) {
            foreach ($type_stage->type_sujet as $ts) {
                $typesSujet->push($ts);
            }
        }
        $fiche_demande = substr($type_stage->fiche_demande, 15);
        $fiche_assurance = substr($type_stage->fiche_assurance, 18);
        $fiche_2Dinars = substr($type_stage->fiche_2Dinars, 15);
        return view('etudiant.stage.demander_stage', compact(['enseignants', 'entreprises', 'etudiant', 'fiche_demande', 'fiche_assurance', 'fiche_2Dinars', 'type_stage', 'typesSujet']));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
        ]);
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
        $stage = new Stage();
        $stage->titre_sujet = $request->titre_sujet;
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->latest()->first();
        $stage->etudiant_id = $etudiant->id;
        if (($etudiant->classe->niveau == 1) || ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle == "licence")) {
            $request->validate(['entreprise' => ['required']]);
            $entreprise = Entreprise::findOrFail($request->entreprise);
            $stage->entreprise_id = $entreprise->id;
        }
        if (($etudiant->classe->niveau == 3 && $etudiant->classe->cycle == "licence") || ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle == "master")) {
            $request->validate(['type_sujet' => ['required'],
                'enseignant_id' => ['required']]);
            $stage->type_sujet = $request->type_sujet;
            $stage->enseignant_id = $request->enseignant_id;
            if ($request->type_sujet == "PFE") {
                $request->validate([
                    'enseignant_id' => ['required'],
                    'entreprise' => ['required']
                ]);
                $stage->enseignant_id = $request->enseignant_id;
                $entreprise = Entreprise::findOrFail($request->entreprise);
                $stage->entreprise_id = $entreprise->id;
            }
        }
        /*if ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle == "master") {
            $request->validate([
                'enseignant_id' => ['required'],
                'entreprise' => ['required']
            ]);
            $stage->enseignant_id = $request->enseignant_id;
            $entreprise = Entreprise::findOrFail($request->entreprise);
            $stage->entreprise_id = $entreprise->id;
            $stage->type_sujet = "PFE";
        }*/
        $current_date = Carbon::now();
        $stage->date_demande = $current_date->format('Y-m-d');
        $moisCourant = (int)$current_date->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee = '20' . $current_date->format('y') . '-20' . strval(((int)$current_date->format('y')) + 1);
        } else
            $annee = '20' . strval(((int)$current_date->format('y')) - 1) . '-20' . $current_date->format('y');
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a) {
            if ($a->annee == $annee) {
                $stage->annee_universitaire_id = $a->id;
                break;
            }
        }
        $classe = Classe::findOrFail($etudiant->classe_id);
        $type_stage = TypeStage::findOrFail($classe->type_stage_id);

        $date_debut = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
        $date_fin = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');
        $nbre_mois = $this->diff_date_en_mois($date_debut, $date_fin);
        if ($request->date_debut < $request->date_fin) {

            if ($date_debut < $type_stage->date_debut_periode || $date_fin > $type_stage->date_limite_periode) {
                return Redirect::back()->withErrors(['La période de votre stage est hors limite !']);
            } else {
                $stage->date_debut = $date_debut;
                $stage->date_fin = $date_fin;
            }

        } else {
            return Redirect::back()->withErrors(['La date de fin de votre période de stage doit etre ultérieure à la date de debut !']);
        }
        if ($nbre_mois < $type_stage->duree_stage_min) {
            return Redirect::back()->withErrors(['la période de stage devrait être au minimum de ' . $type_stage->duree_stage_min . ' mois !']);
        }
        if ($nbre_mois > $type_stage->duree_stage_max) {
            return Redirect::back()->withErrors(['la période de stage devrait être au maximaum de ' . $type_stage->duree_stage_max . ' mois !']);
        }
        $cin = Auth::user()->numero_CIN;
        if ($etudiant->classe->typeStage->fiche_demande_type == "requis") {
            if (isset($request->fiche_demande)) {
                $request->validate(['fiche_demande' => ['required', 'mimes:docx,jpg,jpeg,png,doc']]);
                $fiche_demande_name = 'FicheDemande_' . $cin .'_'.$etudiant->nom.'-'.$etudiant->prenom . '.' . $request->file('fiche_demande')->extension();
                $path = Storage::disk('public')
                    ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_demandes_stages\fiches_demandes\fiches_demande_' . $classe->code, $request->file('fiche_demande'), $fiche_demande_name);
                $stage->fiche_demande = $path;
            }
        }
        if ($etudiant->classe->typeStage->fiche_2Dinars_type == "requis") {
            if (isset($request->fiche_2Dinars)) {
                $request->validate(['fiche_2Dinars' => ['required', 'mimes:docx,jpg,jpeg,png,doc']]);
                $fiche_2Dinars_name = 'Fiche2Dinars_' . $cin .'_'.$etudiant->nom.'-'.$etudiant->prenom .'.' . $request->file('fiche_2Dinars')->extension();
                $path2 = Storage::disk('public')
                    ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_demandes_stages\fiches_2dinars\fiches_2dinars_' . $classe->code, $request->file('fiche_2Dinars'), $fiche_2Dinars_name);
                $stage->fiche_2Dinars = $path2;
            }
        }
        if ($etudiant->classe->typeStage->fiche_assurance_type == "requis") {
            if (isset($request->fiche_assurance)) {
                $request->validate(['fiche_assurance' => ['required', 'mimes:docx,jpg,jpeg,png,doc']]);
                $fiche_assurance_name = 'FicheAssurance_' . $cin .'_'.$etudiant->nom.'-'.$etudiant->prenom . '.' . $request->file('fiche_assurance')->extension();
                $path3 = Storage::disk('public')
                    ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_demandes_stages\fiches_assurances\fiches_assurances_' . $classe->code, $request->file('fiche_assurance'), $fiche_assurance_name);
                $stage->fiche_assurance = $path3;
            }
        }
        $stage->confirmation_admin = 0;
        $stage->type_stage_id = $etudiant->classe->typeStage->id;
        $stage->save();
        if (isset($request->enseignant_id)) {
            $enseignant = Enseignant::findOrFail($request->enseignant_id);
            $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'classe_etud' => $classe->nom,
                'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                'etablissement' => Etablissement::findOrFail($enseignant->etablissement_id)->nom,
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];

            $enseignant->notify(new DemandeEncadrementNotification($data));
        }
        return redirect()->action([EtudiantController::class, 'mes_demandes_stages']);
    }


    static function diff_date_en_mois(string $a, string $b)
    {
        $from = Carbon::createFromFormat('Y-m-d', $a);
        $to = Carbon::createFromFormat('Y-m-d', $b);
        $nbreJours = $to->diffInDays($from);
        return intdiv($nbreJours, 27);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $stage_id
     * @return \Illuminate\Http\Response
     */
    public function modifier_demande(int $stage_id)
    {
        $stage = Stage::findOrFail($stage_id);
        $etudiant = Etudiant::findOrFail($stage->etudiant_id);
        $classe = Classe::findOrFail($etudiant->classe_id);
        $enseignants = Enseignant::all();
        $entreprises = Entreprise::all();
        $isMaster = strtoupper($classe->cycle) === strtoupper('master');
        $isLicence = strtoupper($classe->cycle) === strtoupper('licence');
        $stage->isMaster = $isMaster;
        $stage->isLicence = $isLicence;
        if (Auth::user()->getRoleNames()[0] == "superadmin" && $stage->date_fin > Carbon::now()) {
            return view('admin.stage.listes_demandes_stage.modifier_demande_stage', compact(['stage', 'classe', 'enseignants', 'entreprises']));
        } elseif (Auth::user()->getRoleNames()[0] == "etudiant" && $stage->date_fin > Carbon::now()) {
            return view('etudiant.stage.modifier_demande_stage', compact(['stage', 'classe', 'enseignants', 'entreprises']));

        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param int $stage_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $stage_id)
    {
        $stage = Stage::findOrFail($stage_id);
        if ($stage->date_fin > Carbon::now()) {
            $stage->titre_sujet = $request->sujet;
            if ($request->encadrant) {
                $stage->enseignant_id = $request->encadrant;
            }
            if ($request->entreprise) {
                $stage->entreprise_id = (int)$request->entreprise;
            }
            /*if ($request->fiche_demande) {
                $request->validate(['fiche_demande' => ['required', 'mimes:docx,jpg,jpeg,png,doc']]);
                $etudiant = Etudiant::findOrFail($stage->etudiant_id);
                $nom_pren = Str::upper($etudiant->nom . '_' . $etudiant->prenom);
                $fiche_demande_name = 'FicheDemande_' . $nom_pren . '.' . $request->file('fiche_demande')->extension();

                $dossier = substr($stage->fiche_demande, 0, strpos($stage->fiche_demande, '/') - 1);

                $path = Storage::disk('public')
                    ->putFileAs($dossier, $request->file('fiche_demande'), $fiche_demande_name);

                $stage->fiche_demande = $path;
            }*/

            $stage->update();
            return back();
        } else {
            abort(404);
        }

    }

    public function update_demande(int $stage_id, Request $request)
    {
        $request->validate(['enseignant_id' => 'required']);
        $stage = Stage::findOrFail($stage_id);
        $etudiant = Etudiant::findOrFail($stage->etudiant_id);
        $classe = Classe::findOrFail($etudiant->classe_id);
        $current_date = Carbon::now();
        if ($stage->date_fin > $current_date) {
            $stage->enseignant_id = $request->enseignant_id;
            $stage->confirmation_encadrant = null;
            $stage->update();
            $enseignant = Enseignant::findOrFail($request->enseignant_id);
            $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'classe_etud' => $classe->nom,
                'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                'etablissement' => Etablissement::findOrFail($enseignant->etablissement_id)->nom,
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];

            $enseignant->notify(new DemandeEncadrementNotification($data));
            return redirect()->action([EtudiantController::class, 'mes_demandes_stages']);
        } else abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmer_demande(int $stage_id)
    {
        $current_date = Carbon::now();
        $stage = Stage::findOrFail($stage_id);
        $etablissement = Etablissement::all()->first()->nom;
        //$anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        if ($stage->date_fin > $current_date && $stage->cofirmation_admin == 0) {
            $etudiant = Etudiant::findOrFail($stage->etudiant_id);
            $classe = Classe::findOrFail($etudiant->classe_id);
            $annee_universitaire_id = null;
            $annee = $this->current_annee_univ();
            $annees = AnneeUniversitaire::all();
            foreach ($annees as $a) {
                if ($a->annee == $annee->annee) {
                    $annee_universitaire_id = $annee->id;
                    break;
                }
            }
            $user = User::findOrFail($etudiant->user_id);
            $type_stage = TypeStage::findOrFail($classe->type_stage_id);
            $type = Arr::last((TypeStageController::decouper_nom($type_stage->nom)));
            if ($type === 'Obligatoire') {
                $ts = 'إجباري';
            } else {
                $ts = 'تطوعي';
            }
            //dd($stage->enseignant);
            if (isset($stage->enseignant)) {
                if ($stage->confirmation_encadrant == 1) {

                    $stage->confirmation_admin = 1;
                    User::find($stage->enseignant->user_id)->assignRole('encadrant');
                    $stage->update();
                    if (strtoupper($type_stage->cahier_stage_type) === strtoupper('requis')) {
                        $cahier_stage = new CahierStage();
                        $cahier_stage->stage_id = $stage_id;
                        $cahier_stage->annee_universitaire_id = $annee_universitaire_id;
                        $cahier_stage->save();
                        $stage->cahier_stage_id = $cahier_stage->id;
                        $stage->update();
                    }
                    $grade = $stage->enseignant->grade;
                    $cycle = $stage->etudiant->classe->cycle; //dd($grade,$cycle);
                    $lignefrais = (FraisEncadrement::where('cycle', $cycle)->where('grade', $grade)->first());
                    if(isset($lignefrais)) {
                        $frais = $lignefrais->frais;
                        $paiementEncadrement = new PaiementEnseignant();
                        $paiementEncadrement->enseignant_id = $stage->enseignant->id;
                        $paiementEncadrement->stage_id = $stage->id; //dd(StageController::diff_date_en_mois($stage->date_fin, $stage->date_debut));
                        $paiementEncadrement->montant = $frais * StageController::diff_date_en_mois($stage->date_fin, $stage->date_debut);
                        $paiementEncadrement->save();
                    }
                    $enseignant = Enseignant::findOrFail($stage->enseignant_id);
                    $file_path2 = public_path() . '/storage/' . $annee->fiche_encadrement; //dd(file_exists($file_path2));
                    //$file_path2 = str_replace(' ', '', $file_path2);
                    //$file_path2 = str_replace('/', '\\', $file_path2); dd($pathh,$annee->fiche_encadrement);
                    $templateProcessor2 = new TemplateProcessor($file_path2);//dd($templateProcessor2->getVariables());
                    $templateProcessor2->setValue('nom_etud', ucwords($etudiant->nom . ' ' . $etudiant->prenom));
                    $templateProcessor2->setValue('nom_ens', ucwords($enseignant->nom . ' ' . $enseignant->prenom));
                    $templateProcessor2->setValue('cin', $etudiant->user->numero_CIN);
                    $templateProcessor2->setValue('date', $current_date->format('d-m-Y'));
                    $templateProcessor2->setValue('telf', $etudiant->numero_telephone);
                    $templateProcessor2->setValue('email', $etudiant->email);
                    $templateProcessor2->setValue('classe', $etudiant->classe->nom);
                    $templateProcessor2->setValue('an', $annee->annee);
                    $pth=public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_confirmation_stages/fiches_encadrements';
                    //$pth=public_path() . '\storage\fiches_encadrements_' . $annee->annee ;
                        if(!File::isDirectory($pth)){
                          File::makeDirectory($pth, 0777, true, true);
                        }
                    $templateProcessor2->saveAs($pth. '\fiche_encadrement_' . $enseignant->nom . '_' . $enseignant->prenom .'-'.$etudiant->nom . '_' . $etudiant->prenom . '.docx');
                    $details2 = ['etudiant' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                        'classe' => $etudiant->classe->nom,
                        'annee' => $annee->annee,
                        'encadrant' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                        'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute
                    ];
                    $enseignant->notify(new DownloadFicheEncadrementNotification($details2));
                    $details = ['etudiant' => $etudiant->nom . ' ' . $etudiant->prenom,
                        'annee' => $annee->annee_universitaire,
                        'type_stage' => $type,
                        'encadrant' => $enseignant->nom . ' ' . $enseignant->prenom,
                        'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute
                    ];
                    $file_path = public_path() . '/storage/' . $annee->lettre_affectation;
                    //$file_path = str_replace(' ', '', $file_path);
                   // $file_path = str_replace('/', '\\', $file_path);
                    $templateProcessor = new TemplateProcessor($file_path);//dd($templateProcessor->getVariables());
                    $templateProcessor->setValue('nom', ucwords($etudiant->nom . ' ' . $etudiant->prenom));
                    $templateProcessor->setValue('CIN', $user->numero_CIN);
                    $templateProcessor->setValue('date_debut', $stage->date_debut);
                    $templateProcessor->setValue('date_fin', $stage->date_fin);
                    $templateProcessor->setValue('type_stage', $ts);
                    $templateProcessor->setValue('classe', $classe->nom);
                    $p=public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_confirmation_stages/lettres_affectations/lettres_affectations_' . $classe->code ;
                   // $p=public_path() . '\storage\lettres_affectation_' . $annee->annee ;
                    if(!File::isDirectory($p)){
                          File::makeDirectory($p, 0777, true, true);
                        }
                    $templateProcessor->saveAs($p. '\lettre_aff_' . $user->numero_CIN . '_' . $stage->etudiant->nom .'-'.$stage->etudiant->prenom. '.docx');
                    $etudiant->notify(new DownloadLettreAffectationNotification($details));
                    return back();
                } elseif ($stage->confirmation_encadrant == -1) {
                    Session::flash('message', 'encadrant refuse');
                } elseif ($stage->confirmation_encadrant == 0) {
                    Session::flash('message', 'attend_encadrant');
                    return back();
                }
            } else {
                $stage->confirmation_admin = 1;
                $stage->update();
                if (strtoupper($type_stage->cahier_stage_type) === strtoupper('requis')) {
                    $cahier_stage = new CahierStage();
                    $cahier_stage->stage_id = $stage_id;
                    $cahier_stage->annee_universitaire_id = $annee_universitaire_id;
                    $cahier_stage->save();
                    $stage->cahier_stage_id = $cahier_stage->id;
                    $stage->update();
                }
                $file_path = public_path() . '/storage/'  . $annee->lettre_affectation;
                //$file_path = str_replace(' ', '', $file_path);
                //$file_path = str_replace('/', '\\', $file_path);
                $templateProcessor = new TemplateProcessor($file_path);//dd($templateProcessor->getVariables());
                $templateProcessor->setValue('nom', ucwords($etudiant->nom . ' ' . $etudiant->prenom));
                $templateProcessor->setValue('CIN', $user->numero_CIN);
                $templateProcessor->setValue('date_debut', $stage->date_debut);
                $templateProcessor->setValue('date_fin', $stage->date_fin);
                $templateProcessor->setValue('type_stage', $ts);
                $templateProcessor->setValue('classe', $classe->nom);
                $path=public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_confirmation_stages/lettres_affectations/lettres_affectations_' . $classe->code ;
                //$path=public_path() . '\storage\ '.$etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_confirmation_stages\lettres_affectations\lettres_affectations_' . $classe->code ;
                //$path=public_path().'\storage\lettres_affectation_'.$annee->annee;//.'\lettre_aff_'.$user->numero_CIN.'_'.$stage->id.'.docx';
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                  //dd($path);
                $templateProcessor->saveAs($path. '\lettre_aff_' . $user->numero_CIN . '_' . $stage->etudiant->nom .'-'.$stage->etudiant->prenom. '.docx');
                $stage->update();
                $details = ['etudiant' => $etudiant->nom . ' ' . $etudiant->prenom,
                    'annee' => $annee->annee_universitaire,
                    'type_stage' => $type,
                    'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
                $etudiant->notify(new DownloadLettreAffectationNotification($details));
                return back();
            }
        } else abort(404);
    }

    static function current_annee_univ()
    {

        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else {
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        }
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a) {
            if ($a->annee == $annee) {
                return $a;

            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function refuser_demande(int $stage_id)
    {
        $stage = Stage::findOrFail($stage_id);
        $current_date = Carbon::now();
        if ($stage->date_fin > $current_date) {
            if ($stage->confirmation_admin == 1) {

                $annee_univ = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
                $cin = User::findOrFail(Etudiant::findOrFail($stage->etudiant_id)->user_id)->numero_CIN;

                $file_path = public_path('\storage\lettres_affectation_' . $annee_univ . '\lettre_aff_' . $cin . '_' . $stage_id . '.docx');
                //dd($file_path);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }

            }
            $stage->confirmation_admin = -1;
            $stage->update();
            $etudiant = $stage->etudiant;
            $details = ['etudiant' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
            $etudiant->notify(new DemandeStageRefuseNotification($details));
            return back();
        }
    }

    public function telecharger_modele_fiche_demande()
    {
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->latest()->first();
        $classe = Classe::findOrFail($etudiant->classe_id);
        $typeStage = TypeStage::findOrFail($classe->type_stage_id);
        $fiche_demande = $typeStage->fiche_demande;
        //$fiche_demande_name = substr($fiche_demande, 15);
        $fiche_demande_name = Str::afterLast($fiche_demande, '/');
        $file_path = public_path() . '/storage/'  . $fiche_demande;
        if (file_exists($file_path)) {
            return Response::download($file_path, $fiche_demande_name);
        } else {
            exit('fiche demande waw inexistante !');
        }
    }
    public function telecharger_fiche_demande(Stage $stage, string $fiche_demande, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        //$anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $file_path = public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_demandes_stages/fiches_demandes/fiches_demande_' . $code_classe . '/' . $fiche_demande;
        if (file_exists($file_path)) {
            return Response::download($file_path, $fiche_demande);
        } else {
            //Error
            exit('fiche de demande introuvable !');
        }
    }

    public function telecharger_fiche_2Dinars(Stage $stage,string $fiche_2Dinars, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        //$anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
        $fiche_2Dinars = Str::after($fiche_2Dinars, '/');
        $file_path = public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_demandes_stages/fiches_2dinars/fiches_2dinars_' . $code_classe . '/' . $fiche_2Dinars;
        if (file_exists($file_path)) {
            return Response::download($file_path, $fiche_2Dinars);
        } else {
            exit('fiche 2 dinars inexistante !');
        }
    }

    public function telecharger_fiche_assurance(Stage $stage,string $fiche_assurance, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $fiche_assurance = Str::after($fiche_assurance, '/');
        $file_path = public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_demandes_stages/fiches_assurances/fiches_assurances_' . $code_classe . '/' . $fiche_assurance;
        if (file_exists($file_path)) {
            return Response::download($file_path, $fiche_assurance);
        } else {
            exit('fiche assurance inexistante !');
        }
    }

    public function download_lettre_affect(Stage $demande)
    {
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = AnneeUniversitaire::findOrFail($demande->annee_universitaire_id)->annee;//dd($annee_univ);
        $cin = Auth::user()->numero_CIN;
       // $file_path = public_path('\storage\lettres_affectation_' . $annee_univ . '\lettre_aff_' . $cin . '_' . $demande->id . '.docx');
        $file_path =public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_confirmation_stages/lettres_affectations/lettres_affectations_' . $demande->etudiant->classe->code .'/lettre_aff_' . $cin . '_' . $demande->etudiant->nom .'-'.$demande->etudiant->prenom. '.docx';
       //dd($file_path);
        if (file_exists($file_path)) {
            Session::flash('message', 'download_OK');
            return Response::download($file_path, 'lettre d\'affectation.docx');
        } else {
            Session::flash('message', 'lettre_aff_introuvable');
            exit('Vous n\'avez aucune lettre d\'affectation pour ce stage!');

        }
    }

    public function download_fiche_encadrement(Stage $stage)
    {
        $etablissement = Etablissement::all()->first()->nom;
        $enseignant = Enseignant::where('user_id', Auth::user()->id)->first();
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $file_path =public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_confirmation_stages/fiches_encadrements/fiche_encadrement_' . $enseignant->nom . '_' . $enseignant->prenom . '-'.$stage->etudiant->nom . '_' . $stage->etudiant->prenom . '.docx';
        //$file_path = public_path('\storage\fiches_encadrements_' . $anneeUniv . '\fiche_encadrement_' . $enseignant->nom . '_' . $enseignant->prenom . '.docx');
        if (file_exists($file_path)) {
            return Response::download($file_path, 'fiche d\'encadrement.docx');
        } else {
            Session::flash('message', 'fiche_introuvable');
            exit('Vous n\'avez aucune fiche d\'encadrement pour ce stage!');

        }
    }

}
