<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Stage;
use App\Models\Etudiant;
use App\Models\CahierStage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CahierStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cahiers_stage=new Collection();
        $etudiant=Etudiant::where('user_id',Auth::user()->id)->get()[0];
        $cahiers=CahierStage::all();

        foreach($cahiers as $cahier){
            $stage=Stage::findOrFail($cahier->stage_id);

            if($stage->etudiant_id== $etudiant->id){
                $cahier->stage=$stage;
                $cahiers_stage->push($cahier);
            }
        }
        //dd($cahiers_stage);
        return view('etudiant.stage.gestion_cahier_stage',compact(['cahiers_stage']));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CahierStage  $cahierStage
     * @return \Illuminate\Http\Response
     */
    public function show(CahierStage $cahierStage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CahierStage  $cahierStage
     * @return \Illuminate\Http\Response
     */
    public function edit(CahierStage $cahierStage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CahierStage  $cahierStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CahierStage $cahierStage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CahierStage  $cahierStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CahierStage $cahierStage)
    {
        //
    }
}