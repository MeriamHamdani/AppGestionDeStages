<?php

namespace App\Http\Controllers;

use App\Models\AnneeUniversitaire;
use App\Models\Etablissement;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.etablissement.etudiant.liste_etudiants',  ['etudiants' => Etudiant::with('classe')->get()]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributs = $request->validate([
            'numero_CIN' => 'required|max:8',
        ]);

        $attributs['password'] = bcrypt($attributs['numero_CIN']);
        $attributs['is_active'] = 0;

        $attributs2 = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required','email','max:255',Rule::unique('etudiants','email')],
            'classe_id' => ['required', Rule::exists('classes', 'id')]
        ]);
        $etd_exist = Etudiant::where('email', $request->email)->first();
        if ($etd_exist) {
            return back();
        }
        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12))
        {
            $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a)
        {
            if ($a->annee == $annee)
            {
                $attributs2['annee_universitaire_id'] = $a->id;
                break;
            }
        }
        //dd($attributs2['annee_universitaire_id']);
        $user = User::create($attributs);
        $user->assignRole('etudiant');
        $attributs2['user_id'] = $user->id;
        $etudiant = Etudiant::create($attributs2);
        return redirect()->action([EtudiantController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        return  view('admin.etablissement.etudiant.modifier_etudiant', ['etudiant'=> $etudiant]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $attributs = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required','email','max:255',Rule::unique('etudiants','email')->ignore($etudiant->id)],
            'classe_id' => ['required', Rule::exists('classes', 'id')]
        ]);
        $etudiant->update($attributs);
        return redirect()->action([EtudiantController::class,'index']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        $user_id = $etudiant->user_id;
        $user = User::findOrFail($user_id);
        $user->delete();
        $etudiant->delete();
        return redirect()->action([EtudiantController::class,'index']);

    }
}
