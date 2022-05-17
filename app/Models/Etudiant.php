<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Enseignant;
use App\Models\AnneeUniversitaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}