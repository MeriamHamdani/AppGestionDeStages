<?php

namespace App\Http\Controllers;

use App\Exports\DepotsExport;
use App\Exports\DepotsToutExport;
use App\Models\AnneeUniversitaire;
use App\Models\Classe;
use App\Models\Commentaire;
use App\Models\DepotMemoire;
use App\Models\Enseignant;
use App\Models\Etablissement;
use App\Models\Etudiant;
use App\Models\Stage;
use App\Models\TypeStage;

//use Illuminate\Support\Collection;
use App\Notifications\DemandeDepotMemoireNotification;
use App\Notifications\DemandeEncadrementNotification;
use App\Notifications\DemandeRedepotMemoireNotification;
use App\Notifications\DepotMemoireRefuseParAdminNotification;
use App\Notifications\DepotMemoireValideParAdminNotification;
use App\Notifications\DepotMemoireValideParEncadrantNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
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
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->latest()->first();
        $stages = (Stage::where('etudiant_id', $etudiant->id))->where('confirmation_admin', 1)->get();
        //dd($stages);
        $typeStages = new Collection();
        foreach ($stages as $stage) {
            $ts = $stage->type_stage_id;
            $typeStage = TypeStage::findOrFail($ts);
            $typeStages->push($typeStage);
        }
        $typeStagesUniq = $typeStages->unique();
        $stagesAdeposer = new Collection();
        $current_date = Carbon::now()->format('Y-m-d');
        foreach ($typeStagesUniq as $tsu) {
            $type = Arr::last((TypeStageController::decouper_nom($tsu->nom)));
            if ($type == 'Obligatoire') {
                if ($tsu->date_debut_depot <= $current_date) {
                    $stages = Stage::where('type_stage_id', $tsu->id)->where('etudiant_id', $etudiant->id)->where('confirmation_admin', 1)->get();
                    //$stage = Stage::where('type_stage_id', $tsu->id)->where('etudiant_id', $etudiant->id)->get();
                    foreach ($stages as $stage) {
                        if (($stage->etudiant->classe->niveau !== 2 && $stage->etudiant->classe->cycle !== 'master') ||
                            ($stage->etudiant->classe->niveau !== 3 && $stage->etudiant->classe->cycle !== 'licence')) {//dd(\App\Models\DepotMemoire::where('stage_id',$stage->id)->first(), $stage->typeStage->date_limite_depot);
                            $stagesAdeposer->push($stage);
                            //dd($stage);
                        }//dd($stagesAdeposer);
                    }
                }
            }
        }//dd($stagesAdeposer);

        return view('etudiant.depot.depot_memoire', ['stagesAdeposer' => $stagesAdeposer, 'current_date' => $current_date]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stage_id = request()->get('stage_id');
        $user_id = Auth::user()->id;
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->latest()->first();
        $stage = Stage::findOrFail($stage_id);
        if ($stage->etudiant->user->id == $user_id && $stage->confirmation_admin == 1 && $stage->typeStage->date_debut_depot != null && $stage->typeStage->date_limite_depot != null) {
            return view('etudiant.depot.deposer', ['stage_id' => $stage_id, 'stage' => $stage, 'etudiant' => $etudiant]);
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'fiche_plagiat' => ['mimes:docx,jpeg,jpg,png,pdf'],
                'fiche_biblio' => ['mimes:docx,jpeg,jpg,png,pdf'],
                'memoire' => ['mimes:docx,pdf'],
                'fiche_tech' => [ 'mimes:docx,jpeg,jpg,png,pdf'],
                'attestation' => [ 'mimes:docx,jpeg,jpg,png,pdf'],
            ]
        );
        $stage_id = request()->get('stage_id');
        $stage = Stage::findOrFail($stage_id);
        $user_id = Auth::user()->id;
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->latest()->first();
        $nomComplet = ucwords($etudiant->nom) . ucwords($etudiant->prenom);
        //$current_date = Carbon::now()->format('Y-m-d');
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;//dd($annee_univ);
        $current_date = Carbon::now();
        $classe = Classe::findOrFail($etudiant->classe_id);
        $depot_exists = DepotMemoire::where('stage_id', $stage_id)->exists();
        if ($stage->etudiant->user->id == $user_id) {
            if ($stage->typeStage->date_limite_depot >= $current_date && !$depot_exists) {
                if ($stage->type_sujet == "Business Plan" || $stage->type_sujet == "Projet Tutoré") {
                    if (isset($request->fiche_plagiat)) {
                        $fiche_plagiat_name = 'FichePlagiat_' . $nomComplet . '.' . $request->file('fiche_plagiat')->extension();
                        $path = Storage::disk('public')
                            //->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_demandes_stages\fiches_demandes\fiches_demande_' . $classe->code, $request->file('fiche_demande'), $fiche_demande_name);
                            ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\fiches_plagiats\fiches_plagiats_'  . $classe->code, $request->file('fiche_plagiat'), $fiche_plagiat_name);
                        $attributs['fiche_plagiat'] = $path;
                    }
                    if (isset($request->fiche_biblio)) {
                        //dd($request);
                        $fiche_biblio_name = 'FicheBiblio_' . $nomComplet . '.' . $request->file('fiche_biblio')->extension();
                        $path2 = Storage::disk('public')
                            ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\fiches_biblios\fiches_biblios_'  . $classe->code, $request->file('fiche_biblio'), $fiche_biblio_name);
                        $attributs['fiche_biblio'] = $path2;
                    }
                    if (isset($request->memoire)) {
                        $memoire_name = 'Memoire_' . $nomComplet . '.' . $request->file('memoire')->extension();
                        $path3 = Storage::disk('public')
                            ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\mémoires\mémoires_'  . $classe->code, $request->file('memoire'), $memoire_name);
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
                    $attributs['date_depot'] = $current_date;
                    $attributs['validation_encadrant'] = -1;
                    $attributs['validation_admin'] = -1;
                    $attributs['stage_id'] = $stage_id;
                    $depot = DepotMemoire::create($attributs);
                    $stage->depot_memoire_id = $depot->id;
                    $stage->titre_sujet = $depot->titre;
                    $stage->update();
                    $enseignant = $depot->stage->enseignant;
                    $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                        'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                        'classe_etud' => $classe->nom,
                        'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
                    $enseignant->notify(new DemandeDepotMemoireNotification($data));
                }
                if ($stage->type_sujet == "PFE") {
                    if ($etudiant->classe->cycle == "licence") {
                        $attributs = $request->validate([
                            'fiche_tech' => ['required'],
                            'attestation' => ['required'],
                        ]);
                        if (isset($request->fiche_tech)) {
                            //dd($request);
                            $fiche_tech_name = 'FicheTechnique_' . $nomComplet . '.' . $request->file('fiche_tech')->extension();
                            $path4 = Storage::disk('public')
                                ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\fiches_techniques\fiches_techniques_'  . $classe->code, $request->file('fiche_tech'), $fiche_tech_name);
                            $attributs['fiche_tech'] = $path4;
                        }
                        if (isset($request->attestation)) {
                            //dd($request);
                            $attestation_name = 'Attestation_' . $nomComplet . '.' . $request->file('attestation')->extension();
                            $path5 = Storage::disk('public')
                                ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\attestations\attestations_'  . $classe->code, $request->file('attestation'), $attestation_name);
                            $attributs['attestation'] = $path5;
                        }
                    }
                    if (isset($request->fiche_plagiat)) {
                        $fiche_plagiat_name = 'FichePlagiat_' . $nomComplet . '.' . $request->file('fiche_plagiat')->extension();
                        $path = Storage::disk('public')
                            ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\fiches_plagiats\fiches_plagiats_'  . $classe->code, $request->file('fiche_plagiat'), $fiche_plagiat_name);
                        $attributs['fiche_plagiat'] = $path;
                    }
                    if (isset($request->fiche_biblio)) {
                        //dd($request);
                        $fiche_biblio_name = 'FicheBiblio_' . $nomComplet . '.' . $request->file('fiche_biblio')->extension();
                        $path2 = Storage::disk('public')
                            ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\fiches_biblios\fiches_biblios_'  . $classe->code, $request->file('fiche_biblio'), $fiche_biblio_name);
                        $attributs['fiche_biblio'] = $path2;
                    }
                    if (isset($request->memoire)) {
                        $memoire_name = 'Memoire_' . $nomComplet . '.' . $request->file('memoire')->extension();
                        $path3 = Storage::disk('public')
                            ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\mémoires\mémoires_'  . $classe->code, $request->file('memoire'), $memoire_name);
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
                    $stage->titre_sujet = $attributs['titre'];
                    $stage->update();
                    //dd($stage);
                    $current_date = Carbon::now();
                    $attributs['date_depot'] = $current_date->format('Y-m-d');
                    $attributs['validation_encadrant'] = -1;
                    $attributs['validation_admin'] = -1;
                    $attributs['stage_id'] = $stage_id;
                    $depot = DepotMemoire::create($attributs);
                    $stage->depot_memoire_id = $depot->id;
                    $stage->update();
                    $enseignant = $depot->stage->enseignant;
                    $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                        'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                        'classe_etud' => $classe->nom,
                        'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
                    $enseignant->notify(new DemandeDepotMemoireNotification($data));
                }
            } elseif ($depot_exists) {
                Session::flash('message', 'deja déposé');
            }
        } else {
            abort(404);
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
        $ann = Session::get('annee');
        if (isset($ann)) {
            $demandesDepot = DepotMemoire::with('stage')->where('annee_universitaire_id', $ann->id)->get();
            $demandesDepotC = new Collection();
            foreach ($demandesDepot as $d) {
                $d->memoire = Str::after($d->memoire, '/');
                $d->fiche_plagiat = Str::after($d->fiche_plagiat, '/');
                $d->fiche_biblio = Str::after($d->fiche_biblio, '/');
                if (isset($d->attestation) && isset($d->fiche_tech)) {
                    $d->attestation = Str::after($d->attestation, '/');
                    $d->fiche_tech = Str::after($d->fiche_tech, '/');
                }
                $demandesDepotC->push($d);
            }
            $cls = Classe::all();
            $classes = new Collection();
            foreach ($cls as $cl) {
                $isMaster = strtoupper($cl->cycle) === strtoupper('master');
                $isLicence = strtoupper($cl->cycle) === strtoupper('licence');
                if ($isLicence && $cl->niveau == 3 || $isMaster && $cl->niveau == 2) {
                    $classes->push($cl);
                }
            }//dd($classes);
            return view('admin.depot.gerer_depot', compact('demandesDepotC', 'classes'));
        } else {
            $an = StageController::current_annee_univ(); //dd($an);
            $demandesDepot = DepotMemoire::with('stage')->where('annee_universitaire_id', $an->id)->get();
            $demandesDepotC = new Collection();
            foreach ($demandesDepot as $d) {
                $d->memoire = Str::after($d->memoire, '/');
                $d->fiche_plagiat = Str::after($d->fiche_plagiat, '/');
                $d->fiche_biblio = Str::after($d->fiche_biblio, '/');
                if (isset($d->attestation) && isset($d->fiche_tech)) {
                    $d->attestation = Str::after($d->attestation, '/');
                    $d->fiche_tech = Str::after($d->fiche_tech, '/');
                }
                $demandesDepotC->push($d);
            }
            $cls = Classe::all();
            $classes = new Collection();
            foreach ($cls as $cl) {
                $isMaster = strtoupper($cl->cycle) === strtoupper('master');
                $isLicence = strtoupper($cl->cycle) === strtoupper('licence');
                if ($isLicence && $cl->niveau == 3 || $isMaster && $cl->niveau == 2) {
                    $classes->push($cl);
                }
            }//dd($classes);
            return view('admin.depot.gerer_depot', compact('demandesDepotC', 'classes'));
        }
    }

    public function exporter_liste_depots(Request $request)
    {
        if(($request->classe_id)=="tous") {
            return Excel::download(new DepotsToutExport, 'liste-memoires.xlsx');
        } else {
            $cls = Classe::find($request->classe_id)->code;
            return Excel::download(new DepotsExport, 'liste-memoires'.'-'.$cls.'.xlsx');
        }
    }

    public function show(DepotMemoire $depotMemoire)
    {
        $mem = Str::after($depotMemoire->memoire, '/');
        $current_date = Carbon::now()->format('Y-m-d');
        //dd($depotMemoire->stage->etudiant->user->id,Auth::user()->id);
        if ($depotMemoire->stage->etudiant->user->id == Auth::user()->id && $depotMemoire->stage->typeStage->date_debut_depot <= $current_date) {
            return view('etudiant.depot.details_depot', compact('depotMemoire', 'mem'));
        } else {
            abort(404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function edit(DepotMemoire $depotMemoire)
    {
        $current_date = Carbon::now()->format('Y-m-d');
        if ($depotMemoire->stage->etudiant->user->id == Auth::user()->id && $depotMemoire->stage->typeStage->date_limite_depot > $current_date) {
            return view('etudiant.depot.redeposer', compact('depotMemoire'));
        } else {
            abort(404);
        }
    }

    /**
     *
     * @param \App\Models\DepotMemoire $depotMemoire
     * @return \Illuminate\Http\Response
     */
    public function remarques_encadrant(DepotMemoire $depotMemoire)
    {

        if ($depotMemoire->stage->etudiant->user->id == Auth::user()->id) {
            $commentaires = Commentaire::where('depot_memoire_id', $depotMemoire->id)->get();
            $encadrant = $depotMemoire->stage->enseignant;
            return view('etudiant.depot.remarques_encadrant', compact('commentaires', 'encadrant'));
        } else {
            abort(404);
        }
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
        $request->validate(
            [
                'memoire' => ['mimes:docx,pdf'],
            ]
        );
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->latest()->first();
        $nomComplet = ucwords($etudiant->nom) . ucwords($etudiant->prenom);
        $classe = Classe::findOrFail($etudiant->classe_id);
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = AnneeUniversitaire::findOrFail($depotMemoire->stage->annee_universitaire_id)->annee;//dd($annee_univ);
        $current_date = Carbon::now();
        //dd($depotMemoire->stage->etudiant->user->id == Auth::user()->id ,$depotMemoire->stage->typeStage->date_limite_depot > $current_date);
        if ($depotMemoire->stage->etudiant->user->id == Auth::user()->id && $depotMemoire->stage->typeStage->date_limite_depot > $current_date) {
            if (isset($request->memoire)) {
                $memoire_name = 'Memoire_' . $nomComplet . '.' . $request->file('memoire')->extension();
                $path = Storage::disk('public')
                    ->putFileAs($etablissement.'-'.$anneeUniv.'\fiches_suivi_stages\fiches_depots_memoires\mémoires\mémoires_' . $classe->code, $request->file('memoire'), $memoire_name);
                $depotMemoire->memoire = $path;
                $depotMemoire->update();
                $enseignant = $depotMemoire->stage->enseignant;
                $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                    'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                    'classe_etud' => $classe->nom,
                    'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
                $enseignant->notify(new DemandeRedepotMemoireNotification($data));
            }
            return redirect()->action([DepotMemoireController::class, 'index']);
        } else {
            abort(404);
        }
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

    public function telecharger_memoire(Stage $stage,string $memoire, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $file_path = public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_depots_memoires/mémoires/mémoires_' . $code_classe . '/' . $memoire;
       // dd($file_path,$memoire);
        if (file_exists($file_path)) {
            return Response::download($file_path, $memoire);
        } else {
            exit('mémoire inexistante !');
        }
    }

    public function telecharger_fiche_plagiat(Stage $stage, string $fichePlagiat, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $file_path = public_path() . '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_depots_memoires/fiches_plagiats/fiches_plagiats_' . $code_classe . '/' . $fichePlagiat;
        //$file_path = public_path() . '/storage/fiches_plagiats_' . $code_classe . '/' . $fichePlagiat;
        if (file_exists($file_path)) {
            return Response::download($file_path, $fichePlagiat);
        } else {
            exit('fiche Plagiat inexistante !');
        }
    }

    public function telecharger_fiche_biblio(Stage $stage,string $ficheBiblio, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        //$anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $file_path = public_path() .  '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_depots_memoires/fiches_biblios/fiches_biblios_' . $code_classe . '/' . $ficheBiblio;
        if (file_exists($file_path)) {
            return Response::download($file_path, $ficheBiblio);
        } else {
            exit('fiche Biblio inexistante !');
        }
    }

    public function telecharger_fiche_tech(Stage $stage,string $ficheTech, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        //$anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $file_path = public_path() .  '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_depots_memoires/fiches_techniques/fiches_techniques_' . $code_classe . '/' . $ficheTech;
        if (file_exists($file_path)) {
            return Response::download($file_path, $ficheTech);
        } else {
            exit('fiche Tech inexistante !');
        }
    }

    public function telecharger_attestation(Stage $stage,string $attestation, string $code_classe)
    {
        $etablissement = Etablissement::all()->first()->nom;
        //$anneeUniv = $this->current_annee_univ()->annee; //dd($annee);
        $anneeUniv = AnneeUniversitaire::findOrFail($stage->annee_universitaire_id)->annee;
        $file_path = public_path() .  '/storage/'.$etablissement.'-'.$anneeUniv.'/fiches_suivi_stages/fiches_depots_memoires/attestations/attestations_' . $code_classe . '/' . $attestation;
        // dd($file_path);
        if (file_exists($file_path)) {
            return Response::download($file_path, $attestation);
        } else {
            exit('attestaion inexistante !');
        }
    }

    public function valider_par_encadrant(DepotMemoire $demande_depot)
    {
        if ($demande_depot->validation_encadrant != 1) {
            $demande_depot->validation_encadrant = 1;
            $demande_depot->update();
            $etudiant = $demande_depot->stage->etudiant;
            $enseignant = $demande_depot->stage->enseignant;
            $current_date = Carbon::now();
            $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
            $etudiant->notify(new DepotMemoireValideParEncadrantNotification($data));
        } elseif ($demande_depot->validation_encadrant == 1) {
            Session::flash('message', 'deja validé');
        }
        return redirect()->action([DepotMemoireController::class, 'liste_demandes_depot_enseignant']);
    }

    public function valider_par_admin(DepotMemoire $demande_depot)
    {
        if ($demande_depot->validation_encadrant == 1) {
            $demande_depot->validation_admin = 1;
            $stage = Stage::find($demande_depot->stage_id);
            $stage->validation_admin = 1;
            $stage ->validation_encadrant = 1;
            $stage->update();
            $demande_depot->update();
            $etudiant = $demande_depot->stage->etudiant;
            $enseignant = $demande_depot->stage->enseignant;
            $current_date = Carbon::now();
            $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                'nom_ens' => ucwords($enseignant->nom . ' ' . $enseignant->prenom),
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
            $etudiant->notify(new DepotMemoireValideParAdminNotification($data));
        } elseif ($demande_depot->validation_encadrant != 1) {
            Session::flash('message', 'attend validation encadrant');
        }
        return redirect()->action([DepotMemoireController::class, 'liste_demandes_depot_admin']);
    }

    public function refuser_par_admin(DepotMemoire $demande_depot)
    {
        $etudiant = $demande_depot->stage->etudiant;
        $current_date = Carbon::now();
        $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
            'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
        $etudiant->notify(new DepotMemoireRefuseParAdminNotification($data));
        $stage= Stage::find($demande_depot->stage_id);
        $stage->depot_memoire_id = null;
        $stage->update();
        $demande_depot->stage_id = null;
        $demande_depot->update();
        $demande_depot->delete();
        return redirect()->action([DepotMemoireController::class, 'liste_demandes_depot_admin']);
    }

}

