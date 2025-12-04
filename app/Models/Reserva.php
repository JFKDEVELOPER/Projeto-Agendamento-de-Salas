<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos via create() ou update()
    protected $fillable = [
        'nome',
        'sala_id',
    ];

    // Relacionamento com Sala
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
    