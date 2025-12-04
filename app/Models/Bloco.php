<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloco extends Model
{
    protected $fillable = ['nome', 'descricao'];

    public function salas()
    {
        return $this->hasMany(Sala::class);
    }
}



