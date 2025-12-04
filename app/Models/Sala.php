<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'bloco_id',
        'nome',
        'capacidade',
        'recursos',
        'status',
        'observacoes'
    ];

    protected $casts = [
        'recursos' => 'array'
    ];

    // Relacionamento com Bloco
    public function bloco()
    {
        return $this->belongsTo(Bloco::class);
    }
}
