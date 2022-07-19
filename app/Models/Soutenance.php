<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soutenance extends Model
{
    use HasFactory;

    protected $fillable = ['date','start_time','salle','mention','note','president','membres'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function membres(){
        return $this->belongsToMany(Enseignant::class,'membres_soutenances');
    }

    public function president(){
        return $this->belongsTo(Enseignant::class);
    }
}