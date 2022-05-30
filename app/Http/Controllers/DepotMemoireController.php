<?php

namespace App\Http\Controllers;

use App\Models\AnneeUniversitaire;
use App\Models\Classe;
use App\Models\Commentaire;
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
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
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

        }//dd($typeStages);
        $typeStagesUniq = $typeStages->unique();
        $stagesAdeposer = new Collection();
        foreach ($typeStagesUniq as $tsu) {
            if ($tsu->date_debut_depot != null) {
                $stage = Stage::where('type_stage_id', $tsu->id)->where('etudiant_id', $etudiant->id)->get();
                $stagesAdeposer->push($stage);
            }

        }
        //dd($stagesAdeposer);
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
        $depot_exists = DepotMemoire::where('stage_id', $stage_id)->exists();
        if($stage->typeStage->date_limite_depot >= $current_date && !$depot_exists) {
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
                $attributs['titre'] = $request->titre;
                //dd($request->titre);
                $attributs['date_depot'] = $current_date;
                $attributs['validation_encadrant'] = -1;
                $attributs['stage_id'] = $stage_id;
                $depot = DepotMemoire::create($attributs);
            }
            if ($stage->type_sujet == "PFE" ) {
                if($etudiant->classe->cycle == "licence") {
                    $attributs = $request->validate([
                        'fiche_tech' => ['required'],
                        'attestation' => ['required'],
                    ]);
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
                }
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
                        ->putFileAs('fiches_biblios_' . $classe->code, $request->file('fiche_biblio'), $fiche_biblio_name);
                    $attributs['fiche_biblio'] = $path2;
                }
                if (isset($request->memoire)) {
                    $memoire_name = 'Memoire_' . $nomComplet . '.' . $request->file('memoire')->extension();
                    $path3 = Storage::disk('public')
                        ->putFileAs('memoires_' .  $classe->code, $request->file('memoire'), $memoire_name);
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
                $attributs['titre'] = $request->titre;
                //dd( $attributs['titre'],$request->titre);
                $stage->titre_sujet =$attributs['titre'];
                $stage->update();
                //dd($stage);
                $current_date = Carbon::now();
                $attributs['date_depot'] = $current_date->format('Y-m-d');
                $attributs['validation_encadrant'] = -1;
                $attributs['validation_admin'] = -1;
                $attributs['stage_id'] = $stage_id;
                $depot = DepotMemoire::create($attributs);
            }
        }
        elseif ($depot_exists) {
            Session::flash('message', 'deja déposé');
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
        foreach ($liste_stages_actifs as $stage_actifs) {
            foreach ($stage_actifs as $stage_actif) {
                $demande_depot = DepotMemoire::where('stage_id', $stage_actif->id)->first();
                if (isset($demande_depot->memoire)) {
                    $memoire = substr($demande_depot->memoire, strpos($demande_depot->memoire, '/') + 1, strlen($demande_depot->memoire));
                    $demande_depot->memoire = $memoire;
                    $demandes_depots_memoires->push($demande_depot);
                }
            }
        }
        return view('enseignant.depot.liste-depots', compact(['demandes_depots_memoires']));
    }
    public function liste_demandes_depot_admin()
    {
        $demandesDepot = DepotMemoire::with('stage')->get();
        $demandesDepotC = new Collection();
        foreach ($demandesDepot as $d) {
            $d->memoire = Str::after($d->memoire, '/');
            $d->fiche_plagiat = Str::after($d->fiche_plagiat, '/');
            $d->fiche_biblio = Str::after($d->fiche_biblio, '/');
            if(isset($d->attestation) && isset($d->fiche_tech)){
                $d->attestation = Str::after($d->attestation, '/');
                $d->fiche_tech = Str::after($d->fiche_tech, '/');
            }
            $demandesDepotC->push($d);
        }
        //$mem = Str::after($depotMemoire->memoire, '/');
        //dd($demandesDepotC);

        return view('admin.depot.gerer_depot',compact('demandesDepotC'));
    }
    public function show(DepotMemoire $depotMemoire)
    {
        $mem = Str::after($depotMemoire->memoire, '/');
        return view('etudiant.depot.details_depot',compact('depotMemoire','mem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function edit(DepotMemoire $depotMemoire)
    {
        return view('etudiant.depot.redeposer',compact('depotMemoire'));
    }
    /**
     *
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function remarques_encadrant(DepotMemoire $depotMemoire) {
        //dd($depotMemoire);
        $commentaires=  Commentaire::where('depot_memoire_id',$depotMemoire->id )->get();
        $encadrant = $depotMemoire->stage->enseignant;
        return view('etudiant.depot.remarques_encadrant',compact('commentaires','encadrant'));
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
       //dd($request,$depotMemoire);
        $user_id = Auth::user()->id;
        $etudiant = Etudiant::all()->where('user_id', $user_id)->first();
        $nomComplet = ucwords($etudiant->nom) . ucwords($etudiant->prenom);
        $classe = Classe::findOrFail($etudiant->classe_id);
        if (isset($request->memoire)) {
            $memoire_name = 'Memoire_' . $nomComplet . '.' . $request->file('memoire')->extension();
            $path = Storage::disk('public')
                ->putFileAs('memoires_' .  $classe->code, $request->file('memoire'), $memoire_name);
            $depotMemoire->memoire = $path;
            $depotMemoire->update();
        }
        return redirect()->action([DepotMemoireController::class, 'index']);
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
    public function telecharger_memoire(String $memoire, String $code_classe)
    {
        $file_path = public_path() . '/storage/memoires_'.$code_classe.'/'.$memoire;
        if (file_exists($file_path)) {
            return Response::download($file_path, $memoire);
        } else {
            exit('mémoire inexistante !');
        }
    }
    public function telecharger_fiche_plagiat(String $fichePlagiat, String $code_classe)
    {
        $file_path = public_path() . '/storage/fiches_plagiats_'.$code_classe.'/'.$fichePlagiat;
        if (file_exists($file_path)) {
            return Response::download($file_path, $fichePlagiat);
        } else {
            exit('fiche Plagiat inexistante !');
        }
    }
    public function telecharger_fiche_biblio(String $ficheBiblio, String $code_classe)
    {
        $file_path = public_path() . '/storage/fiches_biblios_'.$code_classe.'/'.$ficheBiblio;
        if (file_exists($file_path)) {
            return Response::download($file_path, $ficheBiblio);
        } else {
            exit('fiche Biblio inexistante !');
        }
    }
    public function telecharger_fiche_tech(String $ficheTech, String $code_classe)
    {
        $file_path = public_path() . '/storage/fiches_techniques_'.$code_classe.'/'.$ficheTech;
        if (file_exists($file_path)) {
            return Response::download($file_path, $ficheTech);
        } else {
            exit('fiche Tech inexistante !');
        }
    }
    public function telecharger_attestation(String $attestation, String $code_classe)
    {
        $file_path = public_path() . '/storage/attestations_'.$code_classe.'/'.$attestation;
        if (file_exists($file_path)) {
            return Response::download($file_path, $attestation);
        } else {
            exit('attestaion inexistante !');
        }
    }
    public function valider_par_encadrant (DepotMemoire $demande_depot) {
        //dd($demande_depot->validation_encadrant != 1);
        if($demande_depot->validation_encadrant != 1 ){
            $demande_depot->validation_encadrant = 1;
            $demande_depot->update();
        } elseif($demande_depot->validation_encadrant == 1) {
            Session::flash('message', 'deja validé');
        }
        return redirect()->action([DepotMemoireController::class, 'liste_demandes_depot_enseignant']);
    }
    public function valider_par_admin (DepotMemoire $demande_depot) {
        //dd($demande_depot->validation_encadrant != 1);
        if($demande_depot->validation_encadrant == 1 ){
            $demande_depot->validation_admin = 1;
            $demande_depot->update();
        } elseif($demande_depot->validation_encadrant != 1) {
            Session::flash('message', 'attend validation encadrant');
        }
        return redirect()->action([DepotMemoireController::class, 'liste_demandes_depot_admin']);
    }
}
