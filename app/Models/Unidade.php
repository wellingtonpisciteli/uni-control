<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nome', 'ativo'])]
class Unidade extends Model
{
    public function setores(): HasMany
    {
        return $this->hasMany(Setor::class);
    }
}