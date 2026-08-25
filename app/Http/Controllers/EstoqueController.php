<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        $materiais = Material::where('setor_id', $usuario->setor_id)
            ->orderBy('nome')
            ->get();

        return view('estoque.index', compact('materiais'));
    }
}