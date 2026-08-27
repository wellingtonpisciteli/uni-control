<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    protected $table = 'materiais';
    
    protected $fillable = [
        'setor_id',
        'nome',
        'categoria',
        'unidade',
        'estoque_minimo',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }
}