<?php

namespace App\Models;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enseignant extends Model
{
    use HasFactory, Notifiable ;
   protected $guarded = [];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function specialites()
    {
        return $this->hasMany(Specialite::class);
    }
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   /* public function soutenances()
    {
        return $this->belongsToMany(Soutenance::class, 'membres_soutenances');
    }*/
    public function soutenances()
    {
        return $this->hasMany(Soutenance::class);
    }

}