<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        $materiais = Material::where('setor_id', $usuario->setor_id)
            ->where('ativo', true)
            ->withSum([
                'movimentacoes as total_entradas' => function ($query) {
                    $query->where('tipo', 'entrada');
                }
            ], 'quantidade')
            ->withSum([
                'movimentacoes as total_saidas' => function ($query) {
                    $query->where('tipo', 'saida');
                }
            ], 'quantidade')
            ->orderBy('nome')
            ->get();


        // Calcula o estoque atual de cada material
        foreach ($materiais as $material) {

            $material->estoque_atual =
                ($material->total_entradas ?? 0)
                - ($material->total_saidas ?? 0);
        }


        // Indicadores
        $estoqueBaixo = $materiais->filter(function ($material) {

            return $material->estoque_atual > 0
                && $material->estoque_atual <= $material->estoque_minimo;

        })->count();


        $semEstoque = $materiais->filter(function ($material) {

            return $material->estoque_atual <= 0;

        })->count();


        // Movimentações recentes
        $movimentacoes = Movimentacao::whereHas('material', function ($query) use ($usuario) {

                $query->where('setor_id', $usuario->setor_id);

            })
            ->with(['material', 'user'])
            ->latest()
            ->take(10)
            ->get();


        return view('estoque.index', compact(
            'materiais',
            'movimentacoes',
            'estoqueBaixo',
            'semEstoque'
        ));
    }

    public function entrada(Request $request, Material $material)
    {
        abort_unless(
            $material->setor_id === Auth::user()->setor_id,
            403
        );

        $request->validate([
            'quantidade' => ['required', 'integer', 'min:1'],
            'observacao' => ['nullable', 'string', 'max:1000'],
        ]);

        Movimentacao::create([
            'material_id' => $material->id,
            'user_id' => Auth::id(),
            'tipo' => 'entrada',
            'quantidade' => $request->quantidade,
            'observacao' => $request->observacao,
        ]);

        return redirect()
            ->route('estoque.index')
            ->with('success', 'Entrada registrada com sucesso.');
    }

    public function saida(Request $request, Material $material)
    {
        $usuario = Auth::user();

        // Garante que o material pertence ao setor do usuário
        if ($material->setor_id !== $usuario->setor_id) {
            abort(403);
        }

        $request->validate([
            'quantidade' => ['required', 'integer', 'min:1'],
            'observacao' => ['nullable', 'string', 'max:1000'],
        ]);


        // Calcula o estoque atual
        $entradas = $material->movimentacoes()
            ->where('tipo', 'entrada')
            ->sum('quantidade');

        $saidas = $material->movimentacoes()
            ->where('tipo', 'saida')
            ->sum('quantidade');

        $estoqueAtual = $entradas - $saidas;


        // Verifica se existe estoque suficiente
        if ($request->quantidade > $estoqueAtual) {

            return back()->with(
                'error',
                'Estoque insuficiente para realizar esta saída.'
            );
        }


        // Registra a movimentação
        Movimentacao::create([
            'material_id' => $material->id,
            'user_id' => $usuario->id,
            'tipo' => 'saida',
            'quantidade' => $request->quantidade,
            'observacao' => $request->observacao,
        ]);


        return redirect()
            ->route('estoque.index')
            ->with('success', 'Saída registrada com sucesso.');
    }

    public function entradaForm()
    {
        $usuario = Auth::user();

        $materiais = Material::where('setor_id', $usuario->setor_id)
            ->where('ativo', true)
            ->withSum([
                'movimentacoes as total_entradas' => function ($query) {
                    $query->where('tipo', 'entrada');
                }
            ], 'quantidade')
            ->withSum([
                'movimentacoes as total_saidas' => function ($query) {
                    $query->where('tipo', 'saida');
                }
            ], 'quantidade')
            ->orderBy('nome')
            ->get();

        foreach ($materiais as $material) {

            $material->estoque_atual =
                ($material->total_entradas ?? 0)
                - ($material->total_saidas ?? 0);
        }

        return view('estoque.entrada', compact('materiais'));
    }

    public function entradaLote(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'itens' => ['required', 'array'],
            'itens.*' => ['nullable', 'integer', 'min:0'],
            'observacao' => ['nullable', 'string', 'max:1000'],
        ]);

        $itens = collect($request->itens)
            ->filter(function ($quantidade) {
                return $quantidade > 0;
            });

        if ($itens->isEmpty()) {
            return back()
                ->withErrors([
                    'itens' => 'Informe a quantidade de pelo menos um material.',
                ])
                ->withInput();
        }

        DB::transaction(function () use ($itens, $usuario, $request) {

            foreach ($itens as $materialId => $quantidade) {

                $material = Material::where('id', $materialId)
                    ->where('setor_id', $usuario->setor_id)
                    ->where('ativo', true)
                    ->firstOrFail();

                Movimentacao::create([
                    'material_id' => $material->id,
                    'user_id' => $usuario->id,
                    'tipo' => 'entrada',
                    'quantidade' => $quantidade,
                    'observacao' => $request->observacao,
                ]);
            }

        });

        return redirect()
            ->route('estoque.index')
            ->with('success', 'Entradas registradas com sucesso.');
    }

    public function saidaForm()
    {
        $usuario = Auth::user();

        $materiais = Material::where('setor_id', $usuario->setor_id)
            ->where('ativo', true)
            ->withSum([
                'movimentacoes as total_entradas' => function ($query) {
                    $query->where('tipo', 'entrada');
                }
            ], 'quantidade')
            ->withSum([
                'movimentacoes as total_saidas' => function ($query) {
                    $query->where('tipo', 'saida');
                }
            ], 'quantidade')
            ->orderBy('nome')
            ->get();

        foreach ($materiais as $material) {

            $material->estoque_atual =
                ($material->total_entradas ?? 0)
                - ($material->total_saidas ?? 0);
        }

        return view('estoque.saida', compact('materiais'));
    }

    public function saidaLote(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'itens' => ['required', 'array'],
            'itens.*' => ['nullable', 'integer', 'min:0'],
            'observacao' => ['nullable', 'string', 'max:1000'],
        ]);

        $itens = collect($request->itens)
            ->filter(function ($quantidade) {
                return $quantidade !== null && $quantidade > 0;
            });

        if ($itens->isEmpty()) {
            return back()
                ->withErrors([
                    'itens' => 'Informe a quantidade de pelo menos um material.'
                ])
                ->withInput();
        }

        foreach ($itens as $materialId => $quantidade) {

            $material = Material::where('id', $materialId)
                ->where('setor_id', $usuario->setor_id)
                ->where('ativo', true)
                ->firstOrFail();

            $entradas = Movimentacao::where('material_id', $material->id)
                ->where('tipo', 'entrada')
                ->sum('quantidade');

            $saidas = Movimentacao::where('material_id', $material->id)
                ->where('tipo', 'saida')
                ->sum('quantidade');

            $estoqueAtual = $entradas - $saidas;

            if ($quantidade > $estoqueAtual) {

                return back()
                    ->withErrors([
                        'itens' => "Não é possível retirar {$quantidade} {$material->unidade} de {$material->nome}. Estoque disponível: {$estoqueAtual}."
                    ])
                    ->withInput();
            }
        }

        foreach ($itens as $materialId => $quantidade) {

            Movimentacao::create([
                'material_id' => $materialId,
                'user_id' => $usuario->id,
                'tipo' => 'saida',
                'quantidade' => $quantidade,
                'observacao' => $request->observacao,
            ]);
        }

        return redirect()
            ->route('estoque.index')
            ->with('success', 'Saída de materiais registrada com sucesso.');
    }
}