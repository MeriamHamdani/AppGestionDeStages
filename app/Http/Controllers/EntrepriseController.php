<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprises=Entreprise::all();

        return view('admin.entreprise.liste_entreprises',compact(['entreprises']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nom' => ['required', 'string', 'max:255','unique:entreprises'],
            'adresse' => ['required', 'string', 'max:255', ],
            'email' => ['required', 'string', 'email', 'max:255'],
            'numero_telephone'=>['required', 'string', 'max:8','min:8'],
            'fax'=>['required', 'string', 'max:8','min:8'],
        ]);
        $entreprise=new Entreprise();
        $entreprise->nom=$request->nom;
        $entreprise->email=$request->email;
        $entreprise->adresse=$request->adresse;
        $entreprise->numero_telephone=$request->numero_telephone;
        $entreprise->fax=$request->fax;
        $entreprise->save();

        return redirect()->action([EntrepriseController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show(Entreprise $entreprise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entreprise,$id)
    {
        $entreprise=Entreprise::findOrFail($id);

        return view('admin.entreprise.modifier_entreprise',compact(['entreprise']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'numero_telephone'=>['required', 'string', 'max:8','min:8'],

        ]);
        $entreprise=Entreprise::findOrFail($id);

        $entreprise->nom=$request->nom;
        $entreprise->email=$request->email;
        $entreprise->adresse=$request->adresse;
        $entreprise->numero_telephone=$request->numero_telephone;


        $entreprise->update();

        return redirect()->action([EntrepriseController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entreprise $entreprise,$id)
    {
        $entreprise=Entreprise::findOrFail($id);
        $entreprise->delete();
        return redirect()->action([EntrepriseController::class, 'index']);
    }

    public function indexEtd()
    {
        return view('etudiant.entreprise.liste_entreprises',
            ['entreprise' => Entreprise::all()]);
    }
    public function createEtd()
    {
        return view('etudiant.entreprise.ajouter_entreprise');
    }

}
