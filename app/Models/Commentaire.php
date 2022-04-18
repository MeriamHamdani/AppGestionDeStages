<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    public function depotMemoire()
    {
        return $this->belongsTo(DepotMemoire::class);
    }
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
