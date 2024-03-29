<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Exports\EtudiantsExport;
use App\Imports\EtudiantsImport;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\EtudiantsParSpecialiteExport;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ann = Session::get('annee'); //dd($ann->id);
        if (isset($ann)) {
            $etudiants = Etudiant::with('user', 'classe')->where('annee_universitaire_id', $ann->id)->get();
            return view('admin.etablissement.etudiant.liste_etudiants',
                ['etudiants' => $etudiants,
                    'year' => $this->current_year()]);
        }
        $an = AnneeUniversitaire::where('annee', $this->current_year())->first();
        $etudiants = Etudiant::with('user', 'classe')->where('annee_universitaire_id', $an->id)->get();
        return view('admin.etablissement.etudiant.liste_etudiants',
            ['etudiants' => $etudiants,
                'year' => $this->current_year()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.etablissement.etudiant.ajouter_etudiant');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributs = $request->validate(
            ['numero_CIN' => ['required', 'string', 'max:8', 'min:8']
            ]);

        $attributs['password'] = bcrypt($attributs['numero_CIN']);
        $attributs['is_active'] = 0;

        $attributs2 = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required', 'email', 'max:255'],
            'classe_id' => ['required', Rule::exists('classes', 'id')]
        ]);
        $attributs['email'] = $request->email;

        $user_exist = User::where('numero_CIN', $request->numero_CIN)->exists();
        $etd_cette_annee = 0;

        if ($user_exist) {

            $user = User::where('numero_CIN', $request->numero_CIN)->get()[0];

            $etudiants = Etudiant::where('user_id', $user->id)->get();

            foreach ($etudiants as $etudiant) {

                $year = AnneeUniversitaire::findOrFail($etudiant->annee_universitaire_id);

                if ($year->annee == $this->current_year()) {
                    $etd_cette_annee = 1;
                }
            }
        }
        if (!$user_exist || $etd_cette_annee == 0) {
            $annee = $this->current_annee_univ();

            $annees = AnneeUniversitaire::all();
            foreach ($annees as $a) {
                if ($a->annee == $annee->annee) {
                    $attributs2['annee_universitaire_id'] = $annee->id;
                    break;
                }
            }

            if (!$user_exist) {
                $user = User::create($attributs);
                $user->assignRole('etudiant');
            } else {
                $user = User::where('numero_CIN', $request->numero_CIN)->get()[0];
            }

            $attributs2['user_id'] = $user->id;
            $etudiant = Etudiant::create($attributs2);
            $user->email = $etudiant->email;
            $user->update();
            Session::flash('message', 'ok1');
        } else {
            Session::flash('message', 'ko1');
        }
        return redirect()->action([EtudiantController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        return view('admin.etablissement.etudiant.modifier_etudiant', ['etudiant' => $etudiant]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $attributs = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required', 'email', 'max:255', Rule::unique('etudiants', 'email')->ignore($etudiant->id)],
            'classe_id' => ['required', Rule::exists('classes', 'id')]
        ]);
        if ($etudiant->user->numero_CIN !== $request->numero_CIN) {
            $request->validate(['numero_CIN' => ['required', 'string', 'max:8', 'min:8', 'unique:users'],]);
            $etudiant->user->numero_CIN = $request->numero_CIN;
            $etudiant->user->update();
        }
        $etudiant->update($attributs);
        Session::flash('message', 'update1');
        return redirect()->action([EtudiantController::class, 'index']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        $user_id = $etudiant->user_id;
        $user = User::findOrFail($user_id);
        $stages = Stage::where('etudiant_id', $etudiant->id)->get();
        foreach ($stages as $stage) {
            $stage->delete();
        }
        $user->delete();
        return redirect()->action([EtudiantController::class, 'index']);

    }

    public function editProfil(Etudiant $etudiant)
    {
        $user_id = auth()->id();
        $etudiant = Etudiant::where('user_id', $user_id)->first();

        return view('etudiant.profil.editProfil', ['etudiant' => $etudiant]);
    }

    public function updateProfil(Request $request, Etudiant $etudiant)
    {
        $user_id = auth()->id();
        $etudiant = Etudiant::where('user_id', $user_id)->first();

        $attributs = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required', 'email', 'max:255', Rule::unique('etudiants', 'email')->ignore($etudiant->id)]
        ]);
        $etudiant->update($attributs);
        return redirect()->action([EtudiantController::class, 'mes_demandes_stages']);
    }


    public function importData()
    {

        Excel::import(new EtudiantsImport, request()->file('liste_etudiants')->store('temp'));

        return redirect()->action([EtudiantController::class, 'index']);
    }


    public function exportData()
    {
        if (isset(request()->classe_id)){
            $cls = Classe::find(request()->classe_id)->code;
            return Excel::download(new EtudiantsExport, 'liste-etudiants-'.$cls.'.xlsx');
        }
    }

    public function exportDataBySpec()
    {
        if (isset(request()->specialite_id)) {
            $spec = Specialite::find(request()->specialite_id)->code;
            return Excel::download(new EtudiantsParSpecialiteExport, 'liste-etudiants-'.$spec.'.xlsx');
        }
    }

    public function current_annee_univ()
    {

        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else {
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        }
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a) {
            if ($a->annee == $annee) {
                return $a;

            }
        }

    }

    static function current_year()
    {

        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else {
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        }
        return $annee;

    }

    public function export()
    {
        return Excel::download(new EtudiantsExport, 'etudiants.csv');
    }

    public function mes_demandes_stages()
    {
        $etudiants = Etudiant::where('user_id', Auth::user()->id)->get();
        $current_date = Carbon::now();
        $demandes_classes = new Collection();
        foreach ($etudiants as $etudiant) {
            $mes_demandes = Stage::where('etudiant_id', $etudiant->id)->get();
            foreach ($mes_demandes as $demande) {
                $classe = Classe::where('id', $etudiant->classe_id)->first();
                $typeStage = TypeStage::find($classe->typeStage->id);
                $type = $typeStage->nom;
                $demande->type = $type;
                $demandes_classes->push($demande);
            }
        }
        return view('etudiant.stage.demandes_stages', compact('demandes_classes', 'current_date'));
    }

    public function mes_demandes_confirmer()
    {
        $etudiants = Etudiant::where('user_id', Auth::user()->id)->get();
        $demandes_confirmes = new Collection();
        foreach ($etudiants as $etudiant) {
            $demandes_confirmer = Stage::where('etudiant_id', $etudiant->id)
                ->where('confirmation_admin', 1)->get(); //dd($demandes_confirmer);
            $current_date = Carbon::now();
            foreach ($demandes_confirmer as $demande) {
                $classe = Classe::where('id', $etudiant->classe_id)->first();//dd($classe);
                $typeStage = $classe->typeStage;
                $type = $typeStage->nom;
                $demande->type = $type;
                $demandes_confirmes->push($demande);
            }
        }//dd($demandes_confirmes);
        return view('etudiant.stage.liste_stages', compact('demandes_confirmes', 'current_date'));
    }
}