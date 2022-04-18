<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CahierStage extends Model
{
    use HasFactory;

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
