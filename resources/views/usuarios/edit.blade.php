@extends('layouts.unicontrol')

@section('content')

<div class="px-4 py-6 sm:px-6 lg:px-8">

<div class="w-full">

{{-- ========================================= --}}
{{-- CABEÇALHO --}}
{{-- ========================================= --}}

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <p class="mb-1 text-sm font-semibold text-orange-500">
            {{ Auth::user()->setor->nome }}
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            Editar usuário
        </h1>


        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            Atualize as informações e as permissões de acesso deste usuário.
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

    {{-- ÍCONE --}}

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
                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
            />

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4.5 20.25a7.5 7.5 0 0115 0"
            />

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M19 8v6m3-3h-6"
            />

        </svg>

    </div>


    <div>

        <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
            Informações do usuário
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Atualize os dados de acesso do usuário.
        </p>

    </div>

</div>


</div>

{{-- ========================================= --}}
{{-- FORMULÁRIO --}}
{{-- ========================================= --}}

<form
    id="usuario-form"
    action="{{ route('usuarios.update', $usuario) }}"
    method="POST"
>


@csrf
@method('PUT')


<div class="px-5 py-6 sm:px-6">

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


        {{-- ========================================= --}}
        {{-- NOME --}}
        {{-- ========================================= --}}

        <div>

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
                value="{{ old('name', $usuario->name) }}"
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

        <div>

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
                value="{{ old('email', $usuario->email) }}"
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

        <div class="md:col-span-2">

            <label
                for="role"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >

                Perfil de acesso

                <span class="text-red-500">*</span>

            </label>


            <select
                id="role"
                name="role"
                required
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >

                @if(Auth::user()->role === 'lider_setor')

                    <option
                        value="usuario_setor"
                        {{ old('role', $usuario->role) === 'usuario_setor' ? 'selected' : '' }}
                    >
                        Usuário do Setor
                    </option>

                    <option
                        value="lider_setor"
                        {{ old('role', $usuario->role) === 'lider_setor' ? 'selected' : '' }}
                    >
                        Líder do Setor
                    </option>

                @elseif(Auth::user()->role === 'lider_compras')

                    <option
                        value="usuario_compras"
                        {{ old('role', $usuario->role) === 'usuario_compras' ? 'selected' : '' }}
                    >
                        Usuário de Compras
                    </option>

                    <option
                        value="lider_compras"
                        {{ old('role', $usuario->role) === 'lider_compras' ? 'selected' : '' }}
                    >
                        Líder de Compras
                    </option>

                @endif

            </select>


            <p class="mt-2 text-xs text-gray-400">
                O líder possui permissões adicionais dentro do setor.
            </p>


            @error('role')

                <p class="mt-2 text-sm font-medium text-red-500">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- ========================================= --}}
        {{-- NOVA SENHA --}}
        {{-- ========================================= --}}

        <div>

            <label
                for="password"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >

                Nova senha

                <span class="font-normal text-gray-400">
                    (opcional)
                </span>

            </label>


            <input
                type="password"
                id="password"
                name="password"
                minlength="8"
                autocomplete="new-password"
                placeholder="Digite uma nova senha"
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >


            <p class="mt-2 text-xs text-gray-400">
                Deixe em branco para manter a senha atual.
            </p>


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

                Confirmar nova senha

            </label>


            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                minlength="8"
                autocomplete="new-password"
                placeholder="Digite a senha novamente"
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
            >

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- AÇÕES --}}
{{-- ========================================= --}}

<div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-5 py-5 sm:flex-row sm:justify-end sm:px-6">

    <a
        href="{{ route('usuarios.index') }}"
        class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-6 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100"
    >

        Cancelar

    </a>


    <button
        type="button"
        onclick="abrirModalEdicao()"
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
                d="M5 13l4 4L19 7"
            />

        </svg>

        Salvar alterações

    </button>

</div>


</form>

</div>

</div>

{{-- ========================================= --}}
{{-- MODAL DE CONFIRMAÇÃO --}}
{{-- ========================================= --}}

<div
    id="modal-edicao"
    class="fixed inset-0 z-50 hidden items-center justify-center px-4"
    aria-hidden="true"
>

{{-- OVERLAY --}}

<div
    class="absolute inset-0 bg-black/50 backdrop-blur-sm"
    onclick="fecharModalEdicao()"
></div>

{{-- MODAL --}}

<div
    class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
>


{{-- ÍCONE --}}

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
                d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.36 12.73A2 2 0 004.66 19.6h14.68a2 2 0 001.73-3.01L13.71 3.86a2 2 0 00-3.42 0z"
            />

        </svg>

    </div>

</div>


{{-- CONTEÚDO --}}

<div class="px-6 pb-6 pt-5 text-center">

    <h2 class="text-lg font-bold text-gray-900">
        Salvar alterações
    </h2>

    <p class="mt-2 text-sm leading-6 text-gray-500">
        Tem certeza que deseja salvar as alterações deste usuário?
    </p>

    <p class="mt-1 text-xs text-gray-400">
        As informações atualizadas serão aplicadas imediatamente.
    </p>

</div>


{{-- AÇÕES --}}

<div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

    <button
        type="button"
        onclick="fecharModalEdicao()"
        class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
    >

        Cancelar

    </button>


    <button
        type="button"
        onclick="confirmarEdicao()"
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

        Confirmar alterações

    </button>

</div>


</div>

</div>

{{-- ========================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================= --}}

<script>

    function abrirModalEdicao()
    {
        const modal = document.getElementById('modal-edicao');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
    }


    function fecharModalEdicao()
    {
        const modal = document.getElementById('modal-edicao');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
    }


    function confirmarEdicao()
    {
        document
            .getElementById('usuario-form')
            .submit();
    }


    document.addEventListener('keydown', function(event)
    {
        if (event.key === 'Escape') {
            fecharModalEdicao();
        }
    });

</script>

@endsection
