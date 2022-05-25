<?php

namespace App\Imports;

use App\Models\AnneeUniversitaire;
use App\Models\Departement;
use App\Models\Enseignant;
use App\Models\Etablissement;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;


class EnseignantsImport implements ToModel, WithStartRow, WithCustomCsvSettings
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
        //dd(request()->departement_id);
        $dep_id = request()->departement_id;
        $numCinExcel = $row[0];
        $length = Str::length($numCinExcel);
        if ( $length == 6)
        {
            $row[0] = '00'.$numCinExcel;
        }
        elseif ($length == 7)
        {
            $row[0] = '0'.$numCinExcel;
        }
        elseif ($length == 8)
        {
            $row[0]=$numCinExcel;
        }
        $attributs = [
            'numero_CIN'     => $row[0],
            'email'=>  $row[3],
            'password' => bcrypt($row[0]),
            'is_active' => '0' ];

        $attributs2 = [
            'nom'=>$row[1],
            'prenom'=>$row[2],
            'email'=>$row[3],
            'identifiant'=>$row[4],
            'departement_id'=> $dep_id
        ];
        $ens_exist = Enseignant::where('email', $attributs2['email'])->first();
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
        $attributs2['numero_telephone']="-----";
        $attributs2['grade']="-----";
        $attributs2['rib']="-----";
        $user = User::create($attributs);
        $user->assignRole('enseignant');
        $attributs2['user_id'] = $user->id;
        return Enseignant::create($attributs2);
    }
}
