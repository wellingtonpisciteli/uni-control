<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movimentacao;
use App\Models\Solicitacao;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $setorId = $user->setor_id;

        $roleLabel = match ($user->role) {
            'administrador' => 'Administrador',
            'compras' => 'Compras',
            'setor' => 'Setor',
            'lider' => 'Líder',
            default => ucfirst($user->role),
        };

        $setorNome = $user->setor?->nome;

        /*
        |--------------------------------------------------------------------------
        | MATERIAIS
        |--------------------------------------------------------------------------
        */

        $materiais = Material::query()
            ->where('setor_id', $setorId)
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
            ->get();

        $totalMateriais = $materiais->count();

        $estoqueNormal = 0;
        $estoqueBaixo = 0;
        $semEstoque = 0;

        foreach ($materiais as $material) {
            $entradas = $material->total_entradas ?? 0;
            $saidas = $material->total_saidas ?? 0;

            $estoqueAtual = $entradas - $saidas;

            if ($estoqueAtual <= 0) {
                $semEstoque++;
            } elseif ($estoqueAtual <= $material->estoque_minimo) {
                $estoqueBaixo++;
            } else {
                $estoqueNormal++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SOLICITAÇÕES
        |--------------------------------------------------------------------------
        */

        $totalSolicitacoes = Solicitacao::query()
            ->where('setor_id', $setorId)
            ->count();

        $solicitacoesRecentes = Solicitacao::query()
            ->where('setor_id', $setorId)
            ->with('usuario')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | MOVIMENTAÇÕES
        |--------------------------------------------------------------------------
        */

        $totalMovimentacoes = Movimentacao::query()
            ->whereHas('material', function ($query) use ($setorId) {
                $query->where('setor_id', $setorId);
            })
            ->count();

        $movimentacoesRecentes = Movimentacao::query()
            ->whereHas('material', function ($query) use ($setorId) {
                $query->where('setor_id', $setorId);
            })
            ->with(['material', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'roleLabel' => $roleLabel,
            'setorNome' => $setorNome,

            'totalMateriais' => $totalMateriais,
            'totalSolicitacoes' => $totalSolicitacoes,
            'totalMovimentacoes' => $totalMovimentacoes,
            'estoqueBaixo' => $estoqueBaixo,

            'estoqueNormal' => $estoqueNormal,
            'semEstoque' => $semEstoque,

            'solicitacoesRecentes' => $solicitacoesRecentes,
            'movimentacoesRecentes' => $movimentacoesRecentes,
        ]);
    }
}

