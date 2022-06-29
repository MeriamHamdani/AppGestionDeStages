<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Enseignant;
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
use PhpOffice\PhpWord\TemplateProcessor;


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
        $attributs['is_active'] = 0;

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
            } else
                $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
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
     * Display the specified resource.
     *
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show(Enseignant $enseignant)
    {
        //
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

    public function exportData()
    {
        return Excel::download(new EnseignantExport, 'liste-enseignants.xlsx');
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

    public function telecharger_attrayant(Request $request)

    {
        $enseignant = Enseignant::findOrFail($request->enseignant);
        $stages_actifs = Stage::where('enseignant_id', $enseignant->id)
            ->where('confirmation_admin', 1)
            ->where('confirmation_encadrant', 1)
            ->get();// dd($stages_actifs);
        $annee = StageController::current_annee_univ();
        $file_path = public_path() . '\storage\ ' . $annee->attrayant;//dd($file_path);
        $file_path = str_replace(' ', '', $file_path);//dd($file_path);
        $file_path = str_replace('/', '\\', $file_path);//dd($file_path);
        $templateProcessor = new TemplateProcessor($file_path);
        //dd($templateProcessor->getVariables());
        $templateProcessor->setValue('anne_univ', $annee->annee);
        $templateProcessor->setValue('nom_pren', ucwords($enseignant->nom) . ' ' . ucwords($enseignant->prenom));//dd($templateProcessor->getVariables());
        $templateProcessor->setValue('cin', $enseignant->user->numero_CIN);
        $templateProcessor->setValue('telf', $enseignant->numero_telephone);
        $templateProcessor->setValue('id', $enseignant->identifiant);
        $templateProcessor->setValue('email', $enseignant->email);
        $templateProcessor->setValue('grade', ucwords($enseignant->grade));
        $templateProcessor->setValue('etabliss', $enseignant->etablissement->nom);
        $templateProcessor->setValue('rib', $enseignant->rib);
        foreach ($stages_actifs as $stage) {
            $templateProcessor->setValue('stages_oblig', ucwords($stage->typeStage->nom));
        }

        //$templateProcessor = Storage::disk('public')
                  // ->putFileAs('attrayants_' . $annee->annee ,$file_path, 'attrayant_' . $enseignant->nom .'_'.  $enseignant->prenom . '.docx');
        $templateProcessor->saveAs(public_path() . '\storage\attrayants_' . $annee->annee . '\attrayant_' . $enseignant->nom .'_'.  $enseignant->prenom . '.docx');
        $file_path2 = public_path('\storage\attrayants_' . $annee->annee . '\attrayant_' .$enseignant->nom .'_'. $enseignant->prenom . '.docx');
        //dd($file_path2);
        if (file_exists($file_path2)) {
            Session::flash('message', 'download_OK');
            return Response::download($file_path2, 'attrayant_'.$enseignant->nom .'_'. $enseignant->prenom .'.docx');
        } else {
            Session::flash('message', 'attrayant_introuvable');
            exit('Pas d\'attrayant!');

        }
        return back();
    }
}
