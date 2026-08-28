<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $usuario = $request->user();

        if ($usuario->role === 'administrador') {
            $usuarios = User::with('setor')
                ->orderBy('name')
                ->get();
        } else {
            $usuarios = User::with('setor')
                ->where('setor_id', $usuario->setor_id)
                ->orderBy('name')
                ->get();
        }

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $usuarioLogado = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'role' => [
                'required',
                'in:setor,lider',
            ],
        ], [
            'name.required' => 'Informe o nome do usuário.',

            'email.required' => 'Informe o e-mail do usuário.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'password.required' => 'Informe uma senha.',
            'password.confirmed' => 'As senhas não conferem.',
            'password.min' => 'A senha deve possuir pelo menos 8 caracteres.',

            'role.required' => 'Selecione o perfil do usuário.',
            'role.in' => 'Selecione um perfil válido.',
        ]);

        $setorId = $usuarioLogado->setor_id;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'setor_id' => $setorId,
            'role' => $request->role,
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuário cadastrado com sucesso.');
    }

    /*
    |--------------------------------------------------------------------------
    | Formulário de edição
    |--------------------------------------------------------------------------
    */

    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }


    /*
    |--------------------------------------------------------------------------
    | Atualizar usuário
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $usuario->id,
            ],

            'role' => [
                'required',
                'in:setor,lider',
            ],

            'password' => [
                'nullable',
                'confirmed',
                'min:8',
            ],
        ], [
            'name.required' => 'Informe o nome do usuário.',

            'email.required' => 'Informe o e-mail do usuário.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'role.required' => 'Selecione o perfil do usuário.',
            'role.in' => 'O perfil selecionado é inválido.',

            'password.confirmed' => 'As senhas não conferem.',
            'password.min' => 'A senha deve possuir pelo menos 8 caracteres.',
        ]);


        $dados = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];


        if ($request->filled('password')) {

            $dados['password'] = Hash::make($request->password);

        }


        $usuario->update($dados);


        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }
}
