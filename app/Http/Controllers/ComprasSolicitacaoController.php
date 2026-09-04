<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;

class ComprasSolicitacaoController extends Controller
{
    public function index()
    {
        $solicitacoes = Solicitacao::with([
            'itens',
            'setor',
            'usuario',
        ])
            ->latest()
            ->get();

        return view('solicitacoesCompras.index', compact('solicitacoes'));
    }

    public function show(Solicitacao $solicitacao)
    {
        $solicitacao->load([
            'setor',
            'usuario',
            'itens.material',
        ]);

        return view('solicitacoesCompras.show', compact('solicitacao'));
    }
}