<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\FraisEncadrement;
use App\Models\PaiementEnseignant;
use App\Models\Stage;
use App\Models\TypeStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementEnseignantController extends Controller
{
    //

    public function stagesEtFraisEncadrement() {
     /*   $enseignant = Enseignant::where('user_id', Auth::user()->id)->first();
        $stages_actifs = Stage::where('enseignant_id', $enseignant->id)
            ->where('confirmation_admin', 1)
            ->where('confirmation_encadrant', 1)
            ->get();
        $stages_frais = PaiementEnseignant::where('enseignant_id', $enseignant->id); //dd($stages_frais);*/
        $enseignant = Enseignant::where('user_id', Auth::user()->id)->first();
        $stages_frais = PaiementEnseignant::where('enseignant_id',$enseignant->id)->get();
       // dd(($stages_frais->first()));


        return view( 'enseignant.paiement.liste_stages_paye',compact('stages_frais'));

    }
}
