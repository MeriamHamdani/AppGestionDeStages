<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationClasse extends Model
{
    use HasFactory;
    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }
}