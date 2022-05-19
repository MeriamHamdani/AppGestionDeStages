<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;

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
        return view('admin.etablissement.etudiant.liste_etudiants',
            ['etudiants' => Etudiant::with('user','classe')->get()]);//with('classe')->get()
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
        $attributs = $request->validate(
            ['numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users']
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
        $attributs['email'] = $request->email;
        $etd_exist = Etudiant::where('email', $request->email)->first();
        if ($etd_exist) {
            return back();
        }

        $annee=$this->current_annee_univ();

        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a)
        {//dd($a->annee);
            if ($a->annee == $annee->annee)
            {
                $attributs2['annee_universitaire_id'] = $annee->id;
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
        if($etudiant->user->numero_CIN !==$request->numero_CIN){
            $request->validate(['numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users'],]);
            $etudiant->user->numero_CIN=$request->numero_CIN;
            $etudiant->user->password= bcrypt($request->numero_CIN);
            $etudiant->user->update();
        }
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
        $stages=Stage::where('etudiant_id',$etudiant->id)->get();
        foreach($stages as $stage)
        {
            $stage->delete();
        }
        $user->delete();
        return redirect()->action([EtudiantController::class,'index']);

    }
    public function editProfil (Etudiant $etudiant)
    {
        $user_id = auth()->id();
        $etudiant = Etudiant::where('user_id',$user_id)->first();
        //dd($etudiant->user->numero_CIN);
        return view('etudiant.profil.editProfil',['etudiant'=>$etudiant]);
    }
    public function updateProfil (Request $request, Etudiant $etudiant)
    {
        $user_id = auth()->id();
        $etudiant = Etudiant::where('user_id',$user_id)->first();
        $attributs = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'numero_telephone' => 'required|max:11|min:8',
            'email' => ['required','email','max:255',Rule::unique('etudiants','email')->ignore($etudiant->id)]
        ]);
        $etudiant->update($attributs);
        return redirect()->action([EtudiantController::class,'editProfil']);
    }

    public function importData ()
    {
        Excel::import(new EtudiantsImport, request()->file('liste_etudiants')->store('temp'));
        //dd(request());
        return redirect()->action([EtudiantController::class,'index']);
    }
    public function exportData()
    {
        return Excel::download(new EtudiantsExport, 'liste-etudiants.xlsx');
    }
    public function exportDataBySpec(Request $request)
    {
        return Excel::download(new EtudiantsParSpecialiteExport, 'liste-etudiants_par_spec.xlsx');
    }

    public function current_annee_univ(){

        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee ='20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else {
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        }
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a)
        {
            if ($a->annee == $annee)
            {
                return  $a;

            }
        }

    }

    public function export(){
        return Excel::download(new EtudiantsExport, 'etudiants.csv');
    }

    public function mes_demandes_stages(){
        $etudiant=Etudiant::where('user_id',Auth::user()->id)->get()[0];
        $mes_demandes=Stage::where('etudiant_id',$etudiant->id)->get();
		$demandes_classes=new Collection();
		foreach($mes_demandes as $demande){
			$classe=Classe::where('id',$etudiant->classe_id)
						  ->where('annee_universitaire_id',$demande->annee_universitaire_id)->get()[0];


		    $typeStage=TypeStage::find($classe->typeStage->id);

            $type = $typeStage->nom;
			$demande->type=$type;


			$demandes_classes->push($demande);
		}
//dd($demandes_classe);
        return view('etudiant.stage.demandes_stages',compact('demandes_classes'));
    }

	public function mes_demandes_confirmer(){
		$etudiant=Etudiant::where('user_id',Auth::user()->id)->get()[0];
		$demandes_confirmer=Stage::where('etudiant_id',$etudiant->id)
									->where('confirmation_admin',1)->get();
		$demandes_classes=new Collection();
		foreach($demandes_confirmer as $demande){
			$classe=Classe::where('id',$etudiant->classe_id)
						  ->where('annee_universitaire_id',$demande->annee_universitaire_id)->get()[0];
			$typeStage=$classe->typeStage;

            $type = $typeStage->nom;
			$demande->type=$type;


			$demandes_classes->push($demande);


		}

		return view('etudiant.stage.liste_stages',compact('demandes_confirmer'));
	}
}