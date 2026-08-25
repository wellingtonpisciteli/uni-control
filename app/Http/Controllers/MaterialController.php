<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Lista os materiais do setor do usuário.
     */
    public function index(Request $request): View
    {
        $materiais = Material::where('setor_id', $request->user()->setor_id)
            ->orderBy('nome')
            ->get();

        return view('materiais.index', compact('materiais'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create(): View
    {
        return view('materiais.create');
    }

    /**
     * Salva um novo material.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'categoria' => ['nullable', 'string', 'max:255'],
            'unidade' => ['required', 'string', 'max:50'],
            'estoque_minimo' => ['required', 'integer', 'min:0'],
        ]);

        Material::create([
            ...$validated,
            'setor_id' => $request->user()->setor_id,
        ]);

        return redirect()
            ->route('materiais.index')
            ->with('success', 'Material cadastrado com sucesso.');
    }

    /**
     * Exibe o formulário para editar um material.
     */
    public function edit(Material $material): View
    {
        if ($material->setor_id !== Auth::user()->setor_id) {
            abort(403);
        }

        return view('materiais.edit', compact('material'));
    }


    /**
     * Atualiza um material existente.
     */
    public function update(Request $request, Material $material): RedirectResponse
    {
        if ($material->setor_id !== Auth::user()->setor_id) {
            abort(403);
        }

        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'categoria' => ['nullable', 'string', 'max:255'],
            'unidade' => ['required', 'string', 'max:50'],
            'estoque_minimo' => ['required', 'integer', 'min:0'],
        ]);

        $material->update($validated);

        return redirect()
            ->route('materiais.index')
            ->with('success', 'Material atualizado com sucesso.');
    }

    /**
     * Desativa um material.
     */
    public function destroy(Material $material): RedirectResponse
    {
        if ($material->setor_id !== Auth::user()->setor_id) {
            abort(403);
        }

        $material->update([
            'ativo' => false,
        ]);

        return redirect()
            ->route('materiais.index')
            ->with('success', 'Material desativado com sucesso.');
    }

    /**
     * Reativa um material.
     */
    public function reativar(Material $material): RedirectResponse
    {
        if ($material->setor_id !== Auth::user()->setor_id) {
            abort(403);
        }

        $material->update([
            'ativo' => true,
        ]);

        return redirect()
            ->route('materiais.index')
            ->with('success', 'Material reativado com sucesso.');
    }
}