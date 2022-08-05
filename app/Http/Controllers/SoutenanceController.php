<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use DateTime;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Enseignant;
use App\Models\Soutenance;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Exports\SoutenanceParSpecExport;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;


class SoutenanceController extends Controller
{
    public function index()
    {
        $etudiants=array();
        $stages=Stage::all();

        foreach($stages as $stage){
            $tps=TypeStage::find($stage->type_stage_id);
            $cls=Classe::find($tps->classe_id);

            if($stage->confirmation_admin==1 && $stage->confirmation_encadrant==1 && $stage->soutenance_id==null && AnneeUniversitaire::find($stage->annee_universitaire_id)==$this->current_annee_univ() ){

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
        $stage->soutenance_id = $stnc->id;
        $stage->save();

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
        $cls = Classe::all();
        $classes = new Collection();
        foreach ($cls as $cl) {
            $isMaster = strtoupper($cl->cycle) === strtoupper('master');
            $isLicence = strtoupper($cl->cycle) === strtoupper('licence');
            if($isLicence && $cl->niveau==3 || $isMaster && $cl->niveau==2 ) {
                $classes->push($cl);
            }
        }//dd($classes);
        $soutenances = Soutenance::where('annee_universitaire_id', $ann->id)->get();
        //dd($soutenances);
        return view('admin.soutenance.liste_soutenances', compact(['soutenances','classes']));
    }
}

public function telecharger_pv_stnc(Request $request){
    $annee = StageController::current_annee_univ();
    $file_path = public_path() . '\storage\ ' . $annee->pv_global;//dd($file_path);
    $file_path = str_replace(' ', '', $file_path);//dd($file_path);
    $file_path = str_replace('/', '\\', $file_path);//dd($file_path);
    $classe = Classe::find($request->classe_id);
    $stncs = Soutenance::all(); //dd($soutenacnes);
    $soutenacnes = new Collection();
    foreach ($stncs as $stnc) {
        //dd($stnc->stage->etudiant->classe->id == $request->classe_id);
        if($stnc->stage->etudiant->classe->id == $request->classe_id) {
            $soutenacnes->push($stnc);
        }
    }//dd($soutenacnes);
    $templateProcessor = new TemplateProcessor($file_path);
    //
    $templateProcessor->setValue('classe', $classe->nom);
    //$templateProcessor->setValue('specialite',$classe->specialite->nom );//dd($templateProcessor->getVariables());

    /*foreach ($stages_actifs as $stage) {
        $templateProcessor->setValues(array('nom' => ucwords($stage->etudiant->nom), 'prenom'=> ucwords($stage->etudiant->nom),
            'societe' => $stage->etudiant->nom ,'sujet' => $stage->etudiant->nom ));
    }*/
    //dd($templateProcessor->getVariables());
    $document_with_table = new PhpWord();
    $tableStyle = array(
        'borderColor' => 'black',
        'borderSize'  => 6,
        'cellMargin'  => 400
    );
    //table licence
    $section = $document_with_table->addSection();
    $table = $section->addTable($tableStyle);
    $table->addRow();
    $table->addCell(100,array('bgColor'=> '198754'))->addText("Etudiant", array('bold' => true));
    $table->addCell(100,array('bgColor'=> '198754'))->addText("Encadrant universitaire", array('bold' => true));
    $table->addCell(100,array('bgColor'=> '198754'))->addText("Président de Jury", array('bold' => true));
    $table->addCell(100,array('bgColor'=> '198754'))->addText("Date", array('bold' => true));
    foreach ($soutenacnes as $stnc) {
        $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
        $table->addRow();
        $table->addCell()->addText("{$stnc->stage->etudiant->nom} {$stnc->stage->etudiant->prenom}");
        $table->addCell()->addText("{$stnc->stage->enseignant->nom} {$stnc->stage->enseignant->prenom}");
        $table->addCell()->addText("{$stnc->president->nom} {$stnc->president->prenom}");
        $table->addCell()->addText("{$date} à {$stnc->start_time}");

    }
    // Create writer to convert document to xml
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
    // Get all document xml code
    $fullxml = $objWriter->getWriterPart('Document')->write();
    // Get only table xml code
    $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
    $templateProcessor->setValue('table', $tablexml);
    $templateProcessor->saveAs(public_path() . '\storage\pvs_globales_' . $annee->annee . '\pvGlobal_' . str_replace(' ', '', $classe->code).'.docx');

    $file_path2 = public_path('\storage\pvs_globales_' . $annee->annee . '\pvGlobal_' .str_replace(' ', '', $classe->code) .'.docx');
    //dd($file_path2);
    if (file_exists($file_path2)) {
        Session::flash('message', 'download_OK');
        return \Illuminate\Support\Facades\Response::download($file_path2, 'pvGlobal_'.str_replace(' ', '', $classe->code) .'.docx');
    } else {
        Session::flash('message', 'pv_global_introuvable');
        exit('Pas de pv!');

    }

}

public function telecharger_liste_stnc(Request $request){
    //dd($request->specialite_id);
    return Excel::download(new SoutenanceParSpecExport, 'liste_soutenances_par_specia.xlsx');

}

}
