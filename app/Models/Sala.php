<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = [
        'bloco_id',
        'codigo',
        'nome',
        'capacidade',
        'tipo',
        'recursos',
        'status',
        'observacoes'
    ];

    protected $casts = [
        'recursos' => 'array'
    ];

    public function bloco()
    {
        return $this->belongsTo(Bloco::class);
    }
}
