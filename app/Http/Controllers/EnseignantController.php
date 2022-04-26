<?php

namespace App\Http\Controllers;

use App\Models\AnneeUniversitaire;
use App\Models\Enseignant;
use App\Models\Etablissement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.etablissement.enseignant.liste_enseignants',
            ['enseignants' => Enseignant::with('user','departement')->get()]);//with('departement')->get()
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.etablissement.enseignant.ajouter_enseignant');
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
            ['numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users']
        ]);

        $attributs['password'] = bcrypt($attributs['numero_CIN']);
        $attributs['is_active'] = 0;
        /* $user = User::create($attributs);
         $user->assignRole('enseignant');*/

        $attributs2 = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required','email','max:255',Rule::unique('enseignants','email')],
            'grade' => 'required',
            'rib' => 'required',
            'identifiant' => ['required','max:255',Rule::unique('enseignants','identifiant')],
            'departement_id' => ['required', Rule::exists('departements', 'id')]
        ]);
        $ens_exist = Enseignant::where('email', $request->email)->first();
        if ($ens_exist) {
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
        $attributs2['etablissement_id'] = Etablissement::first()->id;
        $user = User::create($attributs);
        $user->assignRole('enseignant');
        $attributs2['user_id'] = $user->id;
        $enseignant = Enseignant::create($attributs2);
        return redirect()->action([EnseignantController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show(Enseignant $enseignant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */
    public function edit(Enseignant $enseignant)
    {
        return  view('admin.etablissement.enseignant.modifier_enseignant', ['enseignant'=> $enseignant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enseignant $enseignant)
    {
        $attributs = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required','email','max:255',Rule::unique('enseignants','email')->ignore($enseignant->id)],
            'grade' => 'required',
            'rib' => 'required',
            'identifiant' => ['required','max:255',Rule::unique('enseignants','identifiant')->ignore($enseignant->id)],
            'departement_id' => ['required', Rule::exists('departements', 'id')]
        ]);
        if($enseignant->user->numero_CIN !==$request->numero_CIN){
            $request->validate(['numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users'],]);
            $enseignant->user->numero_CIN=$request->numero_CIN;
            $enseignant->user->password= bcrypt($request->numero_CIN);
            $enseignant->user->update();
        }
        $enseignant->update($attributs);
        return redirect()->action([EnseignantController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Enseignant $enseignant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enseignant $enseignant)
    {
        $user_id = $enseignant->user_id;
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect()->action([EnseignantController::class,'index']);
    }
}
