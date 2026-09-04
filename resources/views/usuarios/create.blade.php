@extends('layouts.unicontrol')

@section('content')

<div class="px-4 py-6 sm:px-6 lg:px-8">

{{-- ========================================= --}}
{{-- CABEÇALHO --}}
{{-- ========================================= --}}

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <p class="mb-1 text-sm font-semibold text-orange-500">
            {{ Auth::user()->setor->nome }}
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            Novo usuário
        </h1>


        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            Cadastre um novo usuário para acessar o UniControl.
        </p>

    </div>

    <a href="{{ route('usuarios.index') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-200">

        <svg class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

            <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

        </svg>

        Voltar
    </a>

</div>


{{-- ========================================= --}}
{{-- CARD --}}
{{-- ========================================= --}}

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

{{-- ========================================= --}}
{{-- CABEÇALHO DO CARD --}}
{{-- ========================================= --}}

<div class="border-b border-gray-200 px-5 py-5 sm:px-6">


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
                d="M18 9a3 3 0 10-6 0 3 3 0 006 0zM9 9a3 3 0 10-6 0 3 3 0 006 0zM21 20a6 6 0 00-12 0M3 20a6 6 0 0112 0"
            />

        </svg>

    </div>


    <div>

        <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
            Informações do usuário
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Informe os dados de acesso e o perfil do usuário.
        </p>

    </div>

</div>


</div>

{{-- ========================================= --}}
{{-- FORMULÁRIO --}}
{{-- ========================================= --}}

<form
    id="usuario-form"
    action="{{ route('usuarios.store') }}"
    method="POST"
>


@csrf


<div class="px-5 py-6 sm:px-6">

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


        {{-- ========================================= --}}
        {{-- NOME --}}
        {{-- ========================================= --}}

        <div class="md:col-span-2">

            <label
                for="name"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >

                Nome completo

                <span class="text-red-500">*</span>

            </label>


            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Ex.: João da Silva"
                required
                autofocus
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >


            @error('name')

                <p class="mt-2 text-sm font-medium text-red-500">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- ========================================= --}}
        {{-- E-MAIL --}}
        {{-- ========================================= --}}

        <div class="md:col-span-2">

            <label
                for="email"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >

                E-mail

                <span class="text-red-500">*</span>

            </label>


            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Ex.: joao@empresa.com"
                required
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >


            @error('email')

                <p class="mt-2 text-sm font-medium text-red-500">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- ========================================= --}}
        {{-- PERFIL --}}
        {{-- ========================================= --}}

        <div>

            <label
                for="role"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >

                Perfil

                <span class="text-red-500">*</span>

            </label>


            <select
                id="role"
                name="role"
                required
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >

                <option value="">
                    Selecione o perfil
                </option>


                @if(Auth::user()->role === 'lider_setor')

                    <option
                        value="usuario_setor"
                        {{ old('role') === 'usuario_setor' ? 'selected' : '' }}
                    >
                        Usuário do Setor
                    </option>

                    <option
                        value="lider_setor"
                        {{ old('role') === 'lider_setor' ? 'selected' : '' }}
                    >
                        Líder do Setor
                    </option>

                @elseif(Auth::user()->role === 'lider_compras')

                    <option
                        value="usuario_compras"
                        {{ old('role') === 'usuario_compras' ? 'selected' : '' }}
                    >
                        Usuário de Compras
                    </option>

                    <option
                        value="lider_compras"
                        {{ old('role') === 'lider_compras' ? 'selected' : '' }}
                    >
                        Líder de Compras
                    </option>

                @endif

            </select>


            <p class="mt-2 text-xs text-gray-400">
                Define o nível de acesso do usuário dentro do setor.
            </p>


            @error('role')

                <p class="mt-2 text-sm font-medium text-red-500">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- ========================================= --}}
        {{-- SENHA --}}
        {{-- ========================================= --}}

        <div>

            <label
                for="password"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >

                Senha

                <span class="text-red-500">*</span>

            </label>


            <input
                type="password"
                id="password"
                name="password"
                placeholder="Mínimo de 8 caracteres"
                required
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >


            @error('password')

                <p class="mt-2 text-sm font-medium text-red-500">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- ========================================= --}}
        {{-- CONFIRMAR SENHA --}}
        {{-- ========================================= --}}

        <div>

            <label
                for="password_confirmation"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >

                Confirmar senha

                <span class="text-red-500">*</span>

            </label>


            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Digite a senha novamente"
                required
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >

        </div>


    </div>

</div>


{{-- ========================================= --}}
{{-- AÇÕES --}}
{{-- ========================================= --}}

<div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

    <p class="hidden text-xs text-gray-400 sm:block">

        <span class="text-red-500">*</span>

        Campos obrigatórios

    </p>


    <div class="flex w-full flex-col-reverse gap-3 sm:w-auto sm:flex-row">

        <a
            href="{{ route('usuarios.index') }}"
            class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-6 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100"
        >

            Cancelar

        </a>


        <button
            type="button"
            onclick="abrirModalCadastro()"
            class="inline-flex min-h-11 items-center justify-center rounded-xl bg-orange-500 px-7 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mr-2 h-5 w-5"
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

        </button>

    </div>

</div>


</form>

</div>

</div>

{{-- ========================================= --}}
{{-- MODAL DE CONFIRMAÇÃO --}}
{{-- ========================================= --}}

<div
    id="modal-cadastro"
    class="fixed inset-0 z-50 hidden items-center justify-center px-4"
    aria-hidden="true"
>

{{-- Overlay --}}

<div
    class="absolute inset-0 bg-black/50 backdrop-blur-sm"
    onclick="fecharModalCadastro()"
></div>

{{-- Modal --}}

<div
    class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
>


{{-- Ícone --}}

<div class="flex justify-center px-6 pt-7">

    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-orange-100 text-orange-500">

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
                d="M18 9a3 3 0 10-6 0 3 3 0 006 0zM9 9a3 3 0 10-6 0 3 3 0 006 0zM21 20a6 6 0 00-12 0M3 20a6 6 0 0112 0"
            />

        </svg>

    </div>

</div>


{{-- Conteúdo --}}

<div class="px-6 pb-6 pt-5 text-center">

    <h2 class="text-lg font-bold text-gray-900">
        Confirmar cadastro
    </h2>


    <p class="mt-2 text-sm leading-6 text-gray-500">
        Tem certeza que deseja cadastrar este usuário?
    </p>


    <p class="mt-1 text-xs text-gray-400">
        O usuário poderá acessar o UniControl com as credenciais informadas.
    </p>

</div>


{{-- Ações --}}

<div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

    <button
        type="button"
        onclick="fecharModalCadastro()"
        class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
    >

        Cancelar

    </button>


    <button
        type="button"
        onclick="confirmarCadastro()"
        class="inline-flex min-h-11 items-center justify-center rounded-xl bg-orange-500 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
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
                d="M5 13l4 4L19 7"
            />

        </svg>

        Confirmar cadastro

    </button>

</div>


</div>

</div>

{{-- ========================================= --}}
{{-- JAVASCRIPT DO MODAL --}}
{{-- ========================================= --}}

<script>

    function abrirModalCadastro()
    {
        const modal = document.getElementById('modal-cadastro');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
    }


    function fecharModalCadastro()
    {
        const modal = document.getElementById('modal-cadastro');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
    }


    function confirmarCadastro()
    {
        document.getElementById('usuario-form').submit();
    }


    document.addEventListener('keydown', function(event)
    {
        if (event.key === 'Escape') {

            fecharModalCadastro();

        }
    });

</script>

@endsection
