<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Stage;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\TypeStage;
use App\Models\Soutenance;
use App\Models\Specialite;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class SoutenanceParSpecExport implements FromCollection
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
            ["Liste des soutenances de specialité ". Specialite::find(request()->specialite_id)->nom],
            ["CIN","Nom", "Prenom" ,"classe","Date de la soutenance","note finale"]
            ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $soutenances=Soutenance::all();
        $stnc=new Collection();
        
        foreach($soutenances as $soutenance){
            $s=array();
            $stage=Stage::find($soutenance->stage_id);
            $type_stage=TypeStage::find($stage->type_stage_id);
            $classe=Classe::find($type_stage->classe_id);
            
            if($classe->specialite_id==request()->specialite_id){
                $etudiant=Etudiant::find($stage->etudiant_id);
                $user=User::find($etudiant->user_id);
                $s['CIN']=$user->numero_CIN;
                $s['Nom']=$etudiant->nom;
                $s['Prenom']=$etudiant->prenom;
                $s['classe']=$classe->nom;
                $s['date']=$soutenance->date;
                $s['note']=$soutenance->note;
                
                $stnc->push($s);
            }
            
        }
        //dd($stnc);
        return $stnc;
    }
}