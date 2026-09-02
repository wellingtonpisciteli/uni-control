<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['unidade_id', 'nome', 'descricao', 'ativo'])]
class Setor extends Model
{
    protected $table = 'setores';

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function materiais(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function solicitacoes(): HasMany
    {
        return $this->hasMany(Solicitacao::class);
    }
}