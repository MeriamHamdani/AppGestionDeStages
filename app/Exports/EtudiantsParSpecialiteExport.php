<?php

namespace App\Exports;

use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Specialite;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class EtudiantsParSpecialiteExport implements FromCollection
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return [
            ["Liste des étudiants de specialité ". Specialite::find(request()->specialite_id)->nom],
            ["Nom", "Prénom" ,"Email","Téléphone"]
            ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $classes=Classe::where('specialite_id',request()->specialite_id)->get();
        //dd($classes);
        $etudiants=new Collection();
        foreach ($classes as $classe){
            /*dd(Etudiant::where('classe_id', $classe->id)
            ->select('nom','prenom','email','numero_telephone')
            ->get());*/
            $etudiants->push(Etudiant::where('classe_id', $classe->id)
            ->select('nom','prenom','email','numero_telephone')
            ->get());
            
            /*return Etudiant::where('classe_id', $classe->id)
                ->select('nom','prenom','email','numero_telephone')
                ->get();*/
        }
        //dd($etudiants);
        return $etudiants;
       
       
    }
}