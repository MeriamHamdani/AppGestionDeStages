<?php

namespace App\Exports;
use App\Http\Controllers\StageController;
use App\Models\DepotMemoire;
use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DepotsToutExport implements FromCollection,WithCustomCsvSettings, WithHeadings, WithEvents,
    WithColumnWidths,
    WithStyles
{
    public function headings(): array
    {
        return [
            ["Liste des Mémoires déposés "],
            ["Titre de sujet",
                "Etudiant" ,
                "Classe",
                "Encadrant",
                "Date de dépôt"]
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
            'A' => 60,
            'B' => 30,
            'C'=>18,
            'D'=>30,
            'E'=>30,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            2 => ['font' => ['italic' => true, 'bold' => true]],

            // Styling an entire column.
            'A:E'  => ['font' => ['size' => 13]],
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ann = Session::get('annee');
        if (isset($ann)) {
            $annee = $ann;
        } else {
            $annee = StageController::current_annee_univ();
        }
        $demandesDepot = DepotMemoire::with('stage')->where('annee_universitaire_id', $annee->id)->get();
           // dd($demandesDepot);
            $memoires = new Collection();
            foreach ($demandesDepot as $dem) {
                $d = array();
                $d['Titre de sujet'] = $dem->stage->titre_sujet;
                $d['Etudiant'] = ucwords($dem->stage->etudiant->nom.' '.$dem->stage->etudiant->prenom);
                $d['Classe'] = $dem->stage->etudiant->classe->code;
                $d['Encadrant'] =ucwords($dem->stage->enseignant->nom.' '.$dem->stage->enseignant->prenom);
                $d['Date de dépôt'] = $dem->date_depot;
                $memoires->push($d);
            }
        return $memoires;

    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
