<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

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
        $etd_exist = Etudiant::where('email', $attributs2['email'])->first();
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

        $attributs2['numero_telephone']="-----";

        $user = User::create($attributs);
        $user->assignRole('etudiant');
        $attributs2['user_id'] = $user->id;
        return Etudiant::create($attributs2);
    }
}
