<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $fillable = [
        'contenu',
        'titre',

    ];
    public function cahierStage()
    {
        return $this->belongsTo(CahierStage::class);
    }
}