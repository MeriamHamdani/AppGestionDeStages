<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\TypeStage;
use App\Models\Specialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.etablissement.classe.liste_classes',
            ['classes' => Classe::with('specialite')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.etablissement.classe.ajouter_classe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->session()->forget('key');
        $attributs = $request->validate([
           // 'nom' => ['required', 'string', 'max:255'],
            //'code' => ['required', 'string', 'max:255'],
            'niveau' => ['required', 'string', 'max:255'],
            'cycle' => ['required', 'string', 'max:255'],
            'specialite_id' => ['required', Rule::exists('specialites', 'id')],
        ]);
        $specialite=Specialite::find($request->specialite_id);
        $code=$request->niveau.strtoupper(substr($request->cycle,0,1)).$specialite->code;
        $attributs['code']=$code;
        $cls_exist = Classe::where('code', $code)->exists();
        //dd( $cls_exist);
        if (!$cls_exist) {
            $mydate = Carbon::now();
            $moisCourant = (int)$mydate->format('m');
            if ((6 < $moisCourant) && ($moisCourant < 12))
            {
                $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
            } else
                $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
            $annees = AnneeUniversitaire::all();
            foreach ($annees as $a)
            {
                if ($a->annee == $annee)
                {
                    $attributs['annee_universitaire_id'] = $a->id;
                    break;
                }
            }
            switch($request->niveau){
                case 1:
                    $niveau="1ère année";
                    break;
                case 2:
                    $niveau="2ème année";
                    break;
                case 3:
                    $niveau="3ème année";
                    break;

            }
            switch($request->cycle){
                case 'licence':
                    $cycle="Licence";
                    break;
                case 'master':
                    $cycle="Mastère";
                    break;
                case 'doctorat':
                    $cycle="Doctorat";
                    break;
                case 'ingenierie':
                    $cycle="Ingénierie";
                    break;

            }

            //$specialite=Specialite::find($request->specialite_id);
            $sp_cycle=$specialite->cycle;

            if(strtoupper($sp_cycle) !== strtoupper($request->cycle)){
                //Session::flash('message','notMatchCycle');
                return Redirect::back()->withErrors(['Vous ne pouvez pas attribuer la spécialité '.$specialite->nom.' aux classes '.$request->cycle]);
            }

            $nom=$niveau.' '.$cycle.' '.$specialite->nom;
            $attributs=array_merge($attributs,["nom"=>$nom]);

            $classe=Classe::create($attributs);
			/*$classe=new Classe();
			$classe->code=$code;
			$classe->niveau=$niveau;
			$classe->cycle=$cycle;
			$classe->specialite_id=$request->specialite_id;
			$classe->annee_universitaire_id=$attributs['annee_universitaire_id'];*/
//dd($classe);
            $classe_id=$classe->id;
            $classes=Classe::with('typeStage')->get();
            /*$error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "");
            return view('admin.configuration.generale.typeStage_classe', ['classe' => $classe,'classes' => $classes,'error_message'=>$error_message]);*/
            //return redirect()->action([TypeStageController::class,'create'],$classe);
            return redirect()->action([TypeStageController::class,'create'],$classe_id);


        }else {
            Session::flash('message', 'ko');
        }

        return redirect()->action([ClasseController::class,'index']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function edit(Classe $classe)
    {
        return  view('admin.etablissement.classe.modifier_classe',['classe'=> $classe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $classe)
    {
        $attributs = $request->validate([
            //'nom' => ['required', 'string', 'max:255'],
            //'code' => ['required', 'string', 'max:255',  Rule::unique('classes','code')->ignore($classe->id)],
            'niveau' => ['required', 'string', 'max:255'],
            'cycle' => ['required', 'string', 'max:255'],
            'specialite_id' => ['required', Rule::exists('specialites', 'id')],
        ]);

        $specialite=Specialite::find($request->specialite_id);
        $code=$request->niveau.strtoupper(substr($request->cycle,0,1)).$specialite->code;
        $attributs['code']=$code;
        if ($classe->typeStage->fiche_demande_type =="requis") {
            if($code != $classe->code)
            {

                $fiche_demande_name = $classe->typeStage->fiche_demande;
                //dd($classe->typeStage->nom);
                $array=$this->decouper_nom($fiche_demande_name);
                $array[2] = str_replace(' ', '',$code);
                $fiche_demande_name = $array[0].'_'.$array[1].'_'.$array[2].'_'.$array[3];
                $classe->update();
                Session::flash('message', 'update');
            }
        }
        switch($request->niveau){
            case 1:
                $niveau="1ère année";
                break;
            case 2:
                $niveau="2ème année";
                break;
            case 3:
                $niveau="3ème année";
                break;

        }
        switch($request->cycle){
            case 'licence':
                $cycle="Licence";
                break;
            case 'master':
                $cycle="Mastère";
                break;
            case 'doctorat':
                $cycle="Doctorat";
                break;
            case 'ingenierie':
                $cycle="Ingénierie";
                break;

        }
        $nom=$niveau.' '.$cycle.' '.$specialite->nom;
        $attributs['nom']=$nom;
        $classe->update($attributs);
        Session::flash('message', 'update');
        return redirect()->action([ClasseController::class,'index']);

    }
    public function decouper_nom(string $nom)
    {

        $retour = array();
        $delimiteurs = '_';
        $tok = strtok($nom, "_");
        while (strlen(join(" ", $retour)) != strlen($nom)) {
            array_push($retour, $tok);
            $tok = strtok($delimiteurs);
        }
        return $retour;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {

        $classe->delete();
        return redirect()->action([ClasseController::class,'index']);
    }















}
