<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
