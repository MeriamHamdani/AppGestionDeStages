<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Validation\Rule;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\Session;

class SpecialiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.etablissement.specialite.liste_specialites',
        ['specialites' => Specialite::with('departement','enseignant',)->get()]); //with('deparetement')->get()
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.etablissement.specialite.ajouter_specialite');
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
            'nom' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'cycle' => ['required', 'string', 'max:255'],
            'departement_id' => ['required', Rule::exists('departements', 'id')],
            'enseignant_id' => [ Rule::exists('enseignants', 'id')],

        ]);

        $spec_exist = Specialite::where('code', $request->code)->exists();
        if (!$spec_exist) {
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
                    $attributs['annee_universitaire_id'] = $a->id;
                    break;
                }
            }
            $specialite=Specialite::create($attributs);
            Session::flash('message', 'ok');
        }else{
            Session::flash('message', 'ko');
        }
        return redirect()->action([SpecialiteController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function show(Specialite $specialite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialite $specialite)
    {
        return  view('admin.etablissement.specialite.modifier_specialite',['specialite'=> $specialite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialite $specialite)
    {
        $attributs = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', Rule::unique('specialites','code')->ignore($specialite->id)],
            'cycle' => ['required', 'string', 'max:255'],
            'departement_id' => ['required', Rule::exists('departements', 'id')],
            'enseignant_id' => ['required', Rule::exists('enseignants', 'id')],

        ]);
        $specialite->update($attributs);
        Session::flash('message', 'update');

        return redirect()->action([SpecialiteController::class,'index']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialite $specialite)
    {
        $specialite_id=$specialite->id;
        $classes=Classe::where('specialite_id',$specialite_id)->get();
        foreach($classes as $classe){
            $classe->specialite_id=null;
            $classe->save();
            //$classe->update(['specialite_id'=>null]);
        }
        $specialite->delete();
        return redirect()->action([SpecialiteController::class,'index']);




    }
}