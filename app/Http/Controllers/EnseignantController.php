<?php

namespace App\Http\Controllers;


use App\Exports\EnseignantToutExport;
use App\Models\Departement;
use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Exports\EnseignantExport;
use App\Imports\EnseignantsImport;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;
use function GuzzleHttp\Promise\all;


class EnseignantController extends Controller
{
    /**
     * create a new controller instance.
     * @return void
     */
    /*public function __construct(){
        $this->middlewar(['auth','verified']);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Session::get('message'));
        return view('admin.etablissement.enseignant.liste_enseignants',
            ['enseignants' => Enseignant::with('user', 'departement')->get()]);//with('departement')->get()
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.etablissement.enseignant.ajouter_enseignant');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributs = $request->validate(
            ['numero_CIN' => ['required', 'string', 'max:8', 'min:8']
            ]);

        $attributs['password'] = bcrypt($attributs['numero_CIN']);
        $attributs['is_active'] = 1;

        /* $user = User::create($attributs);
         $user->assignRole('enseignant');*/

        $attributs2 = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required', 'email', 'max:255'],
            'grade' => 'required',
            'rib' => 'required',
            'identifiant' => ['required', 'max:255', Rule::unique('enseignants', 'identifiant')],
            'departement_id' => ['required', Rule::exists('departements', 'id')]
        ]);
        $attributs['email'] = $request->email;


        $ens_exist = Enseignant::where('email', $request->email)->exists();
        $user_exist = User::where('numero_CIN', $request->numero_CIN)->exists();
        if (!($ens_exist || $user_exist)) {
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
                    $attributs2['annee_universitaire_id'] = $a->id;
                    break;
                }
            }
            $attributs2['etablissement_id'] = Etablissement::all()->firstOrFail()->id;
            $user = User::create($attributs);

            $user->assignRole('enseignant');
            dd($user->getRoleNames());
            $attributs2['user_id'] = $user->id;
            $enseignant = Enseignant::create($attributs2);
            $user->email = $enseignant->email;

            Session::flash('message', 'ok');
        } else {
            Session::flash('message', 'ko');
        }
        return redirect()->action([EnseignantController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */
    public function edit(Enseignant $enseignant)
    {
        return view('admin.etablissement.enseignant.modifier_enseignant', ['enseignant' => $enseignant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enseignant $enseignant)
    {
        $attributs = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required', 'email', 'max:255', Rule::unique('enseignants', 'email')->ignore($enseignant->id)],
            'grade' => 'required',
            'rib' => 'required',
            'identifiant' => ['required', 'max:255', Rule::unique('enseignants', 'identifiant')->ignore($enseignant->id)],
            'departement_id' => ['required', Rule::exists('departements', 'id')]
        ]);
        if ($enseignant->user->numero_CIN !== $request->numero_CIN) {
            $request->validate(['numero_CIN' => ['required', 'string', 'max:8', 'min:8', 'unique:users'],]);
            $enseignant->user->numero_CIN = $request->numero_CIN;
            $enseignant->user->update();
        }
        $enseignant->update($attributs);
        Session::flash('message', 'update');
        return redirect()->action([EnseignantController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */

    public function destroy(Enseignant $enseignant)
    {
        $user_id = $enseignant->user_id;
        $user = User::findOrFail($user_id);
        $user->delete();
        $enseignant->delete();
        return redirect()->action([EnseignantController::class, 'index']);
    }


    public function editProfil(Enseignant $enseignant)
    {
        $user_id = auth()->id();
        $enseignant = Enseignant::where('user_id', $user_id)->first();
        //dd($enseignant->user->numero_CIN);
        return view('enseignant.profil.editProfil', ['enseignant' => $enseignant]);
    }

    public function updateProfil(Request $request, Enseignant $enseignant)
    {
        $user_id = auth()->id();
        $enseignant = Enseignant::where('user_id', $user_id)->first();
        $attributs = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required', 'email', 'max:255', Rule::unique('enseignants', 'email')->ignore($enseignant->id)],
            'grade' => 'required',
            'rib' => 'required',
            'identifiant' => ['required', 'max:255', Rule::unique('enseignants', 'identifiant')->ignore($enseignant->id)],
        ]);
        $enseignant->update($attributs);
        return redirect()->action([EnseignantController::class, 'editProfil']);
    }

    public function importData()
    {
        Excel::import(new EnseignantsImport, request()->file('file')->store('temp'));
        //dd(request());
        return redirect()->back();
    }

    public function exportData(Request $request)
    {
        if (($request->departement_id) == "tous") {
            return Excel::download(new EnseignantToutExport, 'liste-enseignants.xlsx');
        } else {
            $dep = Departement::find($request->departement_id)->code;
            return Excel::download(new EnseignantExport, 'liste-enseignants' . '-' . $dep . '.xlsx');
        }

    }

    static function liste_stages_actifs()
    {
        $enseignant = Enseignant::where('user_id', Auth::user()->id)->get()[0];
        $stages_actifs = Stage::where('enseignant_id', $enseignant->id)
            ->where('confirmation_admin', 1)
            ->where('confirmation_encadrant', 1)
            ->get();

        foreach ($stages_actifs as $sa) {
            $etudiant = Etudiant::findOrFail($sa->etudiant_id);
            $classe = Classe::find($etudiant->classe_id);
            $type_stage = TypeStage::findOrFail($classe->type_stage_id);
            $sa->type_stage = $type_stage->nom;
        }
        //dd($stages_actifs);
        return view('enseignant.encadrement.liste_stages_actifs', compact('stages_actifs'));

    }

    public function details_stage(Stage $stage)
    {

        $etudiant = Etudiant::findOrFail($stage->etudiant_id);
        $classe = Classe::find($etudiant->classe_id);
        $type_stage = TypeStage::findOrFail($classe->type_stage_id);
        $stage->type_stage = $type_stage->nom;

        return view('enseignant.encadrement.details_stage', compact('stage'));
    }

    public function getDetails($id = 0)
    {
        request()->fullUrlWithoutQuery(['enseignant', 'identif']);
        $data = Enseignant::find($id);
        $ens = ['identifiant' => $data->identifiant, 'numero_CIN' => $data->user->numero_CIN,
            'rib' => $data->rib, 'numero_telephone' => $data->numero_telephone, 'etablissement' => $data->etablissement->nom];
        echo json_encode($ens);
        exit;
    }

    public function telecharger_attrayant_ens(Request $request)

    {
        if ($request->numeroCIN) {
            $enseignant = Enseignant::findOrFail($request->enseignant);
            $an = StageController::current_annee_univ();
            $stages_actifs = Stage::where('enseignant_id', $enseignant->id)
                ->where('confirmation_admin', 1)
                ->where('confirmation_encadrant', 1)
               ->where('annee_universitaire_id', $an->id)
                ->get(); //dd($stages_actifs);
            $etablissement = Etablissement::all()->first()->nom;
            $stgLic = new Collection();
            $stgMas = new Collection();
            foreach ($stages_actifs as $stg) {
                $isMaster = strtoupper($stg->etudiant->classe->cycle) === strtoupper('master');
                $isLicence = strtoupper($stg->etudiant->classe->cycle) === strtoupper('licence');
                if ($isLicence && $stg->etudiant->classe->niveau == 3) {
                    $stgLic->push($stg);
                } elseif ($isMaster && $stg->etudiant->classe->niveau == 2) {
                    $stgMas->push($stg);
                }
            }//dd($stgLic,$stgMas);
            $annee = StageController::current_annee_univ();
            $file_path = public_path() . '/storage/' . $annee->attrayant;//dd($file_path);
            /*$file_path = str_replace(' ', '', $file_path);//dd($file_path);
            $file_path = str_replace('/', '\\', $file_path);//dd($file_path);**/
            $templateProcessor = new TemplateProcessor($file_path);
            $templateProcessor->setValue('anne_univ', $annee->annee);
            $templateProcessor->setValue('nom_pren', ucwords($enseignant->nom) . ' ' . ucwords($enseignant->prenom));//dd($templateProcessor->getVariables());
            $templateProcessor->setValue('cin', $enseignant->user->numero_CIN);
            $templateProcessor->setValue('telf', $enseignant->numero_telephone);
            $templateProcessor->setValue('id', $enseignant->identifiant);
            $templateProcessor->setValue('email', $enseignant->email);
            $templateProcessor->setValue('grade', ucwords($enseignant->grade));
            $templateProcessor->setValue('etabliss', $enseignant->etablissement->nom);
            $templateProcessor->setValue('rib', $enseignant->rib);
            /*foreach ($stages_actifs as $stage) {
                $templateProcessor->setValues(array('nom' => ucwords($stage->etudiant->nom), 'prenom'=> ucwords($stage->etudiant->nom),
                    'societe' => $stage->etudiant->nom ,'sujet' => $stage->etudiant->nom ));
            }*/
            //dd($templateProcessor->getVariables());
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
            $table->addCell(100, array('bgColor' => '198754'))->addText("Nom", array('bold' => true));
            $table->addCell(100, array('bgColor' => '198754'))->addText("Prénom", array('bold' => true));
            $table->addCell(100, array('bgColor' => '198754'))->addText("Société", array('bold' => true));
            $table->addCell(100, array('bgColor' => '198754'))->addText("Sujet", array('bold' => true));
            foreach ($stgLic as $stg) {
                $table->addRow();
                $table->addCell()->addText("{$stg->etudiant->nom}");
                $table->addCell()->addText("{$stg->etudiant->prenom}");
                if (isset($stg->entreprise_id)) {
                    $table->addCell()->addText("{$stg->entreprise->nom}");
                } else $table->addCell()->addText("Pas d'entreprise");
                $table->addCell()->addText("{$stg->titre_sujet}");
            }
            // Create writer to convert document to xml
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table, 'Word2007');
            // Get all document xml code
            $fullxml = $objWriter->getWriterPart('Document')->write();
            // Get only table xml code
            $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);
            $templateProcessor->setValue('table', $tablexml);

            //table master
            $document_with_table2 = new PhpWord();
            $tableStyle2 = array(
                'borderColor' => 'black',
                'borderSize' => 6,
                'cellMargin' => 400
            );
            $section2 = $document_with_table2->addSection();
            $table2 = $section2->addTable($tableStyle2);
            $table2->addRow();
            $table2->addCell(100, array('bgColor' => '198754'))->addText("Nom", array('bold' => true));
            $table2->addCell(100, array('bgColor' => '198754'))->addText("Prénom", array('bold' => true));
            $table2->addCell(100, array('bgColor' => '198754'))->addText("Société", array('bold' => true));
            $table2->addCell(100, array('bgColor' => '198754'))->addText("Sujet", array('bold' => true));
            foreach ($stgMas as $stg) {
                $table2->addRow();
                $table2->addCell()->addText("{$stg->etudiant->nom}");
                $table2->addCell()->addText("{$stg->etudiant->prenom}");
                if (isset($stg->entreprise_id)) {
                    $table2->addCell()->addText("{$stg->entreprise->nom}");
                } else $table2->addCell()->addText("Pas d'entreprise");
                $table2->addCell()->addText("{$stg->titre_sujet}");
            }
            // Create writer to convert document to xml
            $objWriter2 = \PhpOffice\PhpWord\IOFactory::createWriter($document_with_table2, 'Word2007');
            // Get all document xml code
            $fullxml2 = $objWriter2->getWriterPart('Document')->write();
            // Get only table xml code
            $tablexml2 = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml2);
            $templateProcessor->setValue('table2', $tablexml2);
            $path = public_path() . '/storage/' . $etablissement . '-' . $annee->annee . '/fiches_suivi_stages/fiches_soutenances/attrayants';
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $templateProcessor->saveAs($path . '\attrayant_' . $enseignant->nom . '-' . $enseignant->prenom . '.docx');
            $file_path2 = $path . '\attrayant_' . $enseignant->nom . '-' . $enseignant->prenom . '.docx';
            if (file_exists($file_path2)) {
                Session::flash('message', 'download_OK');
                return Response::download($file_path2, 'attrayant_' . $enseignant->nom . '-' . $enseignant->prenom . '.docx');
            } else {
                Session::flash('message', 'attrayant_introuvable');
                exit('Pas d\'attrayant!');

            }
            return back();
        } else {
            Session::flash('message', 'ens_vide');
            return back();
        }
    }
}
