<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsGrilleEvaluation extends Model
{
    use HasFactory;

    public function sousGrilleEvaluation()
    {
        return $this->belongsTo(SousGrilleEvaluation::class);
    }
}
