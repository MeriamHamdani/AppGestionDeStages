<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;

class EtablissementController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function show(Etablissement $etablissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function edit(Etablissement $etablissement)
    {
        return  view('admin.configuration.generale.coordonnees');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etablissement $etablissement)
    {

        $attributs = $request->validate([
                'nom' => 'required',
                'email' => 'required|email',
                'universite' => 'required',
                'telephone' => 'required',
                'fax' => 'required',
                'adresse' => 'required'
            ]
        );
        //dd($request);
        $etablissement->nom = $request->nom;
        $etablissement->email = $request->email;
        $etablissement->universite = $request->universite;
        $etablissement->fax = $request->fax;
        $etablissement->telephone = $request->telephone;
        $etablissement->adresse = $request->adresse;
        //dd($request->email);
       $etablissement->update($attributs);
       dd($etablissement);
        return back()->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etablissement $etablissement)
    {
        //
    }
}
