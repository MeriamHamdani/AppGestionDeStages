<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeStage extends Model
{
    use HasFactory;
    protected $casts = [
        'type_sujet' => 'json',
    ];
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
