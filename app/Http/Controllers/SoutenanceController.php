<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use DateTime;
use Notification;
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
use phpDocumentor\Reflection\Types\Integer;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Exports\SoutenanceParSpecExport;
use App\Notifications\EditSoutenanceNotification;
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

            //$stage->confirmation_admin == 1 && $stage->confirmation_encadrant == 1
            if ($stage->validation_admin == 1 && $stage->soutenance_id == null && AnneeUniversitaire::find($stage->annee_universitaire_id) == $this->current_annee_univ()) {

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
            $etud=Etudiant::find(Stage::find($soutenance->stage_id)->etudiant_id);
            $etdNP = $etud->nom . ' ' . Etudiant::find(Stage::find($soutenance->stage_id)->etudiant_id)->prenom;

            $sttg=Stage::find($soutenance->stage_id);
            $etud->stage_id=$sttg->id;
            $stnc[] = [
                'date' => $soutenance->date,
                'start' => $soutenance->start,
                'salle' => $soutenance->salle,
                'heure'=>$soutenance->start_time,
				'president'=>Enseignant::find($soutenance->president_id),
				'president'=>Enseignant::find($soutenance->rapporteur_id),
				'president'=>Enseignant::find($soutenance->deuxieme_membre_id),
                'etudiant'=>$etud,
                'stage'=>$sttg,
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
            //'deuxieme_membre' => "required",
            'rapporteur' => "required",
            'stage' => "required",
        ]);
