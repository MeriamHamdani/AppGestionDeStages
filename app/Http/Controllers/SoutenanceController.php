<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Enseignant;
use App\Models\Soutenance;
use App\Models\Specialite;
use App\Models\Departement;
use Hamcrest\Core\JavaForm;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Exports\SoutenanceParSpecExport;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\SoutenanceNotification;




class SoutenanceController extends Controller
{
    public function index()
    {
        $etudiants = array();
        $stages = Stage::all();

        foreach ($stages as $stage) {
            $tps = TypeStage::find($stage->type_stage_id);
            $cls = Classe::find($tps->classe_id);

            if ($stage->confirmation_admin == 1 && $stage->confirmation_encadrant == 1 && $stage->soutenance_id == null && AnneeUniversitaire::find($stage->annee_universitaire_id) == $this->current_annee_univ()) {

                if (((strtoupper($cls->cycle) == strtoupper('licence') && $cls->niveau == 3)) || ((strtoupper($cls->cycle) == strtoupper('master') && $cls->niveau == 2))) {
                    $etd = Etudiant::find($stage->etudiant_id);
                    $etd->stage_id = $stage->id;
                    $etd->sujet = $stage->titre_sujet;
                    array_push($etudiants, $etd);
                }
            }

        }


        $enseignants = Enseignant::all();
        $soutenances = Soutenance::all();
        $stnc = array();

        foreach ($soutenances as $soutenance) {
            $color = null;
            $ts = TypeStage::find(Stage::find($soutenance->stage_id)->type_stage_id);
            $classe = Classe::find($ts->classe_id);
            if (strtoupper($classe->cycle) == strtoupper('master')) {

                $color = '#00BFFF';
            } else {

                $color = '#FA58AC';
            }
            $etdNP = Etudiant::find(Stage::find($soutenance->stage_id)->etudiant_id)->nom . ' ' . Etudiant::find(Stage::find($soutenance->stage_id)->etudiant_id)->prenom;
            $stnc[] = [
                'date' => $soutenance->date,
                'start' => $soutenance->start,
                'salle' => $soutenance->salle,
                'id' => $soutenance->id,
                'color' => $color,
                'title' => $etdNP . ' : ' . $classe->code
            ];
        }


        return view('admin.soutenance.stnc', compact('stnc', 'enseignants', 'etudiants'));
    }

