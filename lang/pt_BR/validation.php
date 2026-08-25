<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mensagens de validação
    |--------------------------------------------------------------------------
    */

    'required' => 'O campo :attribute é obrigatório.',

    'string' => 'O campo :attribute deve ser um texto.',

    'integer' => 'O campo :attribute deve ser um número inteiro.',

    'numeric' => 'O campo :attribute deve ser um número.',

    'email' => 'O campo :attribute deve conter um endereço de e-mail válido.',

    'max' => [
        'string' => 'O campo :attribute não pode ter mais de :max caracteres.',
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
    ],

    'min' => [
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
    ],

    'unique' => 'O :attribute já está cadastrado.',

    'exists' => 'O :attribute selecionado é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Nomes dos campos
    |--------------------------------------------------------------------------
    */

    'attributes' => [

        'nome' => 'nome do material',

        'categoria' => 'categoria',

        'unidade' => 'unidade',

        'estoque_minimo' => 'estoque mínimo',

    ],

];