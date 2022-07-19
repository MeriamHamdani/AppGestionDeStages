<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresidentJury extends Model
{
    use HasFactory;
    public function soutenances()
    {
        return $this->hasMany(Soutenance::class);
    }
}