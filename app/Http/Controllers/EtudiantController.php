<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Exports\EtudiantsExport;
use App\Imports\EtudiantsImport;
use App\Models\AnneeUniversitaire;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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
        $user->delete();
        return redirect()->action([EtudiantController::class,'index']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_via_csv(Request $request){

        $request->validate([
            "classe_id"=>['required'],
            "liste_etudiants"=>['required'],
            "liste_etudiants.*"=>['required','mimes:csv']
        ]);
        $classe=Classe::findOrFail($request->classe_id);
        $liste_name='etudiants_'.$classe->code.'_'.($this->current_annee_univ())->annee.'.csv';

        $path = Storage::disk('public')
                        ->putFileAs('listes_etudiants', $request->file('liste_etudiants'),$liste_name);



        $chemin_abs='C:/laragon/www/AppGestionDeStages/public/storage/'.$path;
        //dd( $chemin_abs);
        //$openfile = fopen($chemin_abs, "r");

        //$cont = fread($openfile, filesize($chemin_abs));
        $handle = fopen($chemin_abs, "r");

$lineNumber = 1;$i=0;
while (($raw_string = fgets($handle)) !== false) {
    if($i>0)
    {$row = str_getcsv($raw_string);
        $attr_user=array("numero_CIN"=>$row[2],"password"=>bcrypt($row[1]));
        $user=User::create($attr_user);
        $user->assignRole('etudiant');
        $attr_etd=array("nom"=>$row[0],"prenom"=>$row[1],"classe_id"=>$request->classe_id,"user_id"=>$user->id,"annee_universitaire_id"=>$this->current_annee_univ()->id);
        Etudiant::create($attr_etd);
        //dd($row);
        $lineNumber++;
        }else $i++;
    }
    fclose($handle);
        //dd(readfile($chemin_abs));
        return redirect()->action([EtudiantController::class,'index']);
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
}