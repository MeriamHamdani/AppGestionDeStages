<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }


}
