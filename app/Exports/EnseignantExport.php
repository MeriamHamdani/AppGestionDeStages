<?php

namespace App\Exports;

use App\Models\Departement;
use App\Models\Enseignant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class EnseignantExport implements FromCollection,WithCustomCsvSettings, WithHeadings
{
    public function headings(): array
    {
        return [
            ["Liste des enseignants de département ". Departement::find(request()->departement_id)->nom],
            ["Nom", "Prénom" ,"Email","Grade","Téléphone"]
            ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // dd(request());
        return Enseignant::where('departement_id', request()->departement_id)
            ->select('nom','prenom','email','grade','numero_telephone')
            ->get();
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}