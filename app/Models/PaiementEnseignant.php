<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementEnseignant extends Model
{
    use HasFactory;
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
