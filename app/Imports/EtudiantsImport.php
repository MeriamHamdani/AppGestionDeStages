<?php

namespace App\Imports;

use App\Models\Etudiant;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class EtudiantsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_attr=array("numero_CIN"=>$row[2],
                    "password"=>bcrypt($row[2]));
        dd($row["prenom"]);
       
        $user=User::create($user_attr);
        return new Etudiant([
            'nom'     => $row[0],
            'prenom'    => $row[1],
            'email'=>null,
            'numero_telephone'=>null,
            'user_id'=>$user->id,
            'classe_id'=>null
        ]);
    }
}