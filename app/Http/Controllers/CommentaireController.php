<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\DepotMemoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepotMemoire $demande_depot)
    {
        $id = $demande_depot->id;
        $commentaires = Commentaire::with('depotMemoire')
            ->where('depot_memoire_id',$id)->get();
        return view('enseignant.depot.details_depot',compact('demande_depot','commentaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,DepotMemoire $demande_depot)
    {
        if ( $demande_depot->validation_encadrant != 1) {
            $attributs = $request->validate(['contenu' => 'required']);
            $attributs['depot_memoire_id']= $demande_depot->id;
            $attributs['enseignant_id']=$demande_depot->stage->enseignant->id;
            Commentaire::create($attributs);
            $demande_depot->validation_encadrant = 0;
            $demande_depot->update();
        } else
            Session::flash('message', 'deja validé');
        return redirect()->action([DepotMemoireController::class,'liste_demandes_depot_enseignant']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