return $request->deuxieme_membre;
        $s = Soutenance::where('stage_id', $request->stage)->exists();
        //return response()->json(['error'=>$s]);
        if ($s) {
            return response()->json(['error' => 'soutenance exist']);
        }

        $stage = Stage::find($request->stage);
        $etd = Etudiant::find($stage->etudiant_id);

        $un = $request->rapporteur == $request->deuxieme_membre;
        $deux = $request->rapporteur == $stage->enseignant_id;
        $trois = ($request->rapporteur == $stage->president);
        $quatre = $request->deuxieme_membre == $stage->enseignant_id;
        $cinq = $request->deuxieme_membre == $stage->president;
        $six = $request->president == $stage->enseignant_id;

        $soutenances = Soutenance::where(['salle' => $request->salle, 'date' => DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d')])->get();
        // return($soutenances->count());
        if ($soutenances->count() > 0) {
            foreach ($soutenances as $st) {
                if ($this->occupee($st->start_time, $request->heure)) {
                    //return $st->start_time;
                    return response()->json(['error' => 'so']);
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

        $encadrant = Enseignant::find($stage->enseignant_id);
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

        $encadrant = Enseignant::find($stage->enseignant_id);
        $president = Enseignant::find($request->president);
        $membre = Enseignant::find($request->deuxieme_membre);
        $rapporteur = Enseignant::find($request->rapporteur);


        //$president->notify(new SoutenanceNotification($data) );
        //$etd->notify(new SoutenanceNotification($data));

        $enc_name = ucwords($encadrant->nom . ' ' . $encadrant->prenom);
        $etd->notify(new SoutenanceNotification($stnc, $etd, $enc_name, 'etudiant'));
        $president->notify(new SoutenanceNotification($stnc, $etd, $enc_name, 'president de jury'));
        $membre->notify(new SoutenanceNotification($stnc, $etd, $enc_name, 'membre de jury'));
        $rapporteur->notify(new SoutenanceNotification($stnc, $etd, $enc_name, 'rapporteur'));
        $encadrant->notify(new SoutenanceNotification($stnc, $etd, $enc_name, 'encadrant'));

        return response()->json($stnc);

    }

    public function occupee(string $t1, string $t2)
    {
        if ($t1 === $t2) {
            return true;
        }
        $hm1 = explode(':', $t1);
        $hm2 = explode(':', $t2);
        if ($hm1[0] == $hm2[0]) {
            if ((int)$hm1[1] < (int)$hm2[1]) {
                if ((int)$hm1[1] + 30 > (int)$hm2[1]) {
                    return true;
                }
            } else {
                if ((int)$hm1[1] - 30 < (int)$hm2[1]) {
                    return true;
                }
            }
        } elseif ($hm1[0] - $hm2[0] == 1 || $hm1[0] - $hm2[0] == -1) {
            if ((int)$hm1[0] < (int)$hm2[0]) {
                if ((int)$hm1[1] + 30 <= 59) {
                    return false;
                } else {
                    if ((int)$hm1[1] - 30 < $hm2[1]) {
                        return true;
                    }
                }

            } else {
                if ((int)$hm2[1] - 30 <= 1) {
                    return false;
                } else {
                    if ((int)$hm1[1] + 30 > $hm2[1]) {
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

	public function edit($id, Request $request){
		$soutenance = Soutenance::find($id);
        $stage=Stage::find($soutenance->stage_id);
        $etudiant=Etudiant::find($stage->etudiant_id);
        $encadrant=Enseignant::find($stage->enseignant_id);
        $nouveauPr=null;
        $nouveauRap=null;
        $nouveau2m=null;

        $ancienPr=null;
        $ancienRap=null;
        $ancien2m=null;

        $nvDate=null;
        $nvHeure=null;
        $nvSalle=null;
        //return response()->json($soutenance->president_id!=$request->presidentE);

        if($soutenance->president_id!=$request->presidentE)
        {
            $ancienPr=Enseignant::find($soutenance->president_id);
			$nouveauPr=Enseignant::find($request->presidentE);
           // $soutenance->president_id=$nouveauPr->id;
			//$soutenance->update();
			//$ancienPr->notify(new EditSoutenanceNotification($soutenance,'ancien','president',$etudiant));
		}
        if($soutenance->rapporteur_id!=$request->rapporteurE){
             $ancienRap=Enseignant::find($soutenance->rapporteur_id);
			$nouveauRap=Enseignant::find($request->rapporteurE);
            //$soutenance->rapporteur_id=$nouveauRap->id;
			//$soutenance->update();
			//$ancienRap->notify(new EditSoutenanceNotification($soutenance,'ancien','rapporteur',$etudiant));
        }

		if($soutenance->deuxieme_membre_id==null)
		{

			if($request->deuxieme_membreE!='null'){
				$nouveau2m=Enseignant::find($request->deuxieme_membreE);
			}

		}else{
			$ancien2m=Enseignant::find($soutenance->deuxieme_membre_id);
			if($request->deuxieme_membreE!='null'){
                //return gettype($request->deuxieme_membreE);
                if($request->deuxieme_membreE!=$soutenance->deuxieme_membre_id){

                //$ancien2m=Enseignant::find($soutenance->deuxieme_membre_id);
				$nouveau2m=Enseignant::find($request->deuxieme_membreE);
                //return ($nouveau2m);
				$soutenance->deuxieme_membre_id=$request->deuxieme_membreE;
				$soutenance->update();
                }

			}else{
                $soutenance->deuxieme_membre_id=null;
                //$soutenance->update();
                //$ancien2m->notify(new EditSoutenanceNotification($soutenance,'ancien','deuxieme membre',$etudiant));
            }

		}

//---------------------------------------------------------------*****-------------------------------------------------------

        if($request->dateE!=null && $soutenance->date!=$request->dateE){
            $nvDate=$request->dateE;
            //$soutenance->date=$request->dateE;
            //$soutenance->update();
        }

        if($soutenance->start_time!=$request->heureE || $soutenance->salle!=$request->salleE || $soutenance->date!=$request->dateE)
        {

            if($request->dateE!=null){$d=$request->dateE;}else{$d=$soutenance->date;}
            //return $d;
            $soutenances = Soutenance::where(['salle' => $request->salleE, 'date' => $d])->where('id','!=',$soutenance->id)->get();
            //return $soutenances;
            if ($soutenances->count() > 0) {
                foreach ($soutenances as $st) {
                    if ($this->occupee($st->start_time, $request->heureE)) {
                    //return $st->start_time;
                    return response()->json(['error' => 'salle-occ']);
                        }

                    }
            }
                    $today=date('Y-m-d');
                    //return $today;
                    if($request->dateE!=null){
                        $time_input = strtotime($request->dateE);
                        $date_input = getDate($time_input);
                        if($date_input <= $today){return response()->json(['error'=>'date_invalide']);}
						else
                        {$nvDate=$request->dateE;}
                    }
                    $nvHeure=$request->heureE;
                    $nvSalle=$request->salleE;

        }
        $un = $request->rapporteurE == $request->deuxieme_membreE;
        $deux = $request->rapporteurE == $stage->enseignant_id;
        $trois = ($request->rapporteurE == $request->presidentE);
        $quatre = $request->deuxieme_membreE == $stage->enseignant_id;
        $cinq = $request->deuxieme_membreE == $request->presidentE;
        $six = $request->presidentE == $stage->enseignant_id;

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

			if($nvDate!=null){$soutenance->date=$nvDate;}
			if($nvHeure!=null){$soutenance->start_time=$nvHeure;}
			if($nvSalle!=null){$soutenance->salle=$nvSalle;}

            if($nouveauPr!=null)
			{
				$soutenance->president_id=$nouveauPr->id;
                $ancienPr->notify(new EditSoutenanceNotification($soutenance,'ancien','president',$etudiant));
				$nouveauPr->notify(new EditSoutenanceNotification($soutenance,'nouveau','president de jury',$etudiant));
			}
			 if($nouveauRap!=null)
			{
				$soutenance->rapporteur_id=$nouveauRap->id;
				$nouveauRap->notify(new EditSoutenanceNotification($soutenance,'nouveau','rapporteur',$etudiant));
                $ancienRap->notify(new EditSoutenanceNotification($soutenance,'ancien','rapporteur',$etudiant));
            }
			if($nouveau2m!=null)
			{
				$soutenance->deuxieme_membre_id=$nouveau2m->id;
				$nouveau2m->notify(new EditSoutenanceNotification($soutenance,'nouveau','deuxième membre de jury',$etudiant));
			}
            if($ancien2m!=null){
                $ancien2m->notify(new EditSoutenanceNotification($soutenance,'ancien','deuxieme membre',$etudiant));
            }
            $soutenance->update();
            $etudiant->notify(new EditSoutenanceNotification($soutenance,'--','etudiant',$etudiant));
			$encadrant->notify(new EditSoutenanceNotification($soutenance,'--','encadrant',$etudiant));
		return response()->json('Event edited');
	}

    public function notifier($id, Request $request)
    {

        $etudiant = Etudiant::find($request->etudiant_id);

        $soutenance = Soutenance::find($id);
        Notification::send($etudiant, new SoutenanceNotification($soutenance, $etudiant, $request->encadrant, $request->post));
        //$etudiant->notify(new SoutenanceNotification($soutenance,$etudiant,$request->encadrant,$request->post));
        return true;

    }


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
        $etablissement = Etablissement::all()->first()->nom;
        //$anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
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
        $file_path2 = public_path() . '/storage/' . $etablissement . '-' . $annee->annee . '/fiches_suivi_stages/fiches_soutenances/pv_globales';
        if (!File::isDirectory($file_path2)) {
            File::makeDirectory($file_path2, 0777, true, true);
        }
        $templateProcessor->saveAs($file_path2 . '/pvGlobal_' . str_replace(' ', '', $classe->code) . '.docx');
        $path_file = $file_path2 . '/pvGlobal_' . str_replace(' ', '', $classe->code) . '.docx';
        //   dd($path_file);
        if (file_exists($path_file)) {
            Session::flash('message', 'download_OK');
            return \Illuminate\Support\Facades\Response::download($path_file, 'pvGlobal_' . str_replace(' ', '', $classe->code) . '.docx');
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
        $etablissement = Etablissement::all()->first()->nom;
        $file_path = public_path() . '/storage/' . $annee->pv_individuel;
        /* $file_path = str_replace(' ', '', $file_path);//dd($file_path);
         $file_path = str_replace('/', '\\', $file_path);//dd($file_path);*/
        $templateProcessor = new TemplateProcessor($file_path);
        $stnc = Soutenance::find($soutenance); //dd($stnc);str_replace(' ', '', $classe->code)
        $code_classe = str_replace(' ', '', ($stnc->stage->etudiant->classe)->code);
        $templateProcessor->setValue('date', today()->format('Y-m-d'));
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('classe', $stnc->stage->etudiant->classe->nom);
        $templateProcessor->setValue('sujet', $stnc->stage->titre_sujet);
        $templateProcessor->setValue('presJury', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre', ucwords(Enseignant::find($stnc->rapporteur_id)->nom . ' ' . Enseignant::find($stnc->rapporteur_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $templateProcessor->setValue('gradeP', ucwords($stnc->president->grade));
        $templateProcessor->setValue('gradeM', ucwords(Enseignant::find($stnc->rapporteur_id)->grade));
        $templateProcessor->setValue('gradeE', ucwords($stnc->stage->enseignant->grade));
        $file_path2 = public_path() . '/storage/' . $etablissement . '-' . $annee->annee . '/fiches_suivi_stages/fiches_soutenances/pv_individuels/pv_indiv_' . $code_classe;//dd($file_path2);
        if (!File::isDirectory($file_path2)) {
            File::makeDirectory($file_path2, 0777, true, true);
        }
        $templateProcessor->saveAs($file_path2 . '\pvIndiv_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx');
        $path_file = $file_path2 . '\pvIndiv_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx';
        // $file_path2 = public_path() . '\storage\pvs_indiv_' . $annee->annee . '\pv_indiv_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->classe->code . '.docx';
        if (file_exists($path_file)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($path_file, 'pvIndiv_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->classe->code . '.docx');
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
        $etablissement = Etablissement::all()->first()->nom;
        $code_classe = str_replace(' ', '', ($stnc->stage->etudiant->classe)->code);
        $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
        $file_path = public_path() . '/storage/' . $annee->grille_evaluation_licence;
        /*$file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);*/
        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('classe', $stnc->stage->etudiant->classe->nom);
        $templateProcessor->setValue('cin', $stnc->stage->etudiant->user->numero_CIN);
        $templateProcessor->setValue('date_soutenance', $date);
        $templateProcessor->setValue('heure_soutenance', $stnc->start_time);
        $templateProcessor->setValue('sujet', ucwords($stnc->stage->titre_sujet));
        $templateProcessor->setValue('president', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->rapporteur_id)->nom . ' ' . Enseignant::find($stnc->rapporteur_id)->prenom));
        //$templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->nom . ' ' . Enseignant::find($stnc->deuxieme_membre_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $path = public_path() . '/storage/' . $etablissement . '-' . $annee->annee . '/fiches_suivi_stages/fiches_soutenances/grilles_évaluations/grilles_évaluations_' . $code_classe;//dd($file_path2);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $templateProcessor->saveAs($path . '\grilleEvalLic_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx');
        $file_path2 = $path . '\grilleEvalLic_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'grille_evaluation_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx');
        } else {
            Session::flash('message', 'pv_indiv_introuvable');
            exit('Pas de grille!');

        }

    }

    public function telecharger_grille_lic_info($soutenance)
    {
        $stnc = Soutenance::find($soutenance);
        $annee = StageController::current_annee_univ();
        $etablissement = Etablissement::all()->first()->nom;
        $code_classe = str_replace(' ', '', ($stnc->stage->etudiant->classe)->code);
        $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
        $file_path = public_path() . '/storage/' . $annee->grille_evaluation_info;
        /*$file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);*/
        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('date_soutenance', $date);
        $templateProcessor->setValue('heure_soutenance', $stnc->start_time);
        $templateProcessor->setValue('sujet', ucwords($stnc->stage->titre_sujet));
        $templateProcessor->setValue('president', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->rapporteur_id)->nom . ' ' . Enseignant::find($stnc->rapporteur_id)->prenom));
        //$templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->nom . ' ' . Enseignant::find($stnc->deuxieme_membre_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $path = public_path() . '/storage/' . $etablissement . '-' . $annee->annee . '/fiches_suivi_stages/fiches_soutenances/grilles_évaluations/grilles_évaluations_' . $code_classe;//dd($file_path2);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $templateProcessor->saveAs($path . '\grilleEvalLicInfo_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx');
        $file_path2 = $path . '\grilleEvalLicInfo_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'grille_evaluation_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx');
        } else {
            Session::flash('message', 'pv_indiv_introuvable');
            exit('Pas de grille!');

        }

    }

    public function telecharger_grille_mastere($soutenance)
    {
        $stnc = Soutenance::find($soutenance);
        $annee = StageController::current_annee_univ();
        $etablissement = Etablissement::all()->first()->nom;
        $code_classe = str_replace(' ', '', ($stnc->stage->etudiant->classe)->code);
        $date = Arr::first((TypeStageController::decouper_nom($stnc->date)));
        $file_path = public_path() . '/storage/' . $annee->grille_evaluation_master;
        /* $file_path = str_replace(' ', '', $file_path);//dd($file_path);
         $file_path = str_replace('/', '\\', $file_path);//dd($file_path);*/
        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('etudiant', ucwords($stnc->stage->etudiant->nom . ' ' . $stnc->stage->etudiant->prenom));
        $templateProcessor->setValue('classe', $stnc->stage->etudiant->classe->nom);
        $templateProcessor->setValue('cin', $stnc->stage->etudiant->user->numero_CIN);
        $templateProcessor->setValue('date_soutenance', $date);
        $templateProcessor->setValue('heure_soutenance', $stnc->start_time);
        $templateProcessor->setValue('sujet', ucwords($stnc->stage->titre_sujet));
        $templateProcessor->setValue('president', ucwords($stnc->president->nom . ' ' . $stnc->president->prenom));
        $templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->rapporteur_id)->nom . ' ' . Enseignant::find($stnc->rapporteur_id)->prenom));
        //$templateProcessor->setValue('membre_jury', ucwords(Enseignant::find($stnc->deuxieme_membre_id)->nom . ' ' . Enseignant::find($stnc->deuxieme_membre_id)->prenom));
        $templateProcessor->setValue('encadrant', ucwords($stnc->stage->enseignant->nom . ' ' . $stnc->stage->enseignant->prenom));
        $path = public_path() . '/storage/' . $etablissement . '-' . $annee->annee . '/fiches_suivi_stages/fiches_soutenances/grilles_évaluations/grilles_évaluations_' . $code_classe;//dd($file_path2);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $templateProcessor->saveAs($path . '\grilleEvalMaster_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx');
        $file_path2 = $path . '\grilleEvalMaster_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'grille_evaluation_' . $stnc->stage->etudiant->nom . '-' . $stnc->stage->etudiant->prenom . '-' . $stnc->stage->etudiant->user->numero_CIN . '.docx');
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
                $stncs = Soutenance::where('stage_id', $s->id)->get();
                foreach ($stncs as $stnc) {
                    $soutenances->push($stnc);
                }
            }
        }
        // dd($soutenances);
        return view('etudiant.soutenance.liste_soutenances', compact('soutenances'));
    }

    public function details_soutenance_etudiant(Soutenance $soutenance)
    {
        $date = Arr::first((TypeStageController::decouper_nom($soutenance->date)));
        return view('etudiant.soutenance.info_soutenance', compact('soutenance', 'date'));
    }

    public function soutenance_encadrant()
    {
        $encadrant = Enseignant::where('user_id', Auth::user()->id)->first(); //dd($encadrant);
        $anneeUniv = StageController::current_annee_univ();
        $stncs = Soutenance::where('annee_universitaire_id', $anneeUniv->id)->get();//dd($stncs);
        $soutenances = new Collection();
        foreach ($stncs as $st) {
            if ($st->stage->enseignant->id == $encadrant->id) {
                $soutenances->push($st);
            }
        } //dd($soutenances);
        return view('enseignant.soutenance.role_encadrant', compact('soutenances'));
    }

    public function details_soutenance_encadrant(Soutenance $soutenance)
    {
        $date = Arr::first((TypeStageController::decouper_nom($soutenance->date)));
        return view('enseignant.soutenance.info_soutenance', compact('soutenance', 'date'));
    }


    public function details_soutenance_membre(Soutenance $soutenance)
    {
        $date = Arr::first((TypeStageController::decouper_nom($soutenance->date)));
        return view('enseignant.soutenance.info_soutenance_membre', compact('soutenance', 'date'));
    }

    public function telecharger_grille_evaluation(Soutenance $soutenance)
    {
        //dd($soutenance);
        $etablissement = Etablissement::all()->first()->nom;
        $annee = AnneeUniversitaire::find($soutenance->annee_universitaire_id);
        $code_classe = str_replace(' ', '', ($soutenance->stage->etudiant->classe)->code);
        $path = public_path() . '/storage/' . $etablissement . '-' . $annee->annee . '/fiches_suivi_stages/fiches_soutenances/grilles_évaluations/grilles_évaluations_' . $code_classe;//dd($file_path2);
        $typeGrille1 = '\grilleEvalLic_';
        $typeGrille2 = '\grilleEvalLicInfo_';
        $typeGrille3 = '\grilleEvalMaster_';
        $file_path1 = $path . $typeGrille1 . $soutenance->stage->etudiant->nom . '-' . $soutenance->stage->etudiant->prenom . '-' . $soutenance->stage->etudiant->user->numero_CIN . '.docx';
        $file_path2 = $path . $typeGrille2 . $soutenance->stage->etudiant->nom . '-' . $soutenance->stage->etudiant->prenom . '-' . $soutenance->stage->etudiant->user->numero_CIN . '.docx';
        $file_path3 = $path . $typeGrille3 . $soutenance->stage->etudiant->nom . '-' . $soutenance->stage->etudiant->prenom . '-' . $soutenance->stage->etudiant->user->numero_CIN . '.docx';
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path2, 'grille_evaluation_' . $soutenance->stage->etudiant->nom . '-' . $soutenance->stage->etudiant->prenom . '-' . $soutenance->stage->etudiant->user->numero_CIN . '.docx');
        } elseif (file_exists($file_path1)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path1, 'grille_evaluation_' . $soutenance->stage->etudiant->nom . '-' . $soutenance->stage->etudiant->prenom . '-' . $soutenance->stage->etudiant->user->numero_CIN . '.docx');
        } elseif (file_exists($file_path3)) {
            Session::flash('message', 'download_OK');//dd($file_path2);
            return \Illuminate\Support\Facades\Response::download($file_path3, 'grille_evaluation_' . $soutenance->stage->etudiant->nom . '-' . $soutenance->stage->etudiant->prenom . '-' . $soutenance->stage->etudiant->user->numero_CIN . '.docx');
        } else {
            Session::flash('message', 'grille ');
            exit('Pas de grille!');

        }
    }

    public function evaluer_soutenance_par_president(Request $request)
    {
        //dd($request);
        $soutenance = Soutenance::find($request->stnc);
        $request->validate(['note' => 'required|numeric|min:0|max:20']);
        $soutenance->note = $request->note;
        //dd($request, $request->note);
        if ($request->note == null) {
            $soutenance->mention = "";
        } else if ($request->note >= 0 && $request->note < 10) {
            $soutenance->mention = "Refusé";
        } else if ($request->note >= 10 && $request->note < 12) {
            $soutenance->mention = "Passable";
        } else if ($request->note >= 12 && $request->note < 14) {
            $soutenance->mention = "Assez-Bien";
        } else if ($request->note >= 14 && $request->note < 16) {
            $soutenance->mention = "Bien";
        } else if ($request->note >= 16 && $request->note < 18) {
            $soutenance->mention = "Très Bien";
        } else if ($request->note >= 18 && $request->note <= 20) {
            $soutenance->mention = "Excellent";
        }
        $soutenance->update();
        // dd($soutenance);
        return back();


    }

    public function soutenance_membre_jury()
    {
        $ens = Enseignant::where('user_id', Auth::user()->id)->first(); //dd($encadrant);
        $soutenances = Soutenance::where('rapporteur_id', $ens->id)->orWhere('president_id', $ens->id)->orWhere('deuxieme_membre_id', $ens->id)->get();
        //dd($ens->id,$soutenances);
        return view('enseignant.soutenance.role_membre_jury', compact('soutenances', 'ens'));
    }


    /*public function telecharger_grille_eval($soutenance){
        $soutenance=Soutenance::find($soutenance);
        $stage=Stage::find($soutenance->stage_id);
        $etudiant=Etudiant::find($stage->etudiant_id);
        $classe=Classe::find($etudiant->classe_id);
        switch ($this->TypeFormation($classe)){
            case 'mastere':
            $this->telecharger_grille_mastere($soutenance);
            break;

            case 'licenceInfo':
            $this->telecharger_grille_lic_info($soutenance);
            break;

            case 'licenceNonInfo':
            $this->telecharger_grille_lic_non_info($soutenance);
            break;
        }


  }*/
}