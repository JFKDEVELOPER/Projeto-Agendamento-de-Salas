<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bloco extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];
    
    /**
     * Relacionamento: Um bloco tem muitas salas
     */
    public function salas(): HasMany
    {
        return $this->hasMany(Sala::class);
    }
}