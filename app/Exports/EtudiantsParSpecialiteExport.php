<?php

namespace App\Exports;

use App\Http\Controllers\StageController;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Specialite;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EtudiantsParSpecialiteExport implements FromCollection,
    WithCustomCsvSettings,
    WithHeadings,
    WithEvents,
    WithColumnWidths,
    WithStyles
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        $an = Session::get('annee');
        if (isset($an)) {
            $annee = $an->annee;
        } else {
            $annee = StageController::current_annee_univ()->annee;
        }
        return [
            ["Liste des étudiants de specialité " . Specialite::find(request()->specialite_id)->nom . '-' . $annee],
            ["CIN", "Nom", "Prénom", "Email", "Téléphone"]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(20);
                $event->sheet->getDelegate()->getStyle('A2:E2')->getFont()->setSize(13);
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 25,
            'E' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            2 => ['font' => ['italic' => true, 'bold' => true]],

            // Styling an entire column.
            'A:E' => ['font' => ['size' => 13]],
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ann = Session::get('annee'); //dd($ann->id);
        $classes = Classe::where('specialite_id', request()->specialite_id)->get();//dd($classes);
        $etds=new Collection();
        $etds1=new Collection();
        foreach ($classes as $classe) {
            if (isset($ann)) {
                $etds =Etudiant::where('classe_id', $classe->id)
                    ->select('nom', 'prenom', 'email', 'numero_telephone','user_id')
                    ->where('annee_universitaire_id', $ann->id)
                    ->get();
                foreach ($etds as $e) {
                    $etds1->push($e);
                }
            } else {
                $etds-= Etudiant::where('classe_id', $classe->id)
                    ->select('nom', 'prenom', 'email', 'numero_telephone','user_id')
                    ->where('annee_universitaire_id', StageController::current_annee_univ()->id)
                    ->get();
                foreach ($etds as $e) {
                    $etds1->push($e);
                }
            }
        }//dd($etds1);
        $etudiants = new Collection();
        foreach ($etds1 as $e) {//dd($e);
            $details = array();
            $details['CIN'] = ucwords($e->user->numero_CIN);
            $details['Nom'] = ucwords($e->nom);
            $details['Prénom'] = ucwords($e->prenom);
            $details['Email'] = $e->email;
            $details['Téléphone'] = $e->numero_telephone;
            $etudiants->push($details);
        }//dd($etudiants);

        return $etudiants;


    }
}