    public function store(Request $request)
    {
        //return $request->all();

        $request->validate([
            'salle' => "required",
            'heure' => "required",
            'president' => "required",
            'deuxieme_membre' => "required",
            'rapporteur' => "required",
            'stage' => "required",
        ]);

        $s = Soutenance::where('stage_id', $request->stage)->exists();
        //return response()->json(['error'=>$s]);
        if ($s) {
            return response()->json(['error' => 'soutenance exist']);
        }


        $stage = Stage::find($request->stage);
        $etd = Etudiant::find($stage->etudiant_id);


        $un = $request->rapporteur == $request->deuxieme_membre;
        $deux = $request->rapporteur == $stage->enseignant_id;
        $trois = $request->rapporteur == $stage->president;
        $quatre = $request->deuxieme_membre == $stage->enseignant_id;
        $cinq = $request->deuxieme_membre == $stage->president;
        $six = $request->president == $stage->enseignant_id;
        $soutenances=Soutenance::where(['salle'=>$request->salle,'date'=>DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d')])->get();
       // return($soutenances->count());
        if($soutenances->count()>0)
        {
            foreach($soutenances as $st){
                if($this->occupee($st->start_time,$request->heure)){
                    //return $st->start_time;
                    return response()->json(['error'=>'so']);
                }
            }
        }
        if ($un || $deux || $trois) {
            return response()->json(['error' => "udt"]);
            //Le rapporteur ne peut pas etre ni le président de jury ni le 2éme membre de jury ni l'encadrant de l'étudiant
        }
        if ($quatre || $cinq) {
            return response()->json(['error' => "qc"]);
            //Le deuxieme membre de jury ne peut pas etre ni le président de jury ni l'encadrant de l'étudiant'
        }
        if ($six) {
            return response()->json(['error' => "six"]);
            //Le président de jury ne peut pas etre  l'encadrant de l'étudiant'
        }
        $encadrant=Enseignant::find($stage->enseignant_id);

        $stnc = new Soutenance();
        $stnc->salle = $request->salle;
        $stnc->start_time = $request->heure;
        $stnc->date = DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $stnc->stage_id = (int)$request->stage;
        $stnc->president_id = $request->president;
        $stnc->deuxieme_membre_id = $request->deuxieme_membre;
        $stnc->rapporteur_id = $request->rapporteur;
        $stnc->annee_universitaire_id = $this->current_annee_univ()->id;
        $stnc->save();
        $stage->soutenance_id = $stnc->id;
        $stage->save();

        //$stnc->membres()->sync($ids);


        $encadrant = Enseignant::find($request->encadrant);
        $president = Enseignant::find($request->president);
        $membre = Enseignant::find($request->deuxieme_membre);
        $rapporteur = Enseignant::find($request->rapporteur);
        $data = ['etud' => ucwords($etd->nom . ' ' . $etd->prenom),
            'post' => '',
            'encadrant' => ucwords($encadrant->nom . ' ' . $encadrant->prenom),
            'president' => ucwords($president->nom . ' ' . $president->prenom),
            'date' => DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
            'membre' => ucwords($membre->nom . ' ' . $membre->prenom),
            'rapporteur' => ucwords($rapporteur->nom . ' ' . $rapporteur->prenom)
        ];

         //$president->notify(new SoutenanceNotification($data) );
         //$etd->notify(new SoutenanceNotification($data));
        return response()->json($stnc);
    }

    public function occupee(String  $t1, String $t2)
    {
        if($t1===$t2){
            return true;
        }
        $hm1=explode(':',$t1);
        $hm2=explode(':',$t2);
        if($hm1[0]==$hm2[0]){
            if((int)$hm1[1]<(int)$hm2[1]){
                if((int)$hm1[1]+30 > (int)$hm2[1]){
                    return true;
                }
            }else{
                if((int)$hm1[1]-30 < (int)$hm2[1]){
                    return true;
                }
            }
        }elseif($hm1[0]-$hm2[0]==1 || $hm1[0]-$hm2[0]==-1){
            if((int)$hm1[0]<(int)$hm2[0]){
                if((int)$hm1[1]+30 <= 59){
                        return false;
                }else{
                    if((int)$hm1[1]-30 < $hm2[1] ){
                        return true;
                    }
                }

            }else{
                if((int)$hm2[1]-30 <= 1){
                    return false;
                }else{
                    if((int)$hm1[1]+30 > $hm2[1]){
                        return true;
                    }
                }
            }
        }
            return false;
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


    public function update($id, Request $request)
    {
        $soutenance = Soutenance::find($id);
        if (!$soutenance) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $soutenance->update([
            'date' => DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
        ]);
        return response()->json('Event updated');
    }


    public function destroy($id)
    {

        $stnc = Soutenance::find($id);
        if (!$stnc) {
            return response()->json([
                'error' => 'Soutenance introuvable'
            ], 404);
        }
        $stnc->delete();
        return $id;
    }

    public function list_stnc()
    {

        $ann = Session::get('annee');
        if (isset($ann)) {
            $cls = Classe::all();
            $classes = new Collection();
            foreach ($cls as $cl) {
                $isMaster = strtoupper($cl->cycle) === strtoupper('master');
                $isLicence = strtoupper($cl->cycle) === strtoupper('licence');
                if ($isLicence && $cl->niveau == 3 || $isMaster && $cl->niveau == 2) {
                    $classes->push($cl);
                }
            }//dd($classes);

            $soutenances = Soutenance::where('annee_universitaire_id', $ann->id)->get();
            //dd($soutenances);
            return view('admin.soutenance.liste_soutenances', compact(['soutenances', 'classes']));
        }
    }


    public function telecharger_pv_stnc(Request $request)
    {
        $annee = StageController::current_annee_univ();
        $file_path = public_path() . '\storage\ ' . $annee->pv_global;//dd($file_path);
        $file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);
        $classe = Classe::find($request->classe_id);
        $stncs = Soutenance::all(); //dd($soutenacnes);
        $soutenacnes = new Collection();
        foreach ($stncs as $stnc) {
            //dd($stnc->stage->etudiant->classe->id == $request->classe_id);
            if ($stnc->stage->etudiant->classe->id == $request->classe_id) {
                $soutenacnes->push($stnc);
            }
        }
        $templateProcessor = new TemplateProcessor($file_path);

        $templateProcessor->setValue('classe', $classe->nom);

        $document_with_table = new PhpWord();
        $tableStyle = array(
            'borderColor' => 'black',
            'borderSize' => 6,
            'cellMargin' => 400
        );
        //table licence
        $section = $document_with_table->addSection();
        $table = $section->addTable($tableStyle);
        $table->addRow();
        $table->addCell(100, array('bgColor' => '198754'))->addText("Etudiant", array('bold' => true));
        $table->addCell(100, array('bgColor' => '198754'))->addText("Encadrant universitaire", array('bold' => true));
        $table->addCell(100, array('bgColor' => '198754'))->addText("Président de Jury", array('bold' => true));
        $table->addCell(100, array('bgColor' => '198754'))->addText("Date", array('bold' => true));
        foreach ($soutenacnes as $stnc) {
            $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
            $table->addRow();
            $table->addCell()->addText("{$stnc->stage->etudiant->nom} {$stnc->stage->etudiant->prenom}");
            $table->addCell()->addText("{$stnc->stage->enseignant->nom} {$stnc->stage->enseignant->prenom}");
            $table->addCell()->addText("{$stnc->president->nom} {$stnc->president->prenom}");
            $table->addCell()->addText("{$date} à {$stnc->start_time}");

        }
        // Create writer to convert document to xml
        $objWriter = IOFactory::createWriter($document_with_table, 'Word2007');
        // Get all document xml code
        $fullxml = $objWriter->getWriterPart('Document')->write();
        // Get only table xml code
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
        $templateProcessor->setValue('table', $tablexml);
        $templateProcessor->saveAs(public_path() . '\storage\pvs_globales_' . $annee->annee . '\pvGlobal_' . str_replace(' ', '', $classe->code) . '.docx');

        $file_path2 = public_path('\storage\pvs_globales_' . $annee->annee . '\pvGlobal_' . str_replace(' ', '', $classe->code) . '.docx');
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');
            return \Illuminate\Support\Facades\Response::download($file_path2, 'pvGlobal_' . str_replace(' ', '', $classe->code) . '.docx');
        } else {
            Session::flash('message', 'pv_global_introuvable');
            exit('Pas de pv!');

        }

    }

    public function telecharger_liste_stnc(Request $request)
    {
        $cls = str_replace(" ", "", Classe::find($request->classe_id)->code); //dd($cls);
        return Excel::download(new SoutenanceParSpecExport, 'liste_soutenances_' . $cls . '.xlsx');

    }

    public function telecharger_pv_indiv($soutenance)
    {
        $annee = StageController::current_annee_univ();
        $file_path = public_path() . '\storage\ ' . $annee->pv_individuel;
        $file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);
        $templateProcessor = new TemplateProcessor($file_path);
        $stnc = Soutenance::find($soutenance); //dd($stnc);
        //dd(today()->toDate()->setDate(2010,01,10));
        $templateProcessor->setValue('date', today()->format('Y-m-d'));
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('classe', $stnc->stage->etudiant->classe->nom);
        $templateProcessor->setValue('sujet', $stnc->stage->titre_sujet);
        $templateProcessor->setValue('presJury', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->nom . ' ' . Enseignant::find($stnc->deuxieme_membre_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $templateProcessor->setValue('gradeP', ucwords($stnc->president->grade));
        $templateProcessor->setValue('gradeM', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->grade));
        $templateProcessor->setValue('gradeE', ucwords($stnc->stage->enseignant->grade));
        $templateProcessor->saveAs(public_path() . '\storage\pvs_indiv_' . $annee->annee . '\pv_indiv_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->classe->code . '.docx');
        $file_path2 = public_path() . '\storage\pvs_indiv_' . $annee->annee . '\pv_indiv_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->classe->code . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'pvIndiv_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->classe->code . '.docx');
        } else {
            Session::flash('message', 'pv_indiv_introuvable');
            exit('Pas de pv indiv!');

        }
        //dd(Soutenance::find($soutenance));
    }

