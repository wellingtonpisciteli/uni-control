<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'setor_id',
    'usuario_id',
    'status',
    'requer_aprovacao_financeira',
    'observacao',
])]
class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    protected function casts(): array
    {
        return [
            'requer_aprovacao_financeira' => 'boolean',
        ];
    }

    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(SolicitacaoItem::class);
    }
}

