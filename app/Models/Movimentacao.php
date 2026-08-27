<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes';
    
    protected $fillable = [
        'material_id',
        'user_id',
        'tipo',
        'quantidade',
        'observacao',
    ];


    public function material()
    {
        return $this->belongsTo(Material::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}