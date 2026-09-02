<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Solicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SolicitacaoController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        $solicitacoes = Solicitacao::with('itens')
            ->where('setor_id', $usuario->setor_id)
            ->latest()
            ->get();

        return view('solicitacoes.index', compact('solicitacoes'));
    }

    public function create()
    {
        $usuario = Auth::user();

        $materiais = Material::where('setor_id', $usuario->setor_id)
            ->where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('solicitacoes.create', compact('materiais'));
    }

    public function store(Request $request)
    {
        $usuario = Auth::user();

        $dados = $request->validate([
            'observacao' => ['nullable', 'string', 'max:5000'],

            'requer_aprovacao_financeira' => ['required', 'boolean'],

            'itens' => ['required', 'array', 'min:1'],

            'itens.*.material_id' => [
                'required',
                'integer',
                'distinct',
                'exists:materiais,id',
            ],

            'itens.*.quantidade' => [
                'required',
                'integer',
                'min:1',
            ],

            'itens.*.observacao' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'itens.required' => 'Adicione pelo menos um material à solicitação.',
            'itens.min' => 'Adicione pelo menos um material à solicitação.',

            'itens.*.material_id.required' => 'Selecione um material válido.',
            'itens.*.material_id.exists' => 'Um dos materiais selecionados não existe.',
            'itens.*.material_id.distinct' => 'O mesmo material não pode ser adicionado duas vezes.',

            'itens.*.quantidade.required' => 'Informe a quantidade de cada material.',
            'itens.*.quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'itens.*.quantidade.min' => 'A quantidade deve ser pelo menos 1.',

            'itens.*.observacao.string' => 'A observação do material deve ser um texto.',
            'itens.*.observacao.max' => 'A observação do material não pode ultrapassar 2000 caracteres.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Confere se todos os materiais pertencem ao setor do usuário
        |--------------------------------------------------------------------------
        */

        $materialIds = collect($dados['itens'])
            ->pluck('material_id')
            ->values();


        $materiais = Material::whereIn('id', $materialIds)
            ->where('setor_id', $usuario->setor_id)
            ->where('ativo', true)
            ->get()
            ->keyBy('id');


        if ($materiais->count() !== $materialIds->count()) {
            abort(403, 'Um ou mais materiais não pertencem ao seu setor.');
        }


        /*
        |--------------------------------------------------------------------------
        | Criação da solicitação
        |--------------------------------------------------------------------------
        */

        $solicitacao = DB::transaction(function () use ($dados, $usuario, $materiais) {

            $solicitacao = Solicitacao::create([
                'setor_id' => $usuario->setor_id,
                'usuario_id' => $usuario->id,
                'status' => 'enviada',
                'requer_aprovacao_financeira' => $dados['requer_aprovacao_financeira'],
                'observacao' => $dados['observacao'] ?? null,
            ]);


            foreach ($dados['itens'] as $item) {

                $material = $materiais->get($item['material_id']);


                $solicitacao->itens()->create([
                    'material_id' => $material->id,
                    'quantidade' => $item['quantidade'],
                    'quantidade_atendida' => 0,
                    'status' => 'pendente',
                    'observacao' => $item['observacao'] ?? null,
                ]);

            }


            return $solicitacao;
        });


        return redirect()
            ->route('solicitacoes.show', $solicitacao)
            ->with('success', 'Solicitação enviada com sucesso.');
    }


    public function show(Solicitacao $solicitacao)
    {
        $usuario = Auth::user();

        // Garante que o setor só consiga visualizar
        // solicitações pertencentes ao próprio setor.
        if ($solicitacao->setor_id !== $usuario->setor_id) {
            abort(403);
        }

        $solicitacao->load([
            'setor',
            'usuario',
            'itens.material',
        ]);

        $status = match ($solicitacao->status) {
            'rascunho' => [
                'label' => 'Rascunho',
                'class' => 'bg-gray-100 text-gray-700',
                'dot' => 'bg-gray-400',
            ],

            'enviada' => [
                'label' => 'Enviada',
                'class' => 'bg-blue-100 text-blue-700',
                'dot' => 'bg-blue-500',
            ],

            'em_analise' => [
                'label' => 'Em análise',
                'class' => 'bg-orange-100 text-orange-700',
                'dot' => 'bg-orange-500',
            ],

            'aprovada' => [
                'label' => 'Aprovada',
                'class' => 'bg-green-100 text-green-700',
                'dot' => 'bg-green-500',
            ],

            'rejeitada' => [
                'label' => 'Rejeitada',
                'class' => 'bg-red-100 text-red-700',
                'dot' => 'bg-red-500',
            ],

            'atendida' => [
                'label' => 'Atendida',
                'class' => 'bg-green-100 text-green-700',
                'dot' => 'bg-green-500',
            ],

            'cancelada' => [
                'label' => 'Cancelada',
                'class' => 'bg-gray-100 text-gray-600',
                'dot' => 'bg-gray-400',
            ],

            default => [
                'label' => ucfirst($solicitacao->status),
                'class' => 'bg-gray-100 text-gray-700',
                'dot' => 'bg-gray-400',
            ],
        };

        return view('solicitacoes.show', compact(
            'solicitacao',
            'status'
        ));
    }


}