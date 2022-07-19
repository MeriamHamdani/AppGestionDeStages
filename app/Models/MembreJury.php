<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembreJury extends Model
{
    use HasFactory;
    public function soutenances()
    {
        return $this->belongsToMany(Soutenance::class, 'membres_soutenances');
    }
}