<?php

namespace App\Exports;
use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EnseignantToutExport implements FromCollection,WithCustomCsvSettings, WithHeadings, WithEvents,
    WithColumnWidths,
    WithStyles
{
    public function headings(): array
    {
        return [
            ["Liste des enseignants "],
            ["Nom",
                "Prénom" ,
                "Email",
                "Grade",
                "Téléphone"]
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
            'C'=>25,
            'D'=>25,
            'E'=>20,
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
       // dd(request());
        $ens = Enseignant::all();
            $enseignants = new Collection();
            foreach ($ens as $e) {
                $details = array();
                $details['Nom'] = ucwords($e->nom);
                $details['Prénom'] = ucwords($e->prenom);
                $details['Email'] = $e->email;
                $details['Grade'] = ucwords($e->grade);
                $details['Téléphone'] = $e->numero_telephone;
                $enseignants->push($details);
            }
        return $enseignants;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
