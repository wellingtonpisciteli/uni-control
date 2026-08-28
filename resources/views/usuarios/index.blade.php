@extends('layouts.unicontrol')

@section('content')

<div class="px-4 py-6 sm:px-6 lg:px-8">

{{-- ========================================= --}}
{{-- CABEÇALHO --}}
{{-- ========================================= --}}

<div class="mb-6 flex flex-col gap-4 sm:mb-8 sm:flex-row sm:items-center sm:justify-between">

    <div>

        @if(Auth::user()->setor)

            <p class="text-sm font-semibold text-orange-500">
                {{ Auth::user()->setor->nome }}
            </p>

        @else

            <p class="text-sm font-semibold text-orange-500">
                Administração
            </p>

        @endif

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            Usuários
        </h1>

        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            Gerencie os usuários que possuem acesso ao UniControl.
        </p>

    </div>


    {{-- Novo usuário --}}
    <a
        href="{{ route('usuarios.create') }}"
        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200 sm:w-auto"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 4v16m8-8H4"
            />
        </svg>

        Novo usuário

    </a>

</div>


{{-- ========================================= --}}
{{-- MENSAGEM DE SUCESSO --}}
{{-- ========================================= --}}

@if(session('success'))

    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
        {{ session('success') }}
    </div>

@endif


{{-- ========================================= --}}
{{-- INDICADORES --}}
{{-- ========================================= --}}

