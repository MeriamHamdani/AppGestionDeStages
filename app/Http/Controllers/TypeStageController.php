<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\TypeStage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Rules\dateDebFinRule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class TypeStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeStages = TypeStage::with('classe')->get();
        //dd($typeStage->classe->code);
        $classes = Classe::with('typeStage')->get();
        //$typeStages = TypeStages::with('classe')->get();
        // $typeStage = TypeStage::all()->first();
        return view('admin.configuration.generale.liste_classe_typeStage', ['classes' => $classes, 'typeStages' => $typeStages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Classe $classe)
    {
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "","duree_max_min" => "");
        return view('admin.configuration.generale.typeStage_classe', ['classe' => $classe, 'error_message' => $error_message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classe $classe)
    {
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "","duree_max_min"=> "");
        //dd($request->hasFile('fiche_demande'));
        //dd($request->fiche_demande->store('public/files'));
        //dd($request->file('fiche_demande'));
        $request->validate([
            'type' => ['required'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
            'duree_stage_min' =>['required'],
            'duree_stage_max' =>['required'],
            'fiche_demande_type' =>['required'],
            'fiche_assurance_type' =>['required'],
            'fiche__type' =>['required'],
            'cahier_stage_type' =>['required'],
        ]);
        $code_classe = $classe->code;
        $type_stage_nom = Str::upper($code_classe) . ' ' . $request->type;
        $types_stage = TypeStage::all();
        $nouveau_nom = $this->decouper_nom($type_stage_nom);
        foreach ($types_stage as $ts) {
            //if (($ts->nom === $type_stage_nom) || ($nouveau_nom[0] === $this->decouper_nom($ts->nom)[0])) {
            if (($ts->nom === $type_stage_nom)) {
                //dd($nouveau_nom,$nouveau_nom[0],$this->decouper_nom($ts->nom)[0],$ts->nom);                $error_message = array("nom" => "Cette classe est deja configurer !", "periode_stage" => "", "depot_stage" => "");
                // $error_message=array('nom'=>"Cette classe est deja configurer !");
                //$classe = Classe::all()->last();
                return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
            }
        }
        $date_deb = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
        $date_f = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');

        if ($date_deb > $date_f) {
            $error_message = array("nom" => "", "periode_stage" => "La date de fin doit etre ultérieur à la date de debut   !", "depot_stage" => "");
            //$error_message=array('periode_stage'=>"La date de fin doit etre ultérieur à la date de debut   !");
            // $error_message="La date de fin doit etre ultérieur à la date de debut   !";
            //$classe = Classe::all()->last();
            return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
        }

        $type_stage = new TypeStage();
        $type_stage->classe_id = $classe->id;
        $type_stage->nom = $type_stage_nom;
        $type_stage->date_debut_periode = $date_deb;
        $type_stage->date_limite_periode = $date_f;
       // dd($nbre_mois = StageController::diff_date_en_mois($date_deb, $date_f));
        $nbre_mois = StageController::diff_date_en_mois($date_deb, $date_f);

        $type_stage->fiche_demande_type=$request->fiche_demande_type;
        //dd(($request->fiche_demande_type == "requis"));
        $type_stage->fiche_assurance_type=$request->fiche_assurance_type;
        $type_stage->fiche__type=$request->fiche__type;
        $type_stage->cahier_stage_type=$request->cahier_stage_type;
        $type_stage->duree_stage_min=$request->duree_stage_min;
        //dd($nbre_mois <  $request->duree_stage_max);
        if($nbre_mois !=  $request->duree_stage_max )
        {
            $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "","duree_max_min" => "L'erreur est dû à cause de mal correspondance entre la péeriode de stage que vous avez saisi et la durée maximale! Verifiez!");
            return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
        }
        $type_stage->duree_stage_max=$request->duree_stage_max;
        //dept dates
     /*   if ((Str::upper($request->type) == Str::upper('obligatoire'))
            && (($classe->niveau == 2 && $classe->cycle == 'master') || ($classe->niveau == 3 && $classe->cycle == 'licence')))
            {
            $request->validate([
                'date_debut_depo' => ['required', 'date'],
                'date_fin_depo' => ['required', 'date'],
                'type_sujet' => ['required']

            ]);

            $date_deb_depo = Carbon::createFromFormat('m/d/Y', $request->date_debut_depo)->format('Y-m-d');
            $date_f_depo = Carbon::createFromFormat('m/d/Y', $request->date_fin_depo)->format('Y-m-d');
            if ($date_deb_depo > $date_f_depo) {
                $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "La date de clôture de dépôt doit etre ultérieure à la date de début !");
                //$classe = Classe::all()->last();
                return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
            }
            $type_stage->date_debut_depot = $date_deb_depo;
            $type_stage->date_limite_depot = $date_f_depo;
            $type_stage->type_sujet = $request->type_sujet;
        }*/
        if (($request->fiche_demande_type == "requis"))
        {
            $request->validate(['fiche_demande' => ['required']]);
            //dd(($request->fiche_demande_type == "requis"));
            if (isset($request->fiche_demande))
            {
                $fiche_demande_name = 'FicheDemande_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name)
                $path = Storage::disk('public')
                    ->putFileAs('fiches_demande', $request->file('fiche_demande'), $fiche_demande_name);
                $type_stage->fiche_demande = $path;
            }
        }
        //dd($request->fiche_demande_type);
        // isset fiche assurance
       /* if (isset($request->fiche_assurance))
        {
            $fiche_assurance_name = 'FicheAssurance_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_assurance')->extension();
            $path2 = Storage::disk('public')
                ->putFileAs('fiches_assurances', $request->file('fiche_assurance'), $fiche_assurance_name);
            //$path2 = $request->file('fiche_assurance')->store('fiches_assurances',$fiche_assurance_name);
            //dd($path2);
            $type_stage->fiche_assurance = $path2;
            //dd($request->fiche_assurance,$type_stage->fiche_assurance);
        }
        if (isset($request->fiche_2Dinars)) {
            //dd($request->fiche_2Dinars);
            $fiche_2Dinars_name = 'Fiche2Dinars_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_2Dinars')->extension();
            //dd($fiche_2Dinars_name);
            $path3 = Storage::disk('public')
                ->putFileAs('fiches_2Dinars', $request->file('fiche_2Dinars'), $fiche_2Dinars_name);
            $type_stage->fiche_2Dinars = $path3;
            //dd($request->fiche_2Dinars,$type_stage->fiche_2Dinars);
        }*/


        $type_stage->save();
        $classe->type_stage_id = $type_stage->id;
        $classe->update();
        Session::flash('message', 'ok');
        return redirect()->action([ClasseController::class, 'index']);

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function show(TypeStage $typeStage)
    {
        //
    }
    public function telechargement_fiche_demande(Request $request)
    {

        $fiche_demande =$request->fiche_demande;
        $fiche_demande2 ='fiches_demande/'.$fiche_demande;
        $file_path = public_path() .'/storage/'. $fiche_demande2;

        if (file_exists($file_path))
        {
            return Response::download($file_path,$fiche_demande);
        }
        else
        {
            exit('fiche demande inexistante !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeStage $typeStage)
    {
        $classe = $typeStage->classe;
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "");
        $type = Arr::last(($this->decouper_nom($typeStage->nom)));
        return view('admin.configuration.generale.modifier_typeStage'
            , ['typeStage' => $typeStage, 'classe' => $classe, 'error_message' => $error_message, 'type' => $type]);
    }

    public function decouper_nom(string $nom)
    {

        $retour = array();
        $delimiteurs = ' ';
        $tok = strtok($nom, " ");
        while (strlen(join(" ", $retour)) != strlen($nom)) {
            array_push($retour, $tok);
            $tok = strtok($delimiteurs);
        }
        return $retour;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeStage $typeStage)
    {
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "");
        $request->validate([
            'type' => ['required'],
        ]);

        $classe = $typeStage->classe;
        $code_classe = $typeStage->classe->code;

        if ($request->date_debut > $request->date_fin) {
            $error_message = array("nom" => "", "periode_stage" => "La date de fin doit etre ultérieur à la date de debut   !", "depot_stage" => "");
            //dd($request->date_debut,$request->date_fin);
            return view('admin.configuration.generale.typeStage_classe', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message]);
        }

        if ($typeStage->date_debut_periode !== $request->date_debut) {
            $typeStage->date_debut_periode = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
        }
        if ($typeStage->date_limite_periode !== $request->date_fin) {
            $typeStage->date_limite_periode = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');
        }

        //depot
       /* if (($classe->niveau == 2 && $classe->cycle == 'master') || ($classe->niveau == 3 && $classe->cycle == 'licence')) {
            if ($request->date_debut_depo > $request->date_fin_depo) {
                $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "La date de fin doit etre ultérieure à la date de début   !");
                //dd($typeStage);
                return view('admin.configuration.generale.typeStage_classe', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message]);
            }
            if ($typeStage->date_debut_depot !== $request->date_debut_depo) {
                $typeStage->date_debut_depot = Carbon::createFromFormat('m/d/Y', $request->date_debut_depo)->format('Y-m-d');

            }

            if ($typeStage->date_limite_depot !== $request->date_fin_depo) {
                $typeStage->date_limite_depot = Carbon::createFromFormat('m/d/Y', $request->date_fin_depo)->format('Y-m-d');
            }
        }*/
        if (($request->fiche_demande_type == "requis")&&(($typeStage->fiche_demande)== null))
        {
            $request->validate(['fiche_demande.*' => ['required','mimes:pdf,jpg,png,jpeg,docx']]);
            //dd(($request->fiche_demande_type == "requis"));
            if (isset($request->fiche_demande))
            {
                $fiche_demande_name = 'FicheDemande_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name)
                $path = Storage::disk('public')
                    ->putFileAs('fiches_demande', $request->file('fiche_demande'), $fiche_demande_name);
                $typeStage->fiche_demande = $path;
            }

        }
      /*  if (isset($request->fiche_assurance)) {
            $fiche_assurance_name = 'FicheAssurance_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_assurance')->extension();
            $path2 = Storage::disk('public')
                ->putFileAs('fiches_assurance', $request->file('fiche_assurance'), $fiche_assurance_name);
            //$typeStage->fiche_assurance = $request->fiche_assurance;
            $typeStage->fiche_assurance = $path2;

        }
        if (isset($request->fiche_2Dinars)) {
            $fiche_2Dinars_name = 'Fiche2Dinars_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_2Dinars')->extension();
            $path3 = Storage::disk('public')
                ->putFileAs('fiches_2Dinars', $request->file('fiche_2Dinars'), $fiche_2Dinars_name);
            //$typeStage->fiche_2Dinars = $request->fiche_2Dinars;
            $typeStage->fiche_2Dinars = $path3;
        }*/
        //$nbre_mois = $this->diff_date_en_mois($date_debut, $date_fin);
        $typeStage_nom = Str::upper($code_classe) . ' ' . $request->type;
        $typeStage->classe_id = $classe->id;
        $typeStage->nom = $typeStage_nom;
        $typeStage->type_sujet = $request->type_sujet;
        $typeStage->cahier_stage_type = $request->cahier_stage_type;
        $typeStage->fiche__type = $request->fiche__type;
        $typeStage->fiche_demande_type = $request->fiche_demande_type;
        $typeStage->fiche_assurance_type = $request->fiche_assurance_type;
        $typeStage->duree_stage_max = $request->duree_stage_max;
        $typeStage->duree_stage_min = $request->duree_stage_min;


        //dd($request);
        $typeStage->update();
        return redirect()->action([TypeStageController::class, 'index']);

        // dd($typeStage);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeStage $typeStage)
    {
        $typeStage->delete();
        return redirect()->action([TypeStageController::class, 'index']);
    }
}
