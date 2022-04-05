<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    public function configurationsClasse()
    {
        return $this->belongsToMany(ConfigurationClasse::class);
    }
}