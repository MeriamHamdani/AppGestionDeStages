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

        if($mois_date_debut==$mois_date_fin)
        {
            $nb_days=cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year);
        }
        elseif($jrs_date_debut==1 && ($jrs_date_fin ==30 || $jrs_date_fin ==31))
        {

            for( $i=$mois_date_debut ; $i<=$mois_date_fin;$i++)
            {
                $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

            }
        }
        else
        {
            $nb_days=(cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year)-$jrs_date_debut)+$jrs_date_fin;
            $x=$mois_date_debut+1; $y=$mois_date_fin-1;
            if($x<=$y){
                for( $i=$x ; $i<=$y;$i++){
                    $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

                    }
            }

        }
        $nbr_semaines=(int)($nb_days/7);
        $r_nbr_semaines=(int)($nb_days%7);
        if($r_nbr_semaines>0){
            $nbr_semaines++;
        }
        //$nbr_semaines=(int)round($nb_days/7);
        //dd($nbr_semaines);
        $taches=new Collection();
        $period = new DatePeriod(
            new DateTime($date_debut),
            new DateInterval('P1D'),
            new DateTime($date_fin)
       );
$rang=1;
$semaine=1;
$l=1;
       //dd($tcs=Tache::where('cahier_stage_id',$cahier->id)->exists());
       if (! Tache::where('cahier_stage_id', $cahier->id)->exists()) {
           foreach ($period as $key => $value) {

               $tache=new Tache();
               $tache->cahier_stage_id=$cahier->id;
               $tache->date=$value->format('Y-m-d');
                $tache->rang=$rang;
                $tache->semaine=$semaine;
               $tache->save();
               if($l>=7){$l=1;$semaine++;}else{$l++;}
               $rang++;

               //if($rang>7){$rang=1;}
               $tache->semaine=$key+1;
               $taches->push($tache);
           }
       }else{
        $taches=Tache::where('cahier_stage_id',$cahier->id)->get();
       }
       //dd($period);
      //dd($taches);
       return view('etudiant.stage.cahier_stage',compact(['nbr_semaines','taches','r_nbr_semaines']));

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
public function all_cahier_stage(){

	$cahiers=CahierStage::All();
	return view('admin.stage.gerer_cahiers_stages',compact('cahiers'));
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CahierStage  $cahier
     * @return \Illuminate\Http\Response
     */
    public function show(CahierStage $cahier)
    {
        //dd($cahier);
		$stage=Stage::findOrFail($cahier->stage_id);
		$date_debut=$stage->date_debut;
$etudiant=Etudiant::findOrFail($stage->etudiant_id);
        $date_fin=$stage->date_fin;
        $jrs_date_debut=(int)substr($date_debut,8,10);
        $jrs_date_fin=(int)substr($date_fin,8,10);
        $mois_date_debut=(int)substr($date_debut,5,6);
        $mois_date_fin=(int)substr($date_fin,5,6);
        $year=(int)substr($date_debut,0,3);
        $nb_days=0;

        if($mois_date_debut==$mois_date_fin)
        {
            $nb_days=cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year);
        }
        elseif($jrs_date_debut==1 && ($jrs_date_fin ==30 || $jrs_date_fin ==31))
        {

            for( $i=$mois_date_debut ; $i<=$mois_date_fin;$i++)
            {
                $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

            }
        }
        else
        {
            $nb_days=(cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year)-$jrs_date_debut)+$jrs_date_fin;
            $x=$mois_date_debut+1; $y=$mois_date_fin-1;
            if($x<=$y){
                for( $i=$x ; $i<=$y;$i++){
                    $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

                    }
            }

        }
       
        //dd($nb_days);
        $nbr_semaines=(int)round($nb_days/7);
        

		$taches=Tache::where('cahier_stage_id',$cahier->id)->get();
	return view('admin.stage.cahier_de_stage',compact('taches','nbr_semaines','etudiant'));
    }
public function show_for_enc(CahierStage $cahier)
    {
		$stage=Stage::findOrFail($cahier->stage_id);
		$date_debut=$stage->date_debut;
		$etudiant=Etudiant::findOrFail($stage->etudiant_id);
        $date_fin=$stage->date_fin;
        $jrs_date_debut=(int)substr($date_debut,8,10);
        $jrs_date_fin=(int)substr($date_fin,8,10);
        $mois_date_debut=(int)substr($date_debut,5,6);
        $mois_date_fin=(int)substr($date_fin,5,6);
        $year=(int)substr($date_debut,0,3);
        $nb_days=0;

        if($mois_date_debut==$mois_date_fin)
        {
            $nb_days=cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year);
        }
        elseif($jrs_date_debut==1 && ($jrs_date_fin ==30 || $jrs_date_fin ==31))
        {

            for( $i=$mois_date_debut ; $i<=$mois_date_fin;$i++)
            {
                $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

            }
        }
        else
        {
            $nb_days=(cal_days_in_month(CAL_GREGORIAN, $mois_date_debut, $year)-$jrs_date_debut)+$jrs_date_fin;
            $x=$mois_date_debut+1; $y=$mois_date_fin-1;
            if($x<=$y){
                for( $i=$x ; $i<=$y;$i++){
                    $nb_days=$nb_days+cal_days_in_month(CAL_GREGORIAN, $i, $year);

                    }
            }

        }
        //dd($nb_days);
        $nbr_semaines=(int)round($nb_days/7);


		$taches=Tache::where('cahier_stage_id',$cahier->id)->get();
	return view('enseignant.encadrement.cahier_stage_etud',compact('taches','nbr_semaines','etudiant'));
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