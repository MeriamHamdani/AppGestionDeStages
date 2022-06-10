<?php

namespace App\Http\Controllers;

use App\Models\fraisEncadrement;
use Illuminate\Http\Request;

class FraisEncadrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fraisEncadrements = FraisEncadrement::all();
        return  view('admin.configuration.generale.frais_encadrement',compact('fraisEncadrements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.configuration.generale.ajouter_frais_encadrement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request);
       $attributes = $request->validate([
           'grade'=>'required',
           'cycle'=>'required',
           'frais'=>'required|numeric'
       ]);
       $fraisEncadrement = FraisEncadrement::create($attributes);
        return redirect()->action([FraisEncadrementController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FraisEncadrement  $fraisEncadrement
     * @return \Illuminate\Http\Response
     */
    public function show(FraisEncadrement $fraisEncadrement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FraisEncadrement  $fraisEncadrement
     * @return \Illuminate\Http\Response
     */
    public function edit(FraisEncadrement $fraisEncadrement)
    {
        return view('admin.configuration.generale.modifier_frais_encadrement',compact('fraisEncadrement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FraisEncadrement  $fraisEncadrement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FraisEncadrement $fraisEncadrement)
    {
        $attributes = $request->validate([
            'grade'=>'required',
            'cycle'=>'required',
            'frais'=>'required|numeric'
        ]);
        $fraisEncadrement->update($attributes);
       // dd($fraisEncadrement);
        return redirect()->action([FraisEncadrementController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FraisEncadrement  $fraisEncadrement
     * @return \Illuminate\Http\Response
     */
    public function destroy(FraisEncadrement $fraisEncadrement)
    {
        $fraisEncadrement->delete();
        return redirect()->action([FraisEncadrementController::class,'index']);
    }
}
