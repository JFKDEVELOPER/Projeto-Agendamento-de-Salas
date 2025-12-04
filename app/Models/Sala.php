<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    // Permite atribuição em massa
    protected $fillable = [
        'nome',
        'bloco_id',
        'capacidade',
        'status',
        'recursos',
        'prioridade', // ⚡ Certifique-se que está aqui
    ];

    // Relacionamentos
    public function bloco()
    {
        return $this->belongsTo(Bloco::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
