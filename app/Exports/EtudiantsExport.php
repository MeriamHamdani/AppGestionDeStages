<?php

namespace App\Exports;

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
        return ["nom", "prenom","numero_CIN","email","numero_telephone"];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Etudiant::select("nom", "prenom","numero_CIN","email","numero_telephone")->get();
        //return Etudiant::all();
    }
}