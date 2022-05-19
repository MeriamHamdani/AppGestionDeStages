<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use Barryvdh\DomPDF\PDF;
use App\Models\TypeStage;
use App\Models\Enseignant;
use App\Models\Entreprise;
use App\Models\Specialite;
use App\Models\CahierStage;
use App\Models\Departement;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\ElseIf_;
use App\Mail\ConfirmerEncadrement;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
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
    public function list_vol_1ere_2eme_licence_info_1ere_master()
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

            if (($dep_is_info && $is_licence && $is_1_or_2) || ($niveau == 1 && $is_master)) {

                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));

                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);

            }

        }

        return view('admin.stage.listes_demandes_stage.sv12lm', compact(['stages']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_oblig_2eme_licence_non_info()
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

        return view('admin.stage.listes_demandes_stage.so2l', compact(['stages']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_oblig_3eme_licence_non_info()
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

            if ((!$dep_is_info && $is_licence && $niveau == 3)) {

                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));

                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);


            }

        }


        return view('admin.stage.listes_demandes_stage.so3l', compact(['stages']));
    }

    public function list_oblig_3eme_licence_info()
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

            if (($dep_is_info && $is_licence && $niveau == 3)) {

                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));

                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);

            }

        }

        return view('admin.stage.listes_demandes_stage.so3Info', compact(['stages']));
    }

    public function list_oblig_2eme_master()
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

            if (($is_master && $niveau == 2)) {

                $fiche = substr($stage->fiche_demande, strpos($stage->fiche_demande, '/') + 1, strlen($stage->fiche_demande));

                $stage->file = $fiche;
                $stage->code_classe = $classe->code;
                $stages->push($stage);

            }

        }

        return view('admin.stage.listes_demandes_stage.so2m', compact(['stages']));
    }

    public function liste_demandes_pour_enseignant()
    {
        $user_id = Auth::user()->id;
        $ens=Enseignant::all()->where('user_id',$user_id)->first();
        $stages = (Stage::where('enseignant_id',$ens->id))->where('confirmation_encadrant',null)->get();
        //dd($stages);
        return view('enseignant.encadrement.Liste_demandes_encadrement',compact(['stages']));
    }
    public function confirmer_demande_enseignant(Stage $stage)
    {
    //dd($stage);
        $stage->confirmation_encadrant = 1;
        //dd()
        $user = Auth::user();
        //$ens=Enseignant::all()->where('user_id',$user_id)->first();
        $user->assignRole('encadrant');
        $stage->update();
        $user->update();
        //dd($stage);
        //dd($stage,$user->getRoleNames(),$user);
        return back();
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

        //$etudiant = (Etudiant::with('user')->where('user_id', Auth::user()->id))->first();

        $etudiant = (Etudiant::where('user_id', Auth::user()->id)->select('*'))->first();
        $classe = Classe::findOrFail($etudiant->classe_id);

        $type_stage = TypeStage::findOrFail($classe->type_stage_id);
        $fiche_demande = substr($type_stage->fiche_demande, 15);
        $fiche_assurance = substr($type_stage->fiche_assurance, 18);
        $fiche_2Dinars = substr($type_stage->fiche_2Dinars, 15);
        return view('etudiant.stage.demander_stage', compact(['enseignants', 'entreprises', 'etudiant', 'fiche_demande', 'fiche_assurance','fiche_2Dinars','type_stage']));

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
            'titre_sujet' => ['required', 'string', 'max:255'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
            /*'fiche_demande' => ['required'],
            'fiche_demande.*' => ['required', 'mimes:pdf,jpg,png,jpeg'],
            'fiche_assurance.*' => ['mimes:pdf,jpg,png,jpeg'],
            'fiche_2Dinars.*' => ['mimes:pdf,jpg,png,jpeg']*/
        ]);

        $stage = new Stage();
        $stage->titre_sujet = $request->titre_sujet;
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->first();
        $stage->etudiant_id = $etudiant->id;
        //dd($etudiant->classe->typeStage->fiche_2Dinars);

        if ($etudiant->classe->niveau == 3 && $etudiant->classe->cycle == "licence") {
            $request->validate(['type_sujet' => ['required']]);
            $stage->type_sujet = $request->type_sujet;

        }

        if ($etudiant->classe->niveau == 3 && $etudiant->classe->cycle == "licence" || $etudiant->classe->niveau == 2 && $etudiant->classe->cycle == "master") {
            $request->validate(['enseignant_id' => ['required']]);
            $stage->enseignant_id = $request->enseignant_id;
            $enseignant = Enseignant::findOrFail($request->enseignant_id);
        }

        $entreprise = Entreprise::findOrFail($request->entreprise);
        $stage->entreprise_id = $entreprise->id;
        $current_date = Carbon::now();
        $stage->date_demande = $current_date->format('Y-m-d');;
        $moisCourant = (int)$current_date->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee = '20' . $current_date->format('y') . '-20' . strval(((int)$current_date->format('y')) + 1);
        } else
            $annee = '20' . strval(((int)$current_date->format('y')) - 1) . '-20' . $current_date->format('y');
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a) {
            if ($a->annee == $annee) {
                $stage->annee_universitaire_id = $a->id;
                // dd($stage->annee_universitaire_id);
                break;
            }
        }

        $classe = Classe::findOrFail($etudiant->classe_id);
        $type_stage = TypeStage::findOrFail($classe->type_stage_id);

        $date_debut = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
        $date_fin = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');
        $nbre_mois = $this->diff_date_en_mois($date_debut, $date_fin);
        //dd($nbre_mois);
        //dd($nbre_mois<$type_stage->duree_stage_min);
        if($nbre_mois<$type_stage->duree_stage_min)
        {
            return Redirect::back()->withErrors(['la période de stage devrait être au minimum de '. $type_stage->duree_stage_min .' mois !']);
        }
        if($nbre_mois>$type_stage->duree_stage_max)
        {
            return Redirect::back()->withErrors(['la période de stage devrait être au maximaum de '. $type_stage->duree_stage_max .' mois !']);
        }
        if ($request->date_debut < $request->date_fin) {

            if ($date_debut < $type_stage->date_debut_periode || $date_fin > $type_stage->date_limite_periode) {
                return Redirect::back()->withErrors(['La période de votre stage est hors limite !']);
            } else {
                $stage->date_debut = $date_debut;
                $stage->date_fin = $date_fin;
            }

        } else {
            return Redirect::back()->withErrors(['La date de fin de votre période de stage doit etre ultérieure à la date de debut !      !']);
        }

        $cin = Auth::user()->numero_CIN;

        /*if (isset($etudiant->classe->typeStage->fiche_2Dinars))
        {
            $fiche_2Dinars_name = 'Fiche2Dinars_' . $cin . '.' . $request->file('fiche_2Dinars')->extension();
            $path3 = Storage::disk('public')
                ->putFileAs('fiches_2Dinars_'. $classe->code, $request->file('fiche_2Dinars'), $fiche_2Dinars_name);
            $stage->fiche_2Dinars = $path3;
            //dd($request->file('fiche_2Dinars'));
        }
        if (isset($etudiant->classe->typeStage->fiche_assurance))
        {
            $fiche_assurance_name = 'FicheAssurance_' . $cin . '.' . $request->file('fiche_assurance')->extension();
            $path2 = Storage::disk('public')
                ->putFileAs('fiches_assurances_'. $classe->code, $request->file('fiche_assurance'), $fiche_assurance_name);
            $stage->fiche_assurance = $path2;
           // dd($request->file('fiche_assurance'),$request->file('fiche_2Dinars'),$request->file('fiche_demande'));
        }*/
        if($etudiant->classe->typeStage->fiche_demande_type == "requis")
        {
            if (isset($request->fiche_demande))
            {
                $fiche_demande_name = 'FicheDemande_' . $cin . '.' . $request->file('fiche_demande')->extension();
                $path = Storage::disk('public')
                    ->putFileAs('fiches_demande_' . $classe->code, $request->file('fiche_demande'), $fiche_demande_name);
                $stage->fiche_demande = $path;
            }
        }
        $stage->confirmation_admin = 0;
       // dd($stage);//
        $stage->save();
        if (($etudiant->classe->niveau == 3 && $etudiant->classe->cycle == "licence") ||
            ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle == "master")) {
            $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'classe_etud' => $classe->nom,
                'nom_ens' => $enseignant->nom . ' ' . $enseignant->prenom,
                'etablissement' => Etablissement::findOrFail($enseignant->etablissement_id)->nom,
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];

            $enseignant->notify(new DemandeEncadrementNotification($data));
        }

        return redirect()->action([EtudiantController::class, 'mes_demandes_stages']);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        //
    }
    static function diff_date_en_mois(string $a, string  $b)
    {
        $from = Carbon::createFromFormat('Y-m-d', $a);
        $to = Carbon::createFromFormat('Y-m-d', $b);
        $nbreJours = $to->diffInDays($from);
        return intdiv($nbreJours,27);
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
        //dd($stage);
        /*$typeStage=TypeStage::findOrFail($classe->type_stage);
        $type=strtoupper(substr($typeStage->nom,strpos(' ')+1,strlen($typeStage->nom)));*/
        return view('admin.stage.listes_demandes_stage.modifier_demande_stage', compact(['stage', 'classe', 'enseignants', 'entreprises']));
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

        $stage->titre_sujet = $request->sujet;

        if ($request->encadrant) {
            $stage->enseignant_id = $request->encadrant;
        }

        if ($request->entreprise) {
            $stage->entreprise_id = (int)$request->entreprise;
        }
        if ($request->fiche_demande) {
            $etudiant = Etudiant::findOrFail($stage->etudiant_id);
            $nom_pren = Str::upper($etudiant->nom . '_' . $etudiant->prenom);
            $fiche_demande_name = 'FicheDemande_' . $nom_pren . '.' . $request->file('fiche_demande')->extension();

            $dossier = substr($stage->fiche_demande, 0, strpos($stage->fiche_demande, '/') - 1);

            $path = Storage::disk('public')
                ->putFileAs($dossier, $request->file('fiche_demande'), $fiche_demande_name);

            $stage->fiche_demande = $path;
        }

        $stage->update();
        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmer_demande(int $stage_id)
    {   //dd($stage_id);

        $current_date = Carbon::now();
        $stage = Stage::findOrFail($stage_id);
        if($stage->confirmation_encadrant==0){
            Session::flash('message','attend_encadrant');
            //dd(Session::get('message'));
            return back();
        }
        $stage->confirmation_admin = 1;
        $etudiant=Etudiant::findOrFail($stage->etudiant_id);
        $enseignant=Enseignant::findOrFail($stage->enseignant_id);
        $classe=Classe::findOrFail($etudiant->classe_id);

        //if (strpos(strtoupper($type_stage->nom), strtoupper('volontaire')) !== false) {
            $cahier_stage=new CahierStage();
            $cahier_stage->stage_id=$stage_id;
            $annee=$this->current_annee_univ();

            $annees = AnneeUniversitaire::all();
            foreach ($annees as $a) {
                if ($a->annee == $annee->annee) {
                    $cahier_stage->annee_universitaire_id = $annee->id;
                    break;
                }
            }
            $cahier_stage->save();
        //}
        $stage->cahier_stage_id=$cahier_stage->id;
        $user=User::findOrFail($etudiant->user_id);
        $type_stage=TypeStage::findOrFail($classe->type_stage_id);
        $type=strtoupper(substr($type_stage->nom,strpos($type_stage->nom,' ')+1,strlen($type_stage->nom))) ;
        if($type==='OBLIGATOIRE'){
            $ts='اجباري';
        }else{
            $ts='تطوعي';
        }
        $file_path = public_path() .'/storage/models_lettre_affectation/model_lettre_affectation_'.$annee->annee.'.docx';

        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('nom', $etudiant->nom.' '.$etudiant->prenom);
        $templateProcessor->setValue('CIN',$user->numero_CIN);
        $templateProcessor->setValue('date_debut',$stage->date_debut);
        $templateProcessor->setValue('date_fin',$stage->date_fin);
        $templateProcessor->setValue('type_stage',$ts);
        $templateProcessor->setValue('classe',$classe->nom);
        $templateProcessor->saveAs(public_path() .'/storage/lettres_affectation_'.$annee->annee.'/lettre_aff_'.$user->numero_CIN.'_'.$stage->id.'.docx');
        $stage->update();
        $details = ['etudiant'=>$etudiant->nom.' '.$etudiant->prenom,
                    'sujet' => $stage->titre_sujet,
                    'annee'=>$annee->annee_universitaire,
                    'type_stage'=>$type,
                    'encadrant'=>$enseignant->nom.' '.$enseignant->prenom,
                    'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];

            $etudiant->notify(new DownloadLettreAffectationNotification($details));
        return back();
    }


    public function current_annee_univ(){

        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee ='20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else {
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        }
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a)
        {
            if ($a->annee == $annee)
            {
                return  $a;

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
    {   //dd($stage_id);


        $stage = Stage::findOrFail($stage_id);
        if($stage->confirmation_admin==1){

            $annee_univ=AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
            $cin=User::findOrFail(Etudiant::findOrFail($stage->etudiant_id)->user_id)->numero_CIN;

            $file_path =public_path('\storage\lettres_affectation_'.$annee_univ.'\lettre_aff_'.$cin.'_'.$stage_id.'.docx');
            //dd($file_path);
            if (File::exists($file_path)) {
                File::delete($file_path);
            }

       }
        $stage->confirmation_admin = -1;
        $stage->update();
        return back();
    }
    public function telecharger_fiche_assurance()
    {
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->first();
        $classe = Classe::findOrFail($etudiant->classe_id);
        $typeStage= TypeStage::findOrFail($classe->type_stage_id);
        $fiche_assurance =$typeStage->fiche_assurance;
       //dd($fiche_assurance);
        $fiche_assurance_name = substr($fiche_assurance, 18);
        $file_path2 = public_path() .'/storage/'. $fiche_assurance;
       // dd($file_path2,$fiche_assurance_name);
        if (file_exists($file_path2))
        {
            return Response::download($file_path2,$fiche_assurance_name);
        }
        else
        {
            //Error
            exit('fiche assurance inexistante !');
        }
    }
    public function telecharger_fiche_demande()
    {

        $etudiant = Etudiant::where('user_id', Auth::user()->id)->first();
        $classe = Classe::findOrFail($etudiant->classe_id);
        //dd($classe);
        $typeStage= TypeStage::findOrFail($classe->type_stage_id);
       //dd($typeStage);
        $fiche_demande =$typeStage->fiche_demande;
        $fiche_demande_name = substr($fiche_demande, 15);
       //dd($fiche_demande);
        $file_path = public_path() .'/storage/'. $fiche_demande;
        //dd($file_path);
        if (file_exists($file_path))
        {
            return Response::download($file_path,$fiche_demande_name);
        }
        else
        {
            exit('fiche demande waw inexistante !');
        }
    }
    public function telecharger_fiche_2Dinars()
    {
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->first();
        $classe = Classe::findOrFail($etudiant->classe_id);
        $typeStage= TypeStage::findOrFail($classe->type_stage_id);
        $fiche_2Dinars =$typeStage->fiche_2Dinars;
        $fiche_2Dinars_name = substr($fiche_2Dinars, 15);
        //dd($fiche_2Dinars);
        $file_path3 = public_path() .'/storage/'. $fiche_2Dinars;
       //dd($file_path3,$fiche_2Dinars);
        if (file_exists($file_path3))
        {
            return Response::download($file_path3, $fiche_2Dinars_name);
        }
        else
        {
            exit('fiche 2 dinars inexistante !');
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        //
    }

    public function download_lettre_affect(Stage $demande){
       $annee_univ=AnneeUniversitaire::findOrFail($demande->annee_universitaire_id)->annee;
       $cin=Auth::user()->numero_CIN;
       $file_path =public_path('\storage\lettres_affectation_'.$annee_univ.'\lettre_aff_'.$cin.'_'.$demande->id.'.docx');

       //dd($file_path);

            if (file_exists($file_path))
                {
                    Session::flash('message', 'download_OK');
                return Response::download($file_path,'lettre d\'affectation.docx');
                }
            else
                {
                    Session::flash('message', 'lettre_aff_introuvable');
                exit('Vous n\'avez aucune lettre d\'affectation pour ce stage!');

                }
    }

}
