<?php

namespace App\Exports;

use App\Http\Controllers\TypeStageController;
use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Soutenance;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class SoutenanceParSpecExport implements FromCollection,
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
        return [
            ["Liste des soutenances de " . Classe::find(request()->classe_id)->nom],
            ["CIN", "Nom", "Prénom", "Classe", "Date de la soutenance", "Note finale"]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(20);
                $event->sheet->getDelegate()->getStyle('A2:F2')->getFont()->setSize(13);
            },
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C'=>20,
            'D'=>60,
            'E'=>25,
            'F'=> 15
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
            'A:F'  => ['font' => ['size' => 13]],
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $soutenances = Soutenance::all();
        $stnc = new Collection();

        foreach ($soutenances as $soutenance) {
            $s = array();
            $stage = Stage::find($soutenance->stage_id);
            $type_stage = TypeStage::find($stage->type_stage_id);
            $classe = Classe::find($type_stage->classe_id);

            if ($classe->id == request()->classe_id) {
                $date = Arr::first((TypeStageController::decouper_nom($soutenance->date)));
                $etudiant = Etudiant::find($stage->etudiant_id)->latest()->first();
                $user = User::find($etudiant->user_id);
                $s['CIN'] = $user->numero_CIN;
                $s['Nom'] = ucwords($etudiant->nom);
                $s['Prenom'] = ucwords($etudiant->prenom);
                $s['classe'] = $classe->nom;
                $s['date'] = $date.' à '.$soutenance->start_time;
                $s['note'] = $soutenance->note;
                $stnc->push($s);
            }
        }
        //dd($stnc);
        return $stnc;
    }
}
