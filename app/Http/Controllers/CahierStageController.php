<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Stage;
use App\Models\Tache;
use App\Models\Etudiant;
use App\Models\CahierStage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    static function diff_date_en_mois(string $a, string  $b)
    {
        $from = Carbon::createFromFormat('Y-m-d', $a);
        $to = Carbon::createFromFormat('Y-m-d', $b);
        $nbreJours = $to->diffInDays($from);
        return intdiv($nbreJours,27);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Stage $stage)
    {
        $cahier=CahierStage::findOrFail($stage->cahier_stage_id);
        $date_debut=$stage->date_debut;
        $date_fin=$stage->date_fin;
        $jrs_date_debut=(int)substr($date_debut,8,10);
        $jrs_date_fin=(int)substr($date_fin,8,10);
        $mois_date_debut=(int)substr($date_debut,5,6);
        $mois_date_fin=(int)substr($date_fin,5,6);
        $year=(int)substr($date_debut,0,3);
        $nb_days=0;
        if($mois_date_debut==$mois_date_fin){
            $nb_days=cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year);
        }elseif($jrs_date_debut==1 && ($jrs_date_fin ==30 || $jrs_date_fin ==31)){
            for( $i=$mois_date_debut ; $i<=$mois_date_debut;$i++){
                $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

                }
        }
        else
        {
            $nb_days=(cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year)-$jrs_date_debut)+$jrs_date_debut;
            $x=$mois_date_debut+1; $y=$mois_date_fin-1;
            if($x<=$y){
                for( $i=$x ; $i<=$y;$i++){
                    $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

                    }
            }

        }

        $nbr_semaines=(int)round($nb_days/7);
        $taches=new Collection();
        $period = new DatePeriod(
            new DateTime($date_debut),
            new DateInterval('P1D'),
            new DateTime($date_fin)
       );
       
       
       foreach ($period as $key => $value)
        {
           $tache=new Tache();
           $tache->cahier_stage_id=$cahier->id;
           $tache->date=$value->format('Y-m-d');
           
           $tache->save();
           $tache->semaine=$key+1;
           $taches->push($tache);
         
        }
    
        $j=-7;
        for($i=1;$i<=$nbr_semaines;$i++){
            
           
            
        }
       //dd($taches);
       return view('etudiant.stage.cahier_stage',compact(['nbr_semaines',]));

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