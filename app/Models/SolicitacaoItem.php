<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'solicitacao_id',
    'material_id',
    'quantidade',
    'quantidade_atendida',
    'status',
    'observacao',
])]
class SolicitacaoItem extends Model
{
    protected $table = 'solicitacao_itens';

    public function solicitacao(): BelongsTo
    {
        return $this->belongsTo(Solicitacao::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}