<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Departement;
use App\Models\Enseignant;
use App\Models\Entreprise;
use App\Models\Etudiant;
use App\Models\Specialite;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $annee = StageController::current_annee_univ();
        $nbre_etudiants = (Etudiant::where('annee_universitaire_id', $annee->id))->count();
        $nbre_enseignants = (Enseignant::all())->count();
        $nbre_departements = (Departement::all())->count();
        $nbre_specialites = (Specialite::all())->count();
        $nbre_classes = (Classe::all())->count();
        $nbre_entreprises = (Entreprise::all())->count();
        $nbre_stages = (Stage::where('annee_universitaire_id', $annee->id))->count();
        $stages = (StageController::stages1ereLicMaster())->count(); //dd($stages);
        $data = DashboardController::encadrementChart(); //dd($ids);
        $dataset = DashboardController::typeSujetChart(); //dd($dataset);
        $ic = 5;
        return view('admin.dashboard.dashboard', compact('nbre_etudiants', 'nbre_enseignants', 'nbre_departements', 'nbre_specialites', 'nbre_classes', 'nbre_entreprises', 'nbre_stages', 'data','ic','dataset'));
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
        foreach($ids1 as $i) {
            $c1++;
        }
        $data = [$c1, $idNonEncadrants];
        return $data;
    }
    public function typeSujetChart()
    {
        $stagesWithTypesSujets = Stage::select(DB::raw('type_sujet,count(*) as Nombre_des_stages'))->whereNotNull('type_sujet')->groupBy('type_sujet')->get()->toArray();
        $dataset = "";//dd($stagesWithTypesSujets);
        foreach($stagesWithTypesSujets as $st) {
            $dataset.= "['".array_values($st)[0]."',   ".
                array_values($st)[1]."],";
        }
        $array['dataset'] = rtrim($dataset,",");//dd($array);
        return $dataset;
    }

}

