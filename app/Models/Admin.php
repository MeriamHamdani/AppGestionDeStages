<?php

namespace App\Models;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom','email','numero_telephone'];
    public function etudiants(){
        return $this->belongsToMany(Etudiant::class,'etudiant_admin');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}