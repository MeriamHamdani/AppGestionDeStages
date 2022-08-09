<?php

namespace App\Exports;

use App\Http\Controllers\StageController;
use App\Models\Classe;
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

class DepotsExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithEvents,
    WithColumnWidths,
    WithStyles
{
    public function headings(): array
    {
        return [
            ["Liste des Mémoires déposés de la classe " . Classe::find(request()->classe_id)->nom],
            ["Titre de sujet",
                "Etudiant",
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
                $event->sheet->getDelegate()->getStyle('A2:D2')->getFont()->setSize(13);
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 60,
            'B' => 30,
            'C' => 30,
            'D' => 30,
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
            'A:D' => ['font' => ['size' => 13]],
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
        $demandesDepotParClas = new Collection();
        foreach ($demandesDepot as $d) {
            if ($d->stage->etudiant->classe_id == request()->classe_id) {
                $demandesDepotParClas->push($d);
            }
        }
        $memoires = new Collection();
        foreach ($demandesDepotParClas as $dem) {
            $d = array();
            $d['Titre de sujet'] = $dem->stage->titre_sujet;
            $d['Etudiant'] = ucwords($dem->stage->etudiant->nom . ' ' . $dem->stage->etudiant->prenom);
            $d['Encadrant'] = ucwords($dem->stage->enseignant->nom . ' ' . $dem->stage->enseignant->prenom);
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