<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

    {{-- Total --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87m-1-9.13a4 4 0 110 8"
                    />
                </svg>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Total de usuários
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $usuarios->count() }}
                </p>

            </div>

        </div>

    </div>


    {{-- Líderes --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 3l2.09 4.26L19 8l-3.5 3.41L16.18 16 12 13.77 7.82 16l.68-4.59L5 8l4.91-.74L12 3z"
                    />
                </svg>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Líderes
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $usuarios->where('role', 'lider')->count() }}
                </p>

            </div>

        </div>

    </div>


    {{-- Usuários do setor --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8zm5 0a4 4 0 100-8 4 4 0 000 8z"
                    />
                </svg>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Usuários do setor
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $usuarios->where('role', 'setor')->count() }}
                </p>

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- LISTA DE USUÁRIOS --}}
{{-- ========================================= --}}

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

    {{-- Cabeçalho da lista --}}
    <div class="border-b border-gray-200 px-5 py-4 sm:px-6">

        <div class="flex items-center gap-4">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8zm5 0a4 4 0 100-8 4 4 0 000 8z"
                    />
                </svg>

            </div>

            <div>

                <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
                    Usuários cadastrados
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Usuários que possuem acesso ao seu setor.
                </p>

            </div>

        </div>

    </div>


    @if($usuarios->isEmpty())

        {{-- ========================================= --}}
        {{-- ESTADO VAZIO --}}
        {{-- ========================================= --}}

        <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-100 text-orange-500">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8zm5 0a4 4 0 100-8 4 4 0 000 8z"
                    />
                </svg>

            </div>

            <h2 class="text-lg font-semibold text-gray-900">
                Nenhum usuário encontrado
            </h2>

            <p class="mt-2 max-w-md text-sm leading-6 text-gray-500">
                Ainda não existem usuários cadastrados para este setor.
                Cadastre um usuário para começar.
            </p>

            <a
                href="{{ route('usuarios.create') }}"
                class="mt-6 inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Cadastrar usuário

            </a>

        </div>

    @else

        {{-- ========================================= --}}
        {{-- TABELA --}}
        {{-- ========================================= --}}

        <div class="overflow-x-auto">

            <table class="w-full min-w-[750px] text-left text-sm">

                <thead class="border-b border-gray-200 bg-gray-50">

                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Usuário
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            E-mail
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Setor
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Perfil
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-gray-600">
                            Ações
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @foreach($usuarios as $usuario)

                        <tr class="transition hover:bg-gray-50">

                            {{-- Usuário --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-100 font-semibold text-orange-600">

                                        {{ strtoupper(substr($usuario->name, 0, 1)) }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate font-semibold text-gray-900">
                                            {{ $usuario->name }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- E-mail --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $usuario->email }}
                            </td>


                            {{-- Setor --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $usuario->setor->nome ?? 'Sem setor' }}
                            </td>


                            {{-- Perfil --}}
                            <td class="px-6 py-4">

                                @if($usuario->role === 'lider')

                                    <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                        Líder
                                    </span>

                                @elseif($usuario->role === 'setor')

                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                        Usuário
                                    </span>

                                @elseif($usuario->role === 'administrador')

                                    <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                                        Administrador
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                        {{ ucfirst($usuario->role) }}
                                    </span>

                                @endif

                            </td>


                            {{-- Ações --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- EDITAR --}}
                                    <a
                                        href="{{ route('usuarios.edit', $usuario) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-xs font-semibold text-gray-700 transition hover:bg-orange-50 hover:text-orange-600"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-7.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 8.5-8.5z"
                                            />
                                        </svg>

                                        Editar

                                    </a>


                                    {{-- EXCLUIR --}}
                                    <form
                                        id="form-exclusao-{{ $usuario->id }}"
                                        action="{{ route('usuarios.destroy', $usuario) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            onclick="abrirModalExclusao('{{ $usuario->id }}', '{{ addslashes($usuario->name) }}')"
                                            class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100 hover:text-red-700 focus:outline-none focus:ring-4 focus:ring-red-100"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H9a2 2 0 01-2-2V7m3 4v6m4-6v6"
                                                />
                                            </svg>

                                            Excluir

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>

</div>

{{-- ========================================= --}}
{{-- MODAL DE CONFIRMAÇÃO DE EXCLUSÃO --}}
{{-- ========================================= --}}

<div
    id="modal-exclusao"
    class="fixed inset-0 z-50 hidden items-center justify-center px-4"
    aria-hidden="true"
>

    {{-- OVERLAY --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="fecharModalExclusao()"
    ></div>


    {{-- MODAL --}}
    <div
        class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
    >

        {{-- ÍCONE --}}
        <div class="flex justify-center px-6 pt-7">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-red-500">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-7 w-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.36 12.73A2 2 0 004.66 19.6h14.68a2 2 0 001.73-3.01L13.71 3.86a2 2 0 00-3.42 0z"
                    />

                </svg>

            </div>

        </div>


        {{-- CONTEÚDO --}}
        <div class="px-6 pb-6 pt-5 text-center">

            <h2 class="text-lg font-bold text-gray-900">
                Excluir usuário
            </h2>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Tem certeza que deseja excluir este usuário?
            </p>

            <p
                id="nome-usuario-exclusao"
                class="mt-2 font-semibold text-gray-900"
            >
            </p>

            <p class="mt-2 text-xs text-gray-400">
                Esta ação não poderá ser desfeita.
            </p>

        </div>


        {{-- AÇÕES --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

            <button
                type="button"
                onclick="fecharModalExclusao()"
                class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
            >
                Cancelar
            </button>


            <button
                type="button"
                onclick="confirmarExclusao()"
                class="inline-flex min-h-11 items-center justify-center rounded-xl bg-red-500 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-200"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mr-2 h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H9a2 2 0 01-2-2V7m3 4v6m4-6v6"
                    />
                </svg>

                Excluir usuário

            </button>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================= --}}

<script>

    let usuarioExclusaoId = null;


    function abrirModalExclusao(id, nome)
    {
        usuarioExclusaoId = id;

        const modal = document.getElementById('modal-exclusao');

        const nomeUsuario = document.getElementById('nome-usuario-exclusao');

        nomeUsuario.textContent = nome;

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
    }


    function fecharModalExclusao()
    {
        const modal = document.getElementById('modal-exclusao');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');

        usuarioExclusaoId = null;
    }


    function confirmarExclusao()
    {
        if (!usuarioExclusaoId) {
            return;
        }

        document
            .getElementById('form-exclusao-' + usuarioExclusaoId)
            .submit();
    }


    document.addEventListener('keydown', function(event)
    {
        if (event.key === 'Escape') {
            fecharModalExclusao();
        }
    });

</script>

@endsection