<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\TypeStage;
use Illuminate\Support\Arr;
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
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "");
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
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "");
        //dd($request->hasFile('fiche_demande'));
        //dd($request->fiche_demande->store('public/files'));
        //dd($request->file('fiche_demande'));
        $request->validate([
            'type' => ['required'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'/*, new dateDebFinRule()*/],
            'fiche_demande' => ['required', 'max:2048'],
            'fiche_demande.*' => ['required', 'mimes:pdf,doc,docx',]
        ]);
        //$classe = Classe::all()->last();
        $code_classe = $classe->code;

        //$type_stage_nom = Str::upper(str_replace(' ', '', $code_classe)) . ' ' . $request->type;
        $type_stage_nom = Str::upper($code_classe) . ' ' . $request->type;

        $types_stage = TypeStage::all();
        $nouveau_nom = $this->decouper_nom($type_stage_nom);
        //dd($nouveau_nom);


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

        $fiche_demande_name = 'FicheDemande_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name);
        // $fiche_demande_name = 'FicheDemande_' . Str::upper($code_classe) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name);

        $type_stage = new TypeStage();
        $type_stage->classe_id = $classe->id;
        $type_stage->nom = $type_stage_nom;
        $type_stage->date_debut_periode = $date_deb;
        $type_stage->date_limite_periode = $date_f;

        $type_stage->fiche_demande = $request->fiche_demande;




        if ((Str::upper($request->type) == Str::upper('obligatoire'))
            && (($classe->niveau == 2 && $classe->cycle == 'master') || ($classe->niveau == 3 && $classe->cycle == 'licence'))) /*if($request->type=='Obligatoire')*/ {
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
        }
        $path = Storage::disk('public')
            ->putFileAs('fiches_demande', $request->file('fiche_demande'), $fiche_demande_name);


        $type_stage->fiche_demande = $path;
        $type_stage->save();
        $classe->type_stage_id = $type_stage->id;
        $classe->update();
        //dd($classe->type_stage->id);
        return redirect()->action([ClasseController::class, 'index']);
        //return redirect()->action([TypeStageController::class, 'index']);

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
        if (($classe->niveau == 2 && $classe->cycle == 'master') || ($classe->niveau == 3 && $classe->cycle == 'licence'))
        {
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
        }



        if (isset($request->fiche_demande)) {
            $fiche_demande_name = 'FicheDemande_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name);
            // $fiche_demande_name = $request->fiche_demande->getClientOriginalName();
            $path = Storage::disk('public')
                ->putFileAs('fiches_demande', $request->file('fiche_demande'), $fiche_demande_name);
            $typeStage->fiche_demande = $request->fiche_demande;
            $typeStage->fiche_demande = $path;
        }
        //$type = Arr::last(($this->decouper_nom($typeStage->nom)));
        $typeStage_nom = Str::upper($code_classe) . ' ' . $request->type;


        $typeStage->classe_id = $classe->id;

        $typeStage->nom = $typeStage_nom;
        $typeStage->type_sujet = $request->type_sujet;
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