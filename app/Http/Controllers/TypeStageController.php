<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Notifications\SessionDepotModifieNotification;
use App\Notifications\SessionDepotOuverteNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Rules\dateDebFinRule;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TypeStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeStages = TypeStage::with('classe')->get();
        //dd($typeStage->classe->code);
        $classes = Classe::with('typeStage')->get();
        //$typeStages = TypeStages::with('classe')->get();
        // $typeStage = TypeStage::all()->first();
        return view('admin.configuration.generale.liste_classe_typeStage', ['classes' => $classes, 'typeStages' => $typeStages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Classe $classe)
    {

        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "");
        return view('admin.configuration.generale.typeStage_classe', ['classe' => $classe, 'error_message' => $error_message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classe $classe)
    {
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "");
        $request->validate([
            'type' => ['required'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
            'duree_stage_min' => ['required'],
            'duree_stage_max' => ['required'],
            'fiche_demande_type' => ['required'],
            'fiche_assurance_type' => ['required'],
            'fiche_2Dinars_type' => ['required'],
            'cahier_stage_type' => ['required'],
        ]);
        $code_classe = $classe->code;
        $type_stage_nom = Str::upper($code_classe) . ' ' . $request->type;
        $types_stage = TypeStage::all();
        foreach ($types_stage as $ts) {
            if (($ts->nom === $type_stage_nom)) {
                return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
            }
        }
        $date_deb = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
        $date_f = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');
        $type_stage = new TypeStage();
        $type_stage->classe_id = $classe->id;
        $type_stage->nom = $type_stage_nom;
        $nbre_mois = StageController::diff_date_en_mois($date_deb, $date_f);
        if ($date_deb < $date_f) {
            if ($request->duree_stage_min <= $request->duree_stage_max) {
                if ($nbre_mois >= $request->duree_stage_max) {
                    $type_stage->date_debut_periode = $date_deb;
                    $type_stage->date_limite_periode = $date_f;
                    $type_stage->duree_stage_min = $request->duree_stage_min;
                    $type_stage->duree_stage_max = $request->duree_stage_max;
                } else {
                    $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "L'erreur est dû à cause de mal correspondance entre la période de stage que vous avez saisi et la durée maximale! Verifiez!");
                    return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
                }
            } else {
                $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "Le nombre de mois minimum doit être inférieur au nombre de mois maximum! Verifiez!");
                return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
            }
        } else {
            $error_message = array("nom" => "", "periode_stage" => "La date de fin doit être ultérieure à la date de début   !", "depot_stage" => "");
            return view('admin.configuration.generale.typeStage_classe', compact(["classe", "error_message"]));
        }
        if (($request->fiche_demande_type == "requis")) {
            $request->validate(['fiche_demande' => ['required', 'mimes:docx,jpg,jpeg,png,doc']]);
            if (isset($request->fiche_demande)) {
                $fiche_demande_name = 'FicheDemande_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name)
                $path = Storage::disk('public')
                    ->putFileAs('fiches_demande', $request->file('fiche_demande'), $fiche_demande_name);
                $type_stage->fiche_demande = $path;
            }
        }
        $type_stage->type_sujet = $request->type_sujet;
        $type_stage->fiche_demande_type = $request->fiche_demande_type;
        $type_stage->fiche_assurance_type = $request->fiche_assurance_type;
        $type_stage->fiche_2Dinars_type = $request->fiche_2Dinars_type;
        $type_stage->cahier_stage_type = $request->cahier_stage_type;
        $type_stage->save();
        $classe->type_stage_id = $type_stage->id;
        $classe->update();
        Session::flash('message', 'ok');
        return redirect()->action([ClasseController::class, 'index']);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function show(TypeStage $typeStage)
    {
        //
    }

    public function telechargement_fiche_demande(Request $request)
    {

        $fiche_demande = $request->fiche_demande;
        $fiche_demande2 = 'fiches_demande/' . $fiche_demande;
        $file_path = public_path() . '/storage/' . $fiche_demande2;

        if (file_exists($file_path)) {
            return Response::download($file_path, $fiche_demande);
        } else {
            exit('fiche demande inexistante !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeStage $typeStage)
    {
        $classe = $typeStage->classe;
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "");
        $type = Arr::last(($this->decouper_nom($typeStage->nom)));
        return view('admin.configuration.generale.modifier_typeStage'
            , ['typeStage' => $typeStage, 'classe' => $classe, 'error_message' => $error_message, 'type' => $type]);
    }

    static function decouper_nom(string $nom)
    {

        $retour = array();
        $delimiteurs = ' ';
        $tok = strtok($nom, " ");
        while (strlen(join(" ", $retour)) != strlen($nom)) {
            array_push($retour, $tok);
            $tok = strtok($delimiteurs);
        }
        return $retour;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeStage $typeStage)
    {
        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "");
        $request->validate([
            'type' => ['required'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
            'duree_stage_min' => ['required'],
            'duree_stage_max' => ['required'],
            'fiche_demande_type' => ['required'],
            'fiche_assurance_type' => ['required'],
            'fiche_2Dinars_type' => ['required'],
            'cahier_stage_type' => ['required'],
        ]);
        $classe = $typeStage->classe;
        $code_classe = $typeStage->classe->code;
        if ($typeStage->date_debut_periode !== $request->date_debut && $typeStage->date_limite_periode !== $request->date_fin) {
            $type = Arr::last(($this->decouper_nom($typeStage->nom)));
            $dateDebut = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
            $dateLimite = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');
            $nbre_mois = StageController::diff_date_en_mois($dateDebut, $dateLimite);
            if ($dateDebut < $dateLimite) {
                if ($request->duree_stage_min < $request->duree_stage_max) {
                    if ($nbre_mois >= $request->duree_stage_max) {
                        $typeStage->date_debut_periode = $dateDebut;
                        $typeStage->date_limite_periode = $dateLimite;
                        $typeStage->duree_stage_min = $request->duree_stage_min;
                        $typeStage->duree_stage_max = $request->duree_stage_max;
                        $typeStage->update();
                    } else {
                        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "L'erreur est dû à cause de mal correspondance entre la période de stage que vous avez saisi et la durée maximale! Verifiez!");
                        return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                    }
                } else {
                    $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "Le nombre de mois minimum doit être inférieur au nombre de mois maximum! Verifiez!");
                    //return view('admin.configuration.generale.modifier_typeStage', compact(["classe", "error_message","typeStage"]));
                    return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                }
            } else {
                $error_message = array("nom" => "", "periode_stage" => "La date de fin doit être ultérieure à la date de début   !", "depot_stage" => "");
                //return view('admin.configuration.generale.modifier_typeStage', compact(["classe", "error_message","typeStage"]));
                return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
            }
        }
        if ($typeStage->date_debut_periode !== $request->date_debut && $typeStage->date_limite_periode == $request->date_fin) {
            $type = Arr::last(($this->decouper_nom($typeStage->nom)));
            $dateDebut = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
            $nbre_mois = StageController::diff_date_en_mois($dateDebut, $typeStage->date_limite_periode);
            if ($dateDebut < $typeStage->date_limite_periode) {
                if ($request->duree_stage_min < $request->duree_stage_max) {
                    if ($nbre_mois >= $request->duree_stage_max) {
                        //dd($nbre_mois);
                        $typeStage->date_debut_periode = $dateDebut;
                        $typeStage->duree_stage_min = $request->duree_stage_min;
                        $typeStage->duree_stage_max = $request->duree_stage_max;
                        $typeStage->update();
                        //dd($typeStage);
                    } else {
                        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "L'erreur est dû à cause de mal correspondance entre la période de stage que vous avez saisi et la durée maximale! Verifiez!");
                        return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                    }
                } else {
                    $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "Le nombre de mois minimum doit être inférieur au nombre de mois maximum! Verifiez!");
                    //return view('admin.configuration.generale.modifier_typeStage', compact(["classe", "error_message","typeStage"]));
                    return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                }
            } else {
                $error_message = array("nom" => "", "periode_stage" => "La date de fin doit être ultérieure à la date de début   !", "depot_stage" => "");
                //return view('admin.configuration.generale.modifier_typeStage', compact(["classe", "error_message","typeStage"]));
                return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
            }
        }
        if ($typeStage->date_debut_periode == $request->date_debut && $typeStage->date_limite_periode !== $request->date_fin) {
            $type = Arr::last(($this->decouper_nom($typeStage->nom)));
            $dateLimite = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');
            $nbre_mois = StageController::diff_date_en_mois($typeStage->date_debut_periode, $dateLimite);
            if ($typeStage->date_debut_periode < $dateLimite) {
                if ($request->duree_stage_min < $request->duree_stage_max) {
                    if ($nbre_mois >= $request->duree_stage_max) {
                        $typeStage->date_limite_periode = $dateLimite;
                        $typeStage->duree_stage_min = $request->duree_stage_min;
                        $typeStage->duree_stage_max = $request->duree_stage_max;
                        $typeStage->update();
                    } else {
                        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "L'erreur est dû à cause de mal correspondance entre la période de stage que vous avez saisi et la durée maximale! Verifiez!");
                        return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                    }
                } else {
                    $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "Le nombre de mois minimum doit être inférieur au nombre de mois maximum! Verifiez!");
                    //return view('admin.configuration.generale.modifier_typeStage', compact(["classe", "error_message","typeStage"]));
                    return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                }
            } else {
                $error_message = array("nom" => "", "periode_stage" => "La date de fin doit être ultérieure à la date de début   !", "depot_stage" => "");
                //return view('admin.configuration.generale.modifier_typeStage', compact(["classe", "error_message","typeStage"]));
                return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
            }
        }
        if ($typeStage->date_debut_periode == $request->date_debut && $typeStage->date_limite_periode == $request->date_fin) {
            $type = Arr::last(($this->decouper_nom($typeStage->nom)));
            $nbre_mois = StageController::diff_date_en_mois($typeStage->date_debut_periode, $typeStage->date_limite_periode);
            if ($typeStage->date_debut_periode < $typeStage->date_limite_periode) {
                if ($request->duree_stage_min < $request->duree_stage_max) {
                    if ($nbre_mois >= $request->duree_stage_max) {
                        $typeStage->duree_stage_min = $request->duree_stage_min;
                        $typeStage->duree_stage_max = $request->duree_stage_max;
                        $typeStage->update();
                    } else {
                        $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "L'erreur est dû à cause de mal correspondance entre la période de stage que vous avez saisi et la durée maximale! Verifiez!");
                        return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                    }
                } else {
                    $error_message = array("nom" => "", "periode_stage" => "", "depot_stage" => "", "duree_max_min" => "Le nombre de mois minimum doit être inférieur au nombre de mois maximum! Verifiez!");
                    return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
                }
            } else {
                $error_message = array("nom" => "", "periode_stage" => "La date de fin doit être ultérieure à la date de début   !", "depot_stage" => "");
                return view('admin.configuration.generale.modifier_typeStage', ["typeStage" => $typeStage, "classe" => $classe, "error_message" => $error_message, "type" => $type]);
            }
        }

        if (($request->fiche_demande_type == "requis") && ($typeStage->fiche_demande == null)) {
            $request->validate(['fiche_demande' => ['required', 'mimes:docx,jpg,jpeg,png,doc']]);
            $fiche_demande_name = 'FicheDemande_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name)
            $path = Storage::disk('public')
                ->putFileAs('fiches_demande', $request->file('fiche_demande'), $fiche_demande_name);
            $typeStage->fiche_demande = $path;
            $typeStage->update();
        }
        if (isset($request->fiche_demande)) {
            $request->validate(['fiche_demande' => ['required', 'mimes:docx,jpg,jpeg,png,doc']]);
            $fiche_demande_name = 'FicheDemande_' . Str::upper(str_replace(' ', '', $code_classe)) . '_' . $request->type . '.' . $request->file('fiche_demande')->extension();//dd($fiche_demande_name)
            $path = Storage::disk('public')
                ->putFileAs('fiches_demande', $request->file('fiche_demande'), $fiche_demande_name);
            $typeStage->fiche_demande = $path;
            $typeStage->update();
        }
        $typeStage_nom = Str::upper($code_classe) . ' ' . $request->type;
        $typeStage->classe_id = $classe->id;
        $typeStage->nom = $typeStage_nom;
        $typeStage->type_sujet = $request->type_sujet;
        $typeStage->cahier_stage_type = $request->cahier_stage_type;
        $typeStage->fiche_2Dinars_type = $request->fiche_2Dinars_type;
        $typeStage->fiche_demande_type = $request->fiche_demande_type;
        $typeStage->fiche_assurance_type = $request->fiche_assurance_type;
        $typeStage->update();
        Session::flash('message', 'ok update');
        return redirect()->action([TypeStageController::class, 'index']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TypeStage $typeStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeStage $typeStage)
    {
        $typeStage->delete();
        return redirect()->action([TypeStageController::class, 'index']);
    }

    public function listeSessions()
    {
        $currentDate = Carbon::now();
        $sessionsOuvertes = TypeStage::where('date_limite_depot', '>', $currentDate)->where('date_debut_depot', '!=', null)->get();
        //dd($sessionsOuvertes);
        return view('admin.configuration.generale.liste_sessions', ['sessionsOuvertes' => $sessionsOuvertes]);
    }

    public function new_session_depot(Request $request)
    {
        $request->validate([
            'date_debut_depot' => ['required', 'date'],
            'date_limite_depot' => ['required', 'date']
        ]);
        foreach ($request->type_stages as $ts_id) {
            $typeStage = TypeStage::findOrFail($ts_id);
            $classe = Classe::where('type_stage_id', $typeStage->id)->get();
            $etudiants = Etudiant::where('classe_id', $classe[0]->id)->get();
            if ($typeStage->date_debut_depot || $typeStage->date_limite_depot) {
                Session::flash('message', 'Une session de dépot pour le type de stage ' . $typeStage->nom . ' est déja ouverte');
                return back();
            }
            if ($typeStage->date_debut_depot == null) {
                $date_debut_depot = Carbon::createFromFormat('m/d/Y', $request->date_debut_depot)->format('Y-m-d');
                $date_limite_depot = Carbon::createFromFormat('m/d/Y', $request->date_limite_depot)->format('Y-m-d');
                if ($date_debut_depot > $date_limite_depot) {
                    Session::flash('message', "l'intervalle des dates est invalide");
                    return back();
                }
                $typeStage->date_debut_depot = $date_debut_depot;
                $typeStage->date_limite_depot = $date_limite_depot;
                $current_date = Carbon::now();
                foreach ($etudiants as $etudiant) {

                    $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                        'date_debut_depot' => $date_debut_depot,
                        'date_limite_depot' => $date_limite_depot,
                        'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
                    $etudiant->notify(new SessionDepotOuverteNotification($data));

                }
                $typeStage->update();
            }
        }
        return redirect()->action([TypeStageController::class, 'ts_cette_annee']);
    }

    public function ts_cette_annee()
    {
        $tpStg = new Collection();
        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else {
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        }
        $types_stages = TypeStage::all();
        foreach ($types_stages as $ts) {
            $classe = Classe::findOrFail($ts->classe_id);
            $anneeUni = AnneeUniversitaire::findOrFail($classe->annee_universitaire_id);
            $isMaster_term = ((strtoupper($classe->cycle) === strtoupper('master')) && ($classe->niveau == 2));
            $isLicence_term = ((strtoupper($classe->cycle) === strtoupper('licence')) && ($classe->niveau == 3));
            if ($anneeUni->annee === $annee && ($isMaster_term || $isLicence_term)) {
                $tpStg->push($ts);
            }
        }
        return view('admin.configuration.generale.config_session_depot', compact(['tpStg', 'annee']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TypeStage $session
     * @return \Illuminate\Http\Response
     */
    public function editSession(TypeStage $session)
    {
        //dd($session);
        return view('admin.configuration.generale.modifier_session', ['session' => $session]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeStage $session
     * @return \Illuminate\Http\Response
     */
    public function updateSession(Request $request, TypeStage $session)
    {
        //dd($request->date_debut_depot,$session->date_debut_depot);
        $request->validate([
            'date_debut_depot' => ['required', 'date'],
            'date_limite_depot' => ['required', 'date']
        ]);

        if ($session->date_debut_depot !== $request->date_debut_depot && $session->date_limite_depot !== $request->date_limite_depot) {
            $date_debut_depot = Carbon::createFromFormat('m/d/Y', $request->date_debut_depot)->format('Y-m-d');
            $date_limite_depot = Carbon::createFromFormat('m/d/Y', $request->date_limite_depot)->format('Y-m-d');
            if ($date_debut_depot < $date_limite_depot) {
                $session->date_debut_depot = $date_debut_depot;
                $session->date_limite_depot = $date_limite_depot;
                $session->update();//dd($session);
            } else {
                Session::flash('message', "l'intervalle des dates est invalide");
                return back();
            }
        }
        if ($session->date_debut_depot !== $request->date_debut_depot && $session->date_limite_depot == $request->date_limite_depot) {
            $date_debut_depot = Carbon::createFromFormat('m/d/Y', $request->date_debut_depot)->format('Y-m-d');
            if ($date_debut_depot < $session->date_limite_depot) {
                $session->date_debut_depot = $date_debut_depot;
                $session->update();//dd($session);
            } else {
                Session::flash('message', "l'intervalle des dates est invalide");
                return back();
            }
        }
        if ($session->date_debut_depot == $request->date_debut_depot && $session->date_limite_depot !== $request->date_limite_depot) {
            $date_limite_depot = Carbon::createFromFormat('m/d/Y', $request->date_limite_depot)->format('Y-m-d');
            if ($session->date_debut_periode < $date_limite_depot) {
                $session->date_limite_depot = $date_limite_depot;
                $session->update();//dd($session);
            } else {
                Session::flash('message', "l'intervalle des dates est invalide");
                return back();
            }
        }

        if ($session->date_debut_depot !== $request->date_debut_depot || $session->date_limite_depot !== $request->date_limite_depot) {
            $current_date = Carbon::now();
            $typeStage = TypeStage::findOrFail($session->id);
            $classe = Classe::where('type_stage_id', $typeStage->id)->get();
            //ajouter where('anne_universitaire_id', $anneeActuelle)
            $etudiants = Etudiant::where('classe_id', $classe[0]->id)->get();
            foreach ($etudiants as $etudiant) {
                $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                    'date_debut_depot' => $session->date_debut_depot,
                    'date_limite_depot' => $session->date_limite_depot,
                    'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];
                $etudiant->notify(new SessionDepotModifieNotification($data));
            }
        }
        return  redirect()->action([TypeStageController::class, 'listeSessions']);
    }
    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\TypeStage  $session
     * @return \Illuminate\Http\Response
     */
    public function destroySession(TypeStage  $session)
    {
        $session->date_debut_depot = null;
        $session->date_limite_depot = null;
        $session->update();
        return  redirect()->action([TypeStageController::class, 'listeSessions']);
    }

}
