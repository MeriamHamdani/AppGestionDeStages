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


class SoutenanceController extends Controller
{
    public function index()
    {
        $etudiants=array();
        /*$etds=Etudiant::all();
        foreach($etds as $etd){
            $classe=Classe::find($etd->classe_id);
            if((strtoupper($classe->cycle)===strtoupper('licence') && $classe->cycle==3) || (strtoupper($classe->cycle)===strtoupper('mastere') && $classe->cycle==2)){
                array_push($etudiants,$etd);
            }
        }*/
        $stages=Stage::all();

        foreach($stages as $stage){
            $tps=TypeStage::find($stage->type_stage_id);
            $cls=Classe::find($tps->classe_id);

            if($stage->confirmation_admin==1 && $stage->confirmation_encadrant==1){

                if(((strtoupper($cls->cycle)==strtoupper('licence') && $cls->niveau==3)) || ((strtoupper($cls->cycle)==strtoupper('master') && $cls->niveau==2))){
                    $etd=Etudiant::find($stage->etudiant_id);
                    $etd->stage_id=$stage->id;

                    array_push($etudiants,$etd);
                }
            }

        }
//dd($etudiants);


        $enseignants=Enseignant::all();
        $soutenances=Soutenance::all();
        $stnc=array();

        foreach($soutenances as $soutenance){
            $stnc[]=[
                'date'=>$soutenance->date,
                'start'=>$soutenance->start,
                'salle'=>$soutenance->salle
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
                'membresJury'=>"required",
                'stage'=>"required",
                ]);



        for($i=0;$i<count($request->membresJury);$i++){
            if($request->president==(int)$request->membresJury[$i]){
                return response()->json(["err"=>"veuillez selectionner des membres de jury autres que le président "]);
            }
        }

        $stnc=new Soutenance();
        $stnc->salle=$request->salle;
        $stnc->start_time=$request->heure;
        $stnc->date=DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $stnc->stage_id=(int)$request->stage;
        $stnc->president_id=$request->president;
        $stnc->annee_universitaire_id=$this->current_annee_univ()->id;
        $stnc->save();

        $ids=array();
        for($i=0;$i<count($request->membresJury);$i++){
            array_push($ids,(int)$request->membresJury[$i]);
        }
        $stage=Stage::find($request->stage);
        $etd=Etudiant::find($stage->etudiant_id);
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
    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Soutenance::insert($insertArr);
        return Response::json($event);
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Soutenance::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Soutenance::where('id',$request->id)->delete();

        return Response::json($event);
    }




}