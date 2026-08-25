<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nome', 'descricao', 'ativo'])]
class Setor extends Model
{
    protected $table = 'setores';

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    public function materiais(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}