<?php

namespace App\Http\Controllers;

use App\Models\AnneeUniversitaire;
use App\Models\Classe;
use App\Models\DepotMemoire;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Stage;
use App\Models\TypeStage;

//use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;

class DepotMemoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $etudiant = Etudiant::all()->where('user_id', $user_id)->first();
        //dd($etudiant);
        $stages = (Stage::where('etudiant_id', $etudiant->id))->where('confirmation_admin',1)->get();
        $typeStages = new Collection();
        //dd($stages);
        foreach ($stages as $stage) {
            $ts = $stage->type_stage_id;
            $typeStage = TypeStage::findOrFail($ts);
            $typeStages->push($typeStage);

        }
        $typeStagesUniq = $typeStages->unique();
        $stagesAdeposer = new Collection();
        foreach ($typeStagesUniq as $tsu) {
            if ($tsu->date_debut_depot != null) {
                $stage = Stage::where('type_stage_id', $tsu->id)->get();
                $stagesAdeposer->push($stage[0]);
            }

        }
        $current_date = Carbon::now()->format('Y-m-d');
        return view('etudiant.depot.depot_memoire', ['stagesAdeposer' => $stagesAdeposer, 'current_date'=>$current_date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stage_id = request()->get('stage_id');
        $stage = Stage::findOrFail($stage_id);
        $user_id = Auth::user()->id;
        $etudiant = Etudiant::all()->where('user_id', $user_id)->first();
        return view('etudiant.depot.deposer', ['stage_id' => $stage_id, 'stage' => $stage, 'etudiant' => $etudiant]);
        // return redirect()->action([TypeStageController::class,'create'],$classe_id);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stage_id = request()->get('stage_id');
        $stage = Stage::findOrFail($stage_id);
        $user_id = Auth::user()->id;
        $etudiant = Etudiant::all()->where('user_id', $user_id)->first();
        $nomComplet = ucwords($etudiant->nom) . ucwords($etudiant->prenom);
        $current_date = Carbon::now()->format('Y-m-d');
        $classe = Classe::findOrFail($etudiant->classe_id);
        //dd($stage->typeStage->date_limite_depot >= $current_date);
        if($stage->typeStage->date_limite_depot >= $current_date) {
            if ($stage->type_sujet == "Business Plan" || $stage->type_sujet == "Projet Tutoré") {
                if (isset($request->fiche_plagiat)) {
                    $fiche_plagiat_name = 'FichePlagiat_' . $nomComplet . '.' . $request->file('fiche_plagiat')->extension();
                    $path = Storage::disk('public')
                        ->putFileAs('fiches_plagiats_' . '.' . $classe->code, $request->file('fiche_plagiat'), $fiche_plagiat_name);
                    $attributs['fiche_plagiat'] = $path;
                }
                if (isset($request->fiche_biblio)) {
                    //dd($request);
                    $fiche_biblio_name = 'FicheBiblio_' . $nomComplet . '.' . $request->file('fiche_biblio')->extension();
                    $path2 = Storage::disk('public')
                        ->putFileAs('fiches_biblios_'  . $classe->code, $request->file('fiche_biblio'), $fiche_biblio_name);
                    $attributs['fiche_biblio'] = $path2;
                }
                if (isset($request->memoire)) {
                    $memoire_name = 'Memoire_' . $nomComplet . '.' . $request->file('memoire')->extension();
                    $path3 = Storage::disk('public')
                        ->putFileAs('memoires_' . $classe->code, $request->file('memoire'), $memoire_name);
                    $attributs['memoire'] = $path3;
                }
                $mydate = Carbon::now();
                $moisCourant = (int)$mydate->format('m');
                if ((6 < $moisCourant) && ($moisCourant < 12)) {
                    $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
                } else
                    $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
                $annees = AnneeUniversitaire::all();
                foreach ($annees as $a) {
                    if ($a->annee == $annee) {
                        $attributs['annee_universitaire_id'] = $a->id;
                        break;
                    }
                }
                $attributs['titre'] = $stage->titre_sujet;
                $attributs['date_depot'] = $current_date;
                $attributs['validation_encadrant'] = -1;
                $attributs['stage_id'] = $stage_id;
                $depot = DepotMemoire::create($attributs);
            }
            if ($stage->type_sujet == "PFE") {
                $attributs = $request->validate([
                    'fiche_tech' => ['required'],
                    'attestation' => ['required'],
                ]);
                if (isset($request->fiche_plagiat)) {
                    $fiche_plagiat_name = 'FichePlagiat_' . $nomComplet . '.' . $request->file('fiche_plagiat')->extension();
                    $path = Storage::disk('public')
                        ->putFileAs('fiches_plagiats_' . $classe->code, $request->file('fiche_plagiat'), $fiche_plagiat_name);
                    $attributs['fiche_plagiat'] = $path;
                }
                if (isset($request->fiche_biblio)) {
                    //dd($request);
                    $fiche_biblio_name = 'FicheBiblio_' . $nomComplet . '.' . $request->file('fiche_biblio')->extension();
                    $path2 = Storage::disk('public')
                        ->putFileAs('fiches_biblios_' .  $classe->code, $request->file('fiche_biblio'), $fiche_biblio_name);
                    $attributs['fiche_biblio'] = $path2;
                }
                if (isset($request->memoire)) {
                    $memoire_name = 'Memoire_' . $nomComplet . '.' . $request->file('memoire')->extension();
                    $path3 = Storage::disk('public')
                        ->putFileAs('memoires_' .  $classe->code, $request->file('memoire'), $memoire_name);
                    $attributs['memoire'] = $path3;
                }
                if (isset($request->fiche_tech)) {
                    //dd($request);
                    $fiche_tech_name = 'FicheTechnique_' . $nomComplet . '.' . $request->file('fiche_tech')->extension();
                    $path4 = Storage::disk('public')
                        ->putFileAs('fiches_techniques_'  . $classe->code, $request->file('fiche_tech'), $fiche_tech_name);
                    $attributs['fiche_tech'] = $path4;
                }
                if (isset($request->attestation)) {
                    //dd($request);
                    $attestation_name = 'Attestation_' . $nomComplet . '.' . $request->file('attestation')->extension();
                    $path5 = Storage::disk('public')
                        ->putFileAs('attestations_' . $classe->code, $request->file('attestation'), $attestation_name);
                    $attributs['attestation'] = $path5;
                }
                $mydate = Carbon::now();
                $moisCourant = (int)$mydate->format('m');
                if ((6 < $moisCourant) && ($moisCourant < 12)) {
                    $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
                } else
                    $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
                $annees = AnneeUniversitaire::all();
                foreach ($annees as $a) {
                    if ($a->annee == $annee) {
                        $attributs['annee_universitaire_id'] = $a->id;
                        break;
                    }
                }
                $attributs['titre'] = $stage->titre_sujet;
                $current_date = Carbon::now();
                $attributs['date_depot'] = $current_date->format('Y-m-d');
                $attributs['validation_encadrant'] = -1;
                $attributs['stage_id'] = $stage_id;
                $depot = DepotMemoire::create($attributs);
            }
        }
        return redirect()->action([DepotMemoireController::class, 'index']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function liste_demandes_depot_enseignant()
    {
        $user_id = Auth::user()->id;
        $ens = Enseignant::all()->where('user_id', $user_id)->first();
        $liste_stages_actifs = EnseignantController::liste_stages_actifs()->getData();
        //dd($liste_stages_actifs);
        $demandes_depots_memoires = new Collection();
        foreach ($liste_stages_actifs as $stage_actif)
        {
            //dd($stage_actif[0]->id);
            $demande_depot = DepotMemoire::where('stage_id',$stage_actif[0]->id)->first();
           //dd($demande_depot->memoire );
            if ($demande_depot->memoire != null) {
                $demandes_depots_memoires->push($demande_depot);
            }
        }
//dd($demandes_depots_memoires);
        return view('enseignant.depot.liste-depots', compact(['demandes_depots_memoires']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function edit(DepotMemoire $depotMemoire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepotMemoire $depotMemoire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepotMemoire $depotMemoire)
    {
        //
    }
}
