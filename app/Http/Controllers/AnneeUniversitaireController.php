<?php

namespace App\Http\Controllers;

use App\Models\TypeStage;
use Illuminate\Support\Str;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\PhpWord;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Validation\ValidationException;

class AnneeUniversitaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annees = AnneeUniversitaire::all();
        return view('admin.configuration.liste_annees_univ', compact('annees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.configuration.config_annee_universitaire');
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
            [
                'annee' => 'required',
                'lettre_affectation' => ['required', 'mimes:docx'],
                'fiche_encadrement' => ['required', 'mimes:docx'],
                'attrayant' => ['required', 'mimes:docx'],
                'grille_evaluation_licence' => ['required', 'mimes:docx'],
                'grille_evaluation_info' => ['required', 'mimes:docx'],
                'grille_evaluation_master' => ['required', 'mimes:docx'],
                'pv_individuel' => ['required', 'mimes:docx'],
                'pv_global' => ['required', 'mimes:docx'],
            ]
        );
        if ($this->current_annee_univ() == $request->annee) {
            $an_exist = AnneeUniversitaire::where('annee', $request->annee)->first();
            if (!$an_exist) {
                $lettre_affectation = Storage::disk('public')
                    ->putFileAs('models_lettre_affectation', $request->file('lettre_affectation'), 'model_lettre_affectation_' . $request->annee . '.docx');
                $fiche_encadrement = Storage::disk('public')
                    ->putFileAs('models_fiche_encadrement', $request->file('fiche_encadrement'), 'model_fiche_encadrement_' . $request->annee . '.docx');
                $attrayant = Storage::disk('public')
                    ->putFileAs('model_attrayant', $request->file('attrayant'), 'model_attrayant_' . $request->annee . '.docx');
                $grille_evaluation_licence = Storage::disk('public')
                    ->putFileAs('models_grilles_evaluations', $request->file('grille_evaluation_licence'), 'model_grille_evaluation_licence_' . $request->annee . '.docx');
                $grille_evaluation_info = Storage::disk('public')
                    ->putFileAs('models_grilles_evaluations', $request->file('grille_evaluation_info'), 'model_grille_evaluation_info_' . $request->annee . '.docx');
                $grille_evaluation_master = Storage::disk('public')
                    ->putFileAs('models_grilles_evaluations', $request->file('grille_evaluation_master'), 'model_grille_evaluation_master_' . $request->annee . '.docx');
                $pv_individuel = Storage::disk('public')
                    ->putFileAs('models_pvs', $request->file('pv_individuel'), 'model_pv_individuel_' . $request->annee . '.docx');
                $pv_global = Storage::disk('public')
                    ->putFileAs('models_pvs', $request->file('pv_global'), 'model_pv_global_' . $request->annee . '.docx');
                $annee = new AnneeUniversitaire();
                $annee->annee = $request->annee;
                $annee->lettre_affectation = $lettre_affectation;
                $annee->fiche_encadrement = $fiche_encadrement;
                $annee->attrayant = $attrayant;
                $annee->grille_evaluation_licence = $grille_evaluation_licence;
                $annee->grille_evaluation_info = $grille_evaluation_info;
                $annee->grille_evaluation_master = $grille_evaluation_master;
                $annee->pv_individuel = $pv_individuel;
                $annee->pv_global = $pv_global;
               // dd($annee);
                $typesStage = TypeStage::whereNotNull('date_debut_depot')->whereNotNull('date_limite_depot')->get();
                foreach ($typesStage as $ts) {
                    $ts->date_debut_depot = null;
                    $ts->date_limite_depot = null;
                    $ts->update();
                }
                $annee->save();
                return redirect()->action([AnneeUniversitaireController::class, 'index']);
            } else
                Session::flash("message", 'error exist');
        } else {
            Session::flash("message", 'error');
            return view('admin.configuration.config_annee_universitaire');
        }
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
        return $annee;


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\AnneeUniversitaire $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function show(AnneeUniversitaire $anneeUniversitaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\AnneeUniversitaire $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function edit(AnneeUniversitaire $anneeUniversitaire)
    {
        return view('admin.configuration.modifier_config_annee_universitaire', compact('anneeUniversitaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AnneeUniversitaire $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnneeUniversitaire $anneeUniversitaire)
    {
        $attributs = $request->validate(
            [
                'lettre_affectation' => ['mimes:docx'],
                'fiche_encadrement' => ['mimes:docx'],
                'attrayant' => ['mimes:docx'],
                'grille_evaluation_licence' => ['mimes:docx'],
                'grille_evaluation_info' => ['mimes:docx'],
                'grille_evaluation_master' => ['mimes:docx'],
                'pv_individuel' => ['mimes:docx'],
                'pv_global' => ['mimes:docx'],
            ]
        );
        $annee = $this->current_annee_univ();
        if (isset($request->lettre_affectation)) {
            $anneeUniversitaire->lettre_affectation = Storage::disk('public')
                ->putFileAs('models_lettre_affectation', $request->file('lettre_affectation'), 'model_lettre_affectation_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        if (isset($request->fiche_encadrement)) {
            $anneeUniversitaire->fiche_encadrement = Storage::disk('public')
                ->putFileAs('models_fiche_encadrement', $request->file('fiche_encadrement'), 'model_fiche_encadrement_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        if (isset($request->attrayant)) {
            $anneeUniversitaire->attrayant = Storage::disk('public')
                ->putFileAs('model_attrayant', $request->file('attrayant'), 'model_attrayant_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        if (isset($request->grille_evaluation_licence)) {
            $anneeUniversitaire->grille_evaluation_licence = Storage::disk('public')
                ->putFileAs('models_grilles_evaluations', $request->file('grille_evaluation_licence'), 'model_grille_evaluation_licence_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        if (isset($request->grille_evaluation_info)) {
            $anneeUniversitaire->grille_evaluation_info = Storage::disk('public')
                ->putFileAs('models_grilles_evaluations', $request->file('grille_evaluation_info'), 'model_grille_evaluation_info_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        if (isset($request->grille_evaluation_master)) {
            $anneeUniversitaire->grille_evaluation_master = Storage::disk('public')
                ->putFileAs('models_grilles_evaluations', $request->file('grille_evaluation_master'), 'model_grille_evaluation_master_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        if (isset($request->pv_individuel)) {
            $anneeUniversitaire->pv_individuel = Storage::disk('public')
                ->putFileAs('models_pvs', $request->file('pv_individuel'), 'model_pv_individuel_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        if (isset($request->pv_global)) {
            $anneeUniversitaire->pv_global = Storage::disk('public')
                ->putFileAs('models_pvs', $request->file('pv_global'), 'model_pv_global_' . $annee . '.docx');
            $anneeUniversitaire->update();
        }
        Session::flash('message', 'updateAU');
        return redirect()->action([AnneeUniversitaireController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AnneeUniversitaire $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnneeUniversitaire $anneeUniversitaire)
    {
        //
    }

    public function telecharger_lettre_affectation(string $lettre_affectation)
    {
        $file_path = public_path() . '/storage/models_lettre_affectation' . '/' . $lettre_affectation;
        if (file_exists($file_path)) {
            return Response::download($file_path, $lettre_affectation);
        } else {
            exit('lettre inexistante !');
        }
    }

    public function telecharger_fiche_encadrement(string $fiche_encadrement)
    {
        $file_path = public_path() . '/storage/models_fiche_encadrement' . '/' . $fiche_encadrement;
        if (file_exists($file_path)) {
            return Response::download($file_path, $fiche_encadrement);
        } else {
            exit('fiche inexistante !');
        }
    }

    public function telecharger_grille_licence(string $grille_evaluation_licence)
    {
        $file_path = public_path() . '/storage/models_grilles_evaluations' . '/' . $grille_evaluation_licence;
        //dd($file_path);
        if (file_exists($file_path)) {
            return Response::download($file_path, $grille_evaluation_licence);
        } else {
            exit('grille inexistante !');
        }
    }

    public function telecharger_grille_info(string $grille_evaluation_info)
    {
        $file_path = public_path() . '/storage/models_grilles_evaluations' . '/' . $grille_evaluation_info;
        //dd($file_path);
        if (file_exists($file_path)) {
            return Response::download($file_path, $grille_evaluation_info);
        } else {
            exit('grille 2 inexistante !');
        }
    }

    public function telecharger_grille_master(string $grille_evaluation_master)
    {
        $file_path = public_path() . '/storage/models_grilles_evaluations' . '/' . $grille_evaluation_master;
        //dd($file_path);
        if (file_exists($file_path)) {
            return Response::download($file_path, $grille_evaluation_master);
        } else {
            exit('grille 3 inexistante !');
        }
    }

    public function telecharger_pv_individuel(string $pv_individuel)
    {
        $file_path = public_path() . '/storage/models_pvs' . '/' . $pv_individuel;
        //dd($file_path);
        if (file_exists($file_path)) {
            return Response::download($file_path, $pv_individuel);
        } else {
            exit('pv indiv inexistante !');
        }
    }

    public function telecharger_pv_global(string $pv_global)
    {
        $file_path = public_path() . '/storage/models_pvs' . '/' . $pv_global;
        //dd($file_path);
        if (file_exists($file_path)) {
            return Response::download($file_path, $pv_global);
        } else {
            exit('pv global inexistante !');
        }
    }
    public function filtre_par_an (Request $request) {
        if(isset($request->annee_universitaire)) {
        $annee = AnneeUniversitaire::find($request->annee_universitaire);
        session(['annee' =>$annee ]); //dd(Session::get('annee'));
        }
        return back();
    }
}
