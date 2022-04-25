<?php

namespace App\Http\Controllers;

use App\Models\AnneeUniversitaire;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.etablissement.classe.liste_classes',
            ['classes' => Classe::with('specialite')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.etablissement.classe.ajouter_classe');
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
            'code' => ['required', 'string', 'max:255', 'unique:classes'],
            'niveau' => ['required', 'string', 'max:255'],
            'cycle' => ['required', 'string', 'max:255'],
            'specialite_id' => ['required', Rule::exists('specialites', 'id')],
        ]);
        $cls_exist = Classe::where('code', $request->code)->first();
        if ($cls_exist) {
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
                $attributs['annee_universitaire_id'] = $a->id;
                break;
            }
        }
        //dd($attributs);
        $classe=Classe::create($attributs);
        return redirect()->action([ClasseController::class,'index']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function edit(Classe $classe)
    {
        return  view('admin.etablissement.classe.modifier_classe',['classe'=> $classe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $classe)
    {
        $attributs = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255',  Rule::unique('classes','code')->ignore($classe->id)],
            'niveau' => ['required', 'string', 'max:255'],
            'cycle' => ['required', 'string', 'max:255'],
            'specialite_id' => ['required', Rule::exists('specialites', 'id')],
        ]);
        $classe->update($attributs);
        return redirect()->action([ClasseController::class,'index']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect()->action([ClasseController::class,'index']);
    }
}
