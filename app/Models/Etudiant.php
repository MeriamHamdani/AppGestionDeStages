<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin;
use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;
    public function admins(){
        return $this->belongsToMany(Admin::class,'etudiant_admin');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}