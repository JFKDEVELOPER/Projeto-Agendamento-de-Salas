<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'bloco_id', 'codigo', 'nome', 'capacidade', 
        'tipo', 'recursos', 'status', 'observacoes'
    ];
    
    protected $casts = [
        'recursos' => 'array',
    ];
    
    /**
     * Relacionamento: Uma sala pertence a um bloco
     */
    public function bloco(): BelongsTo
    {
        return $this->belongsTo(Bloco::class);
    }
}