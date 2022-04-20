<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
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
        return view('admin.etablissement.departement.ajouter_departement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message="";
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:departements'],
        ]);
        $mydate = Carbon::now();
        //dd( $mytime->toDateString());
        $moisCourant=(int)$mydate->format('m');
        //dd($moisCourant);
        if(( 6 < $moisCourant)&&($moisCourant < 12)){
            $annee='20'.$mydate->format('y').'-20'.strval(((int)$mydate->format('y'))+1);
        }else $annee='20'.strval(((int)$mydate->format('y'))-1).'-20'.$mydate->format('y');
    $annees=AnneeUniversitaire::all();
    //dd($annees);
    if (!(Departement::where('code', '=', $request->code)->exists())) {
            $departement=new Departement();
        foreach($annees as $a){
            if($a->annee==$annee){
            $departement->annee_universitaire_id=$a->id;
            break;}
        }
        $departement->code=$request->code;
        $departement->nom=$request->nom;
        $departement->save();
     }

        return redirect()->action([DepartementController::class, 'showAll']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {

        $departements=Departement::all();

    return view('admin.etablissement.departement.liste_departements', compact(['departements']));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement,$id)
    {

        $departement=Departement::findOrFail($id);
        //dd($departement);

        return view('admin.etablissement.departement.modifier_departement', compact(['departement']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement,$id)
    {
        $departement=Departement::findOrFail($id);
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:departements'],
        ]);
        $departement->code=$request->code;
        $departement->nom=$request->nom;
//dd($departement);
        $departement->update();
        return redirect()->action([DepartementController::class, 'showAll']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        //
    }
}