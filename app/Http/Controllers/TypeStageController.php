<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\TypeStage;
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
        $classes=Classe::all();
        $error_message=array("nom"=>"","periode_stage"=>"","depot_stage"=>"");
        return view('admin.configuration.generale.typeStage_classe',compact(['classes','error_message']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error_message=array("nom"=>"","periode_stage"=>"","depot_stage"=>"");
        //dd($request->hasFile('fiche_demande'));
        //dd($request->fiche_demande->store('public/files'));
        //dd($request->file('fiche_demande'));
        $request->validate([
            'type'=>['required'],
            'nom_classe'=>['required'],
            'date_debut'=>['required','date'],
            'date_fin'=>['required','date'/*, new dateDebFinRule()*/],
            'fiche_demande'=>['required','max:2048'],
            'fiche_demande.*'=>['required','mimes:pdf,doc,docx',]
        ]);
        $classe=Classe::where("nom", $request->nom_classe)
            ->get()[0];
        $code_classe=$classe->code;

		$type_stage_nom=Str::upper($code_classe).' '.$request->type;
		$types_stage=TypeStage::all();
		$nouveau_nom=$this->decouper_nom($type_stage_nom);
		//dd($nouveau_nom);

		foreach($types_stage as $ts){
			if(($ts->nom===$type_stage_nom)||($nouveau_nom[0]===$this->decouper_nom($ts->nom)[0]))
            {$error_message=array("nom"=>"Cette classe est deja configurer !","periode_stage"=>"","depot_stage"=>"");
               // $error_message=array('nom'=>"Cette classe est deja configurer !");
                $classes=Classe::all();
				return view('admin.configuration.generale.typeStage_classe',compact(["classes","error_message"]));
			}
		}
        $date_deb = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
        $date_f = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');

        if($date_deb>$date_f){
            $error_message=array("nom"=>"","periode_stage"=>"La date de fin doit etre ultérieur à la date de debut   !","depot_stage"=>"");
            //$error_message=array('periode_stage'=>"La date de fin doit etre ultérieur à la date de debut   !");
           // $error_message="La date de fin doit etre ultérieur à la date de debut   !";
                $classes=Classe::all();
				return view('admin.configuration.generale.typeStage_classe',compact(["classes","error_message"]));
        }

        $fiche_demande_name='FicheDemande_'.Str::upper($code_classe).'_'.$request->type.'.'.$request->file('fiche_demande')->extension();

       //dd($fiche_demande_name)
;
        $type_stage=new TypeStage();

        $type_stage->nom=$type_stage_nom;
        $type_stage->date_debut_periode=$date_deb;
        $type_stage->date_limite_periode=$date_f;

        //$path = $request->fiche_demande->storeAs('fiches_demande',$fiche_demande_name,'pulicb');
       //dd($path);
        $type_stage->fiche_demande=$request->fiche_demande;

        if(Str::upper($request->type)==Str::upper('obligatoire'))
        /*if($request->type=='Obligatoire')*/{
            $request->validate([
                'date_debut_depo'=>['required','date'],
                'date_fin_depo'=>['required','date'],
                'type_sujet'=>['required']

            ]);

            $date_deb_depo = Carbon::createFromFormat('m/d/Y', $request->date_debut_depo)->format('Y-m-d');
            $date_f_depo = Carbon::createFromFormat('m/d/Y', $request->date_fin_depo)->format('Y-m-d');
            if($date_deb_depo>$date_f_depo){
                $error_message=array("nom"=>"","periode_stage"=>"","depot_stage"=>"La date de cloture de depot doit etre ultérieur à la date de debut !");

                    $classes=Classe::all();
                    return view('admin.configuration.generale.typeStage_classe',compact(["classes","error_message"]));
            }
            $type_stage->date_debut_depot=$date_deb_depo;
            $type_stage->date_limite_depot=$date_f_depo;

            $type_stage->type_sujet=$request->type_sujet;
        }


//dd($fiche_demande_name);
        $path = Storage::disk('public')
                        ->putFileAs('fiches_demande', $request->file('fiche_demande'),$fiche_demande_name);

    //dd($path);
    $type_stage->fiche_demande=$path;
        $type_stage->save();
        $classe->type_stage=$type_stage->id;
        $classe->update();
        return redirect()->action([TypeStageController::class,'index']);

    }


public function decouper_nom(string $nom){

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
     * Display the specified resource.
     *
     * @param  \App\Models\TypeStage  $typeStage
     * @return \Illuminate\Http\Response
     */
    public function show(TypeStage $typeStage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeStage  $typeStage
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeStage $typeStage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeStage  $typeStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeStage $typeStage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeStage  $typeStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeStage $typeStage)
    {
        //
    }
}
