<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmerEncadrement;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Enseignant;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use App\Models\Etablissement;
use App\Notifications\DemandeEncadrementNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enseignants = Enseignant::all();
        $entreprises = Entreprise::all();

        //$etudiant = (Etudiant::with('user')->where('user_id', Auth::user()->id))->first();

        $etudiant = (Etudiant::where('user_id', Auth::user()->id)->select('*'))->first();
        $classe = Classe::findOrFail($etudiant->classe_id);

        $type_stage = TypeStage::findOrFail($classe->type_stage_id);
        $fiche_demande = substr($type_stage->fiche_demande, 15);


        return view('etudiant.stage.demander_stage', compact(['enseignants', 'entreprises', 'etudiant', 'fiche_demande', 'type_stage']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre_sujet' => ['required', 'string', 'max:255'],
            //'type_sujet'=>['required','string','max:255'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
            'fiche_demande' => ['required'],
            'fiche_demande.*' => ['required', 'mimes:pdf,jpg,png,jpeg']

        ]);

        $stage = new Stage();
        $stage->titre_sujet = $request->titre_sujet;
        $etudiant = Etudiant::where('user_id', Auth::user()->id)->first();
        $stage->etudiant_id = $etudiant->id;

        if ($etudiant->classe->niveau == 3 && $etudiant->classe->cycle == "licence")
        {
            $request->validate(['type_sujet' => ['required']]);
            $stage->type_sujet = $request->type_sujet;

        }

        if ($etudiant->classe->niveau == 3 && $etudiant->classe->cycle == "licence" || $etudiant->classe->niveau == 2 && $etudiant->classe->cycle == "master")
        {
            $request->validate(['enseignant_id' => ['required']]);
            $stage->enseignant_id = $request->enseignant_id;
            $enseignant = Enseignant::findOrFail($request->enseignant_id);
        }

        $entreprise = Entreprise::findOrFail($request->entreprise);
        $stage->entreprise_id = $entreprise->id;

        $current_date = Carbon::now();
        $stage->date_demande = $current_date->format('Y-m-d');;

        $moisCourant = (int)$current_date->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12))
        {
            $annee = '20' . $current_date->format('y') . '-20' . strval(((int)$current_date->format('y')) + 1);
        }
        else
            $annee = '20' . strval(((int)$current_date->format('y')) - 1) . '-20' . $current_date->format('y');
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a)
        {
            if ($a->annee == $annee)
            {
                $stage->annee_universitaire_id = $a->id;
                // dd($stage->annee_universitaire_id);
                break;
            }
        }

        $classe = Classe::findOrFail($etudiant->classe_id);
        $type_stage = TypeStage::findOrFail($classe->type_stage_id);

        $date_debut = Carbon::createFromFormat('m/d/Y', $request->date_debut)->format('Y-m-d');
        $date_fin = Carbon::createFromFormat('m/d/Y', $request->date_fin)->format('Y-m-d');

        //dd($date_debut<$type_stage->date_debut_periode);
        if ($request->date_debut < $request->date_fin)
        {

            if ($date_debut < $type_stage->date_debut_periode || $date_fin > $type_stage->date_limite_periode)
            {
                return Redirect::back()->withErrors(['La période de votre stage est hors limite !']);
            }
            else
            {
                $stage->date_debut = $date_debut;
                $stage->date_fin = $date_fin;
            }

        }
        else
        {
            return Redirect::back()->withErrors(['La date de fin de votre période de stage doit etre ultérieure à la date de debut !      !']);
        }

        $stage->confirmation_admin = 0;
        $fiche_demande_nom = $request->fiche_demande->getClientOriginalName();
        //dd($fiche_demande_nom);
        $stage->fiche_demande = $request->fiche_demande;
        $path = Storage::disk('public')
            ->putFileAs('fiches_demandes_scannees', $request->file('fiche_demande'), $fiche_demande_nom);
        $stage->fiche_demande = $path;
        $stage->save();

            if ($etudiant->classe->niveau == 3 && $etudiant->classe->cycle == "licence" || $etudiant->classe->niveau == 2 && $etudiant->classe->cycle == "master")
            {
                $data = ['nom_etud' => ucwords($etudiant->nom . ' ' . $etudiant->prenom),
                    'classe_etud' => $classe->nom,
                    'nom_ens' => $enseignant->nom . ' ' . $enseignant->prenom,
                    'etablissement' => Etablissement::findOrFail($enseignant->etablissement_id)->nom,
                'date' => 'Le ' . $current_date->day . '-' . $current_date->month . '-' . $current_date->year . ' à ' . $current_date->hour . ':' . $current_date->minute];

            $enseignant->notify(new DemandeEncadrementNotification($data));
            }
        return redirect()->action([StageController::class, 'create']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Stage $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        //
    }
}
