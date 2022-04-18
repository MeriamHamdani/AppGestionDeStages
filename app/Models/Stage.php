<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
    public function cahierStage()
    {
        return $this->hasOne(CahierStage::class);
    }
    public function depotMemoire()
    {
        return $this->hasOne(DepotMemoire::class);
    }
    public function soutenance()
    {
        return $this->hasOne(Soutenance::class);
    }

}
