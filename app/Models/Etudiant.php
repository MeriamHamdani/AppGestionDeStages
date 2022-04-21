<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Enseignant;
use App\Models\AnneeUniversitaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'numero_telephone',
        'email',
        'user_id'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
    public function annee_universitaire()
    {
        return $this->belongsTo(AnneeUniversitaire::class);
    }

}