    static function isInfo(Classe $classe)
    {
        $departement_nom = Departement::findOrFail($classe->specialite->departement_id)->nom;
        $dep_is_info = strpos('departement ' . strtoupper($departement_nom), strtoupper('informatique')) > 0;
        if ($dep_is_info) {
            return true;
        } else return false;
    }

    public function telecharger_grille_lic_non_info($soutenance)
    {
        $stnc = Soutenance::find($soutenance);
        $annee = StageController::current_annee_univ();
        $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
        $file_path = public_path() . '\storage\ ' . $annee->grille_evaluation_licence;
        $file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);
        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('classe', $stnc->stage->etudiant->classe->nom);
        $templateProcessor->setValue('cin', $stnc->stage->etudiant->user->numero_CIN);
        $templateProcessor->setValue('date_soutenance', $date);
        $templateProcessor->setValue('heure_soutenance', $stnc->start_time);
        $templateProcessor->setValue('sujet', ucwords($stnc->stage->titre_sujet));
        $templateProcessor->setValue('president', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->nom . ' ' . Enseignant::find($stnc->deuxieme_membre_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $path = public_path() . '\storage\grilles_evaluations_' . $annee->annee . '\grilles_' . $stnc->stage->etudiant->classe->code;  //dd($path);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $templateProcessor->saveAs($path . '\grilleEvalLic_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx');
        $file_path2 = $path . '\grilleEvalLic_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'grille_evaluation_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx');
        } else {
            Session::flash('message', 'pv_indiv_introuvable');
            exit('Pas de grille!');

        }

    }

