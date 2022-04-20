<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrilleEvaluation extends Model
{
    use HasFactory;

    public function sousGrilleEvaluations()
    {
        return $this->hasMany(SousGrilleEvaluation::class);
    }

}
