<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Validation\ValidationException;
use Response;

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
        return view ('admin.configuration.config_annee_universitaire');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribut = $request->validate(
            ['annee' => 'required',
            /*'lettre_affectation'=>'required',
            'lettre_affectation.*' => ['required', 'mimes:docx']*/]
        );
        $an_exist = AnneeUniversitaire::where('annee', $request->annee)->first();
        if($an_exist) {
            return back()->with('error',  'cette année est déjà créee');
        }
        /*$lettre_affectation = Storage::disk('public')
            ->putFileAs('Lettres_affectation', $request->file('lettre_affectation'), 'lettre_aff_'.$request->annee.'.docx');*/
            $annee=new AnneeUniversitaire();
            $annee->annee=$request->annee;
            //$annee->lettre_affectation=$lettre_affectation;
            $annee->save();
        return view('admin.etablissement.departement.ajouter_departement');
        
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnneeUniversitaire  $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function show(AnneeUniversitaire $anneeUniversitaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnneeUniversitaire  $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function edit(AnneeUniversitaire $anneeUniversitaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnneeUniversitaire  $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnneeUniversitaire $anneeUniversitaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnneeUniversitaire  $anneeUniversitaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnneeUniversitaire $anneeUniversitaire)
    {
        //
    }
}