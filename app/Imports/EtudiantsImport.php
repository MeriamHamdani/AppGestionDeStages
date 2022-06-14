<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class EtudiantsImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 3;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
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
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        $classe_id = request()->classe_id;
        $numCinExcel = $row[3];
        $length = Str::length($numCinExcel);
        if ( $length == 6)
        {
            $row[3] = '00'.$numCinExcel;
        }
        elseif ($length == 7)
        {
            $row[3] = '0'.$numCinExcel;
        }
        elseif ($length == 8)
        {
            $row[3] = $numCinExcel;
        }
        $attributs = [
            'numero_CIN'     => $row[3],
            'password' => bcrypt($row[3]),
            'email'=>$row[2],
            'is_active' => '0' ];

        $attributs2 = [
            'nom'=>$row[0],
            'prenom'=>$row[1],
            'email'=>$row[2],
            'classe_id'=> $classe_id
        ];
        $user_exist = User::where('numero_CIN',$row[3])->exists();
        $etd_cette_annee=0;
        if($user_exist){
            $user=User::where('numero_CIN',$row[3])->get()[0];

                $etudiants=Etudiant::where('user_id',$user->id)->get();

                foreach($etudiants as $etudiant){

					$year=AnneeUniversitaire::findOrFail($etudiant->annee_universitaire_id);
                   
                    if($year->annee == $this->current_year()){
						$etd_cette_annee=1;
					}
                }
        }
        if ( !$user_exist || $etd_cette_annee==0) {
            $annee=$this->current_annee_univ();

            $annees = AnneeUniversitaire::all();
            foreach ($annees as $a)
            {
                if ($a->annee == $annee->annee)
                {
                    $attributs2['annee_universitaire_id'] = $annee->id;
                    break;
                }
            }

            if(!$user_exist){
                $user = User::create($attributs);
                $user->assignRole('etudiant');
            }else{
                $user=User::where('numero_CIN',$row[3])->get()[0];
            }
            $attributs2['numero_telephone']="-----";
            $attributs2['user_id'] = $user->id;
            $attributs2['classe_id']=$classe_id;
            Session::flash('message', 'ok1');
                return Etudiant::create($attributs2);
            
        }   
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
}