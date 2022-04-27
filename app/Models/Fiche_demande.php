<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche_demande extends Model
{
    use HasFactory;
    public function typeStage()
    {
        return $this->belongsTo(TypeStage::class);
    }
}