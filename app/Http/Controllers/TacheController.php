<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Tache;
use Barryvdh\DomPDF ;

use App\Models\CahierStage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function index(Tache $tache)
    {
        return view('etudiant.stage.redaction_tache',compact('tache'));
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
     *  @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Tache $tache)
    {
$tache->contenu=$request->contenu;
$tache->titre=$request->titre;
$tache->update();
$cs=CahierStage::findOrFail($tache->cahier_stage_id);
$stage = Stage::findOrFail($cs->stage_id);

return redirect()->route(
    'nouvelle_cahier_stage',
    $parameters = [$stage],
    $status = 302,
    $headers = []
);
//return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function show(Tache $tache)
    {
        //
    }
    public function telecharger(int $semaine ,string $tcs)
    {
        $taches=new Collection();
        $ids=explode('-',$tcs);
        foreach($ids as $id){
            if($id!='')
            {
                $tache=Tache::findOrFail((int)$id);
                $taches->push($tache);
                //dd($tache);

            }

        }
        $data=[ 'titre'=>'Semaine '.$semaine,
        'taches'=>$taches ];
        $view = view('etudiant.stage.telechargement_cahier_stage', compact('data'))->render();

        $pdf = PDF::loadHtml($view);
        $s='semaine'.(string)$semaine.'.pdf';
        return $pdf->download($s);

    }
public function effacer(Tache $tache){
	$tache->contenu=null;
	$tache->update();
	return back();
	
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function edit(Tache $tache)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tache $tache)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */

   public function destroy(Tache $tache)
    {
        //





}









}