<?php

namespace App\Http\Controllers;

use App\Models\AnneeUniversitaire;
use App\Models\Classe;
use App\Models\Departement;
use App\Models\Enseignant;
use App\Models\Entreprise;
use App\Models\Etudiant;
use App\Models\Soutenance;
use App\Models\Specialite;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\List_;

class DashboardController extends Controller
{
    public function index()
    {
        $annee = StageController::current_annee_univ();
        if (isset ($annee)) {
            $nbre_etudiants = (Etudiant::where('annee_universitaire_id', $annee->id))->count();
            $nbre_enseignants = (Enseignant::all())->count();
            $nbre_departements = (Departement::all())->count();
            $nbre_specialites = (Specialite::all())->count();
            $nbre_classes = (Classe::all())->count();
            $nbre_entreprises = (Entreprise::all())->count();
            $nbre_stages = (Stage::where('annee_universitaire_id', $annee->id))->count();
            $nbre_soutenances = (Soutenance::where('annee_universitaire_id', $annee->id))->count();
            $stages = (StageController::stages1ereLicMaster())->count(); //dd($stages);
            $data = DashboardController::encadrementChart(); //dd($ids);
            $dataset = DashboardController::typeSujetChart(); //dd($dataset);
            $statVol = DashboardController::stagesVolontairesChart(); //dd($statVol);
            $etdsLic = DashboardController::etdsVsNiveauChart()[0];
            $etdsMas = DashboardController::etdsVsNiveauChart()[1];
            $tousEtds = DashboardController::etdsVsNiveauChart()[2];
            return view('admin.dashboard.dashboard', compact('annee', 'nbre_etudiants', 'nbre_enseignants',
                'nbre_departements', 'nbre_specialites', 'nbre_classes', 'nbre_entreprises',
                'nbre_stages', 'data', 'dataset', 'statVol', 'etdsLic', 'etdsMas', 'tousEtds','nbre_soutenances'));
        } else return redirect()->action([AdminController::class, 'index']);
    }

    public function encadrementChart()
    {
        $IdsEncadrants = Stage::select('enseignant_id')->whereNotNull('enseignant_id')->distinct()->get();//dd($IdsEncadrants);
        $ids1 = [];
        foreach ($IdsEncadrants as $id) {
            $ids1[] = $id->enseignant_id;
        }
        $idNonEncadrants = Enseignant::whereNotIn('id', $ids1)->distinct()->count();//dd($idNonEncadrants);
        $ids2 = [];
        /*foreach ($idNonEncadrants as $id) {
            $ids2[] = $id->id;
        }
        $c2 = null;
        foreach($ids2 as $i) {
            $c2++;
        }*/
        $c1 = null;
        foreach ($ids1 as $i) {
            $c1++;
        }
        $data = [$c1, $idNonEncadrants];
        return $data;
    }

    public function typeSujetChart()
    {
        $stagesWithTypesSujets = Stage::select(DB::raw('type_sujet,count(*) as Nombre_des_stages'))->whereNotNull('type_sujet')->groupBy('type_sujet')->get()->toArray();
        $dataset = "";//dd($stagesWithTypesSujets);
        foreach ($stagesWithTypesSujets as $st) {
            $dataset .= "['" . array_values($st)[0] . "',   " .
                array_values($st)[1] . "],";
        }
        $array['dataset'] = rtrim($dataset, ",");//dd($array);
        return $dataset;
    }

    public function stagesVolontairesChart()
    {
        $an = StageController::current_annee_univ();
        $etudiants = Etudiant::with('user', 'classe')->where('annee_universitaire_id', $an->id)->get(); //dd($etudiants);
        $classes = new Collection();
        foreach ($etudiants as $etd) {
            $type = Arr::last((TypeStageController::decouper_nom($etd->classe->typeStage->nom))); //dd($type);
            if ($type == "Volontaire") {
                $classes->push($etd->classe->nom); //dd($classes);
            }
        }
        $cls = $classes->flatten()->unique()->toArray();
        $etd1ereAnne = new Collection();
        foreach ($etudiants as $etd) {
            foreach ($cls as $c) {
                if ($etd->classe->nom == $c) {
                    $etd1ereAnne->push($etd);
                }
            }
        }
        $nbreEtdClsStgVolantaires = $etd1ereAnne->count();
        $an = StageController::current_annee_univ();
        $stagesVolontaires = StageController::stages1ereLicMaster()->where('annee_universitaire_id', $an->id);
        $idEtdStages = new Collection();
        $idEtdNonStages = new Collection();
        $idTousEtds = new Collection();
        foreach ($stagesVolontaires as $stg) {
            $idEtdStages->push($stg->etudiant_id);
        }
        foreach ($etudiants as $etd) {
            $idTousEtds->push($etd->id);
        }
        $idEtdNonStages = array_diff($idTousEtds->flatten()->unique()->toArray(), $idEtdStages->toArray());
        $nbreEtdStgVolantaires = $idEtdStages->flatten()->unique()->count();// dd($idEtdNonStages,$idEtdStages);//dd($nbreEtdStgVolantaires,$idEtdStages);
        $nbreEtdNonStgVolantaires = count(array_unique($idEtdNonStages)); //dd($nbreEtdNonStgVolantaires);
       // dd($nbreEtdNonStgVolantaires);
        $statVol = [$nbreEtdStgVolantaires, $nbreEtdNonStgVolantaires]; //dd($statVol);
        return $statVol;

    }
    public function etdsVsNiveauChart()
    {
        $an = StageController::current_annee_univ();
        $etds= Etudiant::with('user', 'classe')->where('annee_universitaire_id', $an->id)->get();
        $etds1anneeLic = new Collection();
        $etds2anneeLic = new Collection();
        $etds3anneeLic = new Collection();
        foreach ($etds as $etd) {
            if($etd->classe->niveau == 1 and  $etd->classe->cycle == "licence") {
                $etds1anneeLic->push($etd);
            }
        }
        foreach ($etds as $etd) {
            if($etd->classe->niveau == 2 and  $etd->classe->cycle == "licence") {
                $etds2anneeLic->push($etd);
            }
        }
        foreach ($etds as $etd) {
            if($etd->classe->niveau == 3 and  $etd->classe->cycle == "licence") {
                $etds3anneeLic->push($etd);
            }
        }
        $etdsLic = [$etds1anneeLic->count(), $etds2anneeLic->count(),$etds3anneeLic->count()];
        $etds1anneeMas = new Collection();
        $etds2anneeMas = new Collection();
        foreach ($etds as $etd) {
            if($etd->classe->niveau == 1 and  $etd->classe->cycle == "master") {
                $etds1anneeMas->push($etd);
            }
        }
        foreach ($etds as $etd) {
            if($etd->classe->niveau == 2 and  $etd->classe->cycle == "master") {
                $etds2anneeMas->push($etd);
            }
        }
        $etdsMas = [$etds1anneeMas->count(),$etds2anneeMas->count()];
        $etdsNivLic = new Collection();
        $etdsNivMast = new Collection();
        foreach ($etds as $etd) {
            if( $etd->classe->cycle == "master") {
                $etdsNivMast->push($etd);
            }
        }
        foreach ($etds as $etd) {
            if( $etd->classe->cycle == "licence") {
                $etdsNivLic->push($etd);
            }
        }
       $tousEtds = [$etdsNivLic->count(),$etdsNivMast->count()];
        return [$etdsLic,$etdsMas,$tousEtds];
    }

}