    public function telecharger_grille_lic_info($soutenance)
    {
        $stnc = Soutenance::find($soutenance);
        $annee = StageController::current_annee_univ();
        $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
        $file_path = public_path() . '\storage\ ' . $annee->grille_evaluation_info;
        $file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);
        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('date_soutenance', $date);
        $templateProcessor->setValue('heure_soutenance', $stnc->start_time);
        $templateProcessor->setValue('sujet', ucwords($stnc->stage->titre_sujet));
        $templateProcessor->setValue('president', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->nom . ' ' . Enseignant::find($stnc->deuxieme_membre_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $path = public_path() . '\storage\grilles_evaluations_' . $annee->annee . '\grilles_' . $stnc->stage->etudiant->classe->code;  //dd($path);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $templateProcessor->saveAs($path . '\grilleEvalLicInfo_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx');
        $file_path2 = $path . '\grilleEvalLicInfo_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'grille_evaluation_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx');
        } else {
            Session::flash('message', 'pv_indiv_introuvable');
            exit('Pas de grille!');

        }

    }

    public function telecharger_grille_mastere($soutenance)
    {
        $stnc = Soutenance::find($soutenance);
        $annee = StageController::current_annee_univ();
        $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
        $file_path = public_path() . '\storage\ ' . $annee->grille_evaluation_master;
        $file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);
        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('classe', $stnc->stage->etudiant->classe->nom);
        $templateProcessor->setValue('cin', $stnc->stage->etudiant->user->numero_CIN);
        $templateProcessor->setValue('date_soutenance', $date);
        $templateProcessor->setValue('heure_soutenance', $stnc->start_time);
        $templateProcessor->setValue('sujet', ucwords($stnc->stage->titre_sujet));
        $templateProcessor->setValue('president', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->nom . ' ' . Enseignant::find($stnc->deuxieme_membre_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $path = public_path() . '\storage\grilles_evaluations_' . $annee->annee . '\grilles_' . $stnc->stage->etudiant->classe->code;  //dd($path);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $templateProcessor->saveAs($path . '\grilleEvalMaster_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx');
        $file_path2 = $path . '\grilleEvalMaster_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'grille_evaluation_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '.docx');
        } else {
            Session::flash('message', 'pv_indiv_introuvable');
            exit('Pas de grille!');

        }
    }

    public function evaluer_soutenance(Soutenance $soutenance)
    {
        $soutenance->stage->validation_admin = 1; //dd($soutenance->stage);
        $soutenance->stage->update();
        Session::flash('message', 'valid_stnc');
        return back();
    }



    public function soutenance_etudiant()
    {
        $etudiants = Etudiant::where('user_id', Auth::user()->id)->get(); //dd($etudiants);
        $soutenances = new Collection();
        foreach ($etudiants as $etudiant) {
            $stages = Stage::where('etudiant_id', $etudiant->id)->get();
            foreach ($stages as $s) {
                $stncs = Soutenance::where('stage_id',$s->id)->get();
                foreach ($stncs as $stnc) {
                    $soutenances->push($stnc);
                }
            }
        }
       // dd($soutenances);
        return view('etudiant.soutenance.liste_soutenances',compact('soutenances'));
    }
    public function details_soutenance_etudiant(Soutenance $soutenance)
    {
        $date = Arr::first((TypeStageController::decouper_nom($soutenance->date)));
        return view('etudiant.soutenance.info_soutenance',compact('soutenance','date'));
    }

}