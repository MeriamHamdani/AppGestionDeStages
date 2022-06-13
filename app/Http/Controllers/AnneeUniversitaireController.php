<?php

namespace App\Http\Controllers;

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
        //
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
        $attribut = $request->validate(
            [
                'annee' => 'required',
                'lettre_affectation' => 'required',
                'lettre_affectation.*' => ['required', 'mimes:docx'],
                'fiche_encadrement' => 'required',
                'fiche_encadrement.*' => ['required', 'mimes:docx'],
                'attrayant' => 'required',
                'attrayant.*' => ['required', 'mimes:docx'],
                /*'fiche_encadrement'=>'required',
                'fiche_encadrement.*'=>['required', 'mimes:docx']*/
            ]
        );
        //dd($attribut);

        if ($this->current_annee_univ() == $request->annee) {
            $an_exist = AnneeUniversitaire::where('annee', $request->annee)->first();
            if ($an_exist) {
                return back()->with('error', 'cette année est déjà créee');
            }
            $lettre_affectation = Storage::disk('public')
                ->putFileAs('models_lettre_affectation', $request->file('lettre_affectation'), 'model_lettre_affectation_' . $request->annee . '.docx');
            $fiche_encadrement = Storage::disk('public')
                ->putFileAs('models_fiche_encadrement', $request->file('fiche_encadrement'), 'model_fiche_encadrement_' . $request->annee . '.docx');
            $attrayant = Storage::disk('public')
                ->putFileAs('model_attrayant', $request->file('attrayant'), 'model_attrayant_' . $request->annee . '.docx');
            $annee = new AnneeUniversitaire();
            $annee->annee = $request->annee;
            $annee->lettre_affectation = $lettre_affectation;
            $annee->fiche_encadrement = $fiche_encadrement;
            $annee->attrayant = $attrayant;
            $annee->save(); //dd($annee);
            Session::flash("message", 'l\'annee que vous vouloir ajouter n\'est pas l\'année courante ');
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
        //
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
        //
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
}
