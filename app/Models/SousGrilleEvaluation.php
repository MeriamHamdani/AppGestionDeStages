<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousGrilleEvaluation extends Model
{
    use HasFactory;

    public function detailsGrilleEvaluations()
    {
        return $this->hasMany(DetailsGrilleEvaluation::class);
    }
    public function grilleEvaluation()
    {
        return $this->belongsTo(GrilleEvaluation::class);
    }
}
