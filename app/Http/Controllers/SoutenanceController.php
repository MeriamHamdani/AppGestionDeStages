<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Enseignant;
use App\Models\Soutenance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Exports\SoutenanceParSpecExport;


class SoutenanceController extends Controller
{
    public function index()
    {
        $etudiants=array();
        $stages=Stage::all();

        foreach($stages as $stage){
            $tps=TypeStage::find($stage->type_stage_id);
            $cls=Classe::find($tps->classe_id);

            if($stage->confirmation_admin==1 && $stage->confirmation_encadrant==1 && AnneeUniversitaire::find($stage->annee_universitaire_id)==$this->current_annee_univ()){

                if(((strtoupper($cls->cycle)==strtoupper('licence') && $cls->niveau==3)) || ((strtoupper($cls->cycle)==strtoupper('master') && $cls->niveau==2))){
                    $etd=Etudiant::find($stage->etudiant_id);
                    $etd->stage_id=$stage->id;
                    $etd->sujet=$stage->titre_sujet;
                    array_push($etudiants,$etd);
                }
            }

        }


        $enseignants=Enseignant::all();
        $soutenances=Soutenance::all();
        $stnc=array();

        foreach($soutenances as $soutenance){
            $color=null;
            $ts=TypeStage::find(Stage::find($soutenance->stage_id)->type_stage_id);
            $classe=Classe::find($ts->classe_id);
            if(strtoupper($classe->cycle)==strtoupper('master')){

                $color='#00BFFF';
            }
            else{

                $color='#FA58AC';
            }
            $etdNP=Etudiant::find(Stage::find($soutenance->stage_id)->etudiant_id)->nom.' '.Etudiant::find(Stage::find($soutenance->stage_id)->etudiant_id)->prenom;
            $stnc[]=[
                'date'=>$soutenance->date,
                'start'=>$soutenance->start,
                'salle'=>$soutenance->salle,
                'id'=>$soutenance->id,
                'color'=>$color,
                'title'=>$etdNP.' : '.$classe->code
            ];
        }


        return view('admin.soutenance.stnc',compact('stnc','enseignants','etudiants'));
    }

    public function store(Request $request)
    {
        //return $request->all();

            $request->validate([
            'salle'=>"required",
              'heure'=>"required",
               'president'=>"required",
                'deuxieme_membre'=>"required",
                'rapporteur'=>"required",
                'stage'=>"required",
                ]);

                $s=Soutenance::where('stage_id',$request->stage)->exists();
                //return response()->json(['error'=>$s]);
                if($s){
                    return response()->json(['error'=>'soutenance exist']);
                }


        $stage=Stage::find($request->stage);
        $etd=Etudiant::find($stage->etudiant_id);



        $un=$request->rapporteur==$request->deuxieme_membre;
        $deux=$request->rapporteur==$stage->enseignant_id;
        $trois=$request->rapporteur==$stage->president;
        $quatre=$request->deuxieme_membre==$stage->enseignant_id;
        $cinq=$request->deuxieme_membre==$stage->president;
        $six=$request->president==$stage->enseignant_id;
        if($un||$deux||$trois){
            return response()->json(['error'=>"udt"]);
            //Le rapporteur ne peut pas etre ni le président de jury ni le 2éme membre de jury ni l'encadrant de l'étudiant
        }
        if($quatre || $cinq){
            return response()->json(['error'=>"qc"]);
             //Le deuxieme membre de jury ne peut pas etre ni le président de jury ni l'encadrant de l'étudiant'
        }
        if($six){
            return response()->json(['error'=>"six"]);
             //Le président de jury ne peut pas etre  l'encadrant de l'étudiant'
        }


        $stnc=new Soutenance();
        $stnc->salle=$request->salle;
        $stnc->start_time=$request->heure;
        $stnc->date=DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $stnc->stage_id=(int)$request->stage;
        $stnc->president_id=$request->president;
        $stnc->deuxieme_membre_id=$request->deuxieme_membre;
        $stnc->rapporteur_id=$request->rapporteur;
        $stnc->annee_universitaire_id=$this->current_annee_univ()->id;
        $stnc->save();


        $stnc->etudiant=$etd->nom .' '. $etd->prenom;
        //$stnc->membres()->sync($ids);

        return response()->json($stnc);
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

    /*public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Soutenance::insert($insertArr);
        return Response::json($event);
    }*/


    public function update($id,Request $request)
    {
        $soutenance = Soutenance::find($id);
        if(! $soutenance) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $soutenance->update([
            'date' =>DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
        ]);
        return response()->json('Event updated');
    }


    public function destroy($id)
    {

        $stnc = Soutenance::find($id);
        if(! $stnc) {
            return response()->json([
                'error' => 'Soutenance introuvable'
            ], 404);
        }
        $stnc->delete();
        return $id;
    }

public function list_stnc(){

    $ann=Session::get('annee');
    if (isset($ann)) {
        $soutenances = Soutenance::where('annee_universitaire_id', $ann->id)->get();
        //dd($soutenances);
        return view('admin.soutenance.liste_soutenances', compact(['soutenances']));
    }
}

public function telecharger_pv_stnc(Request $request){
    dd($request->specialite_id);
}

public function telecharger_liste_stnc(Request $request){
    //dd($request->specialite_id);
    return Excel::download(new SoutenanceParSpecExport, 'liste_soutenances_par_specia.xlsx');
 
}

}