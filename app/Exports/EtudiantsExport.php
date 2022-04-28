<?php

namespace App\Exports;

use App\Models\Classe;
use App\Models\Etudiant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class EtudiantsExport implements FromCollection, WithCustomCsvSettings, WithHeadings
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
            ["Liste des etudiants de classe ". Classe::find(request()->classe_id)->nom],
            ["Nom", "Prénom" ,"Email","Téléphone"]
            ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return Etudiant::where('classe_id', request()->classe_id)
        ->select('nom','prenom','email','numero_telephone')
        ->get();
       
    }
}