@extends('layouts.unicontrol')

@section('content')

<div class="min-h-screen bg-gray-50 px-4 py-6 sm:px-6 lg:px-8">

    <div class="w-full">

        {{-- CABEÇALHO --}}
        <div class="mb-8">

            <a
                href="{{ route('materiais.index') }}"
                class="mb-5 inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-orange-500"
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
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Voltar para materiais
            </a>

            @if(Auth::user()->setor)

                <p class="mt-1 text-sm font-medium text-orange-500">
                    {{ Auth::user()->setor->nome }}
                </p>

            @else

                <p class="mt-1 text-sm font-medium text-orange-500">
                    Administração
                </p>

            @endif

            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Editar material
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Atualize as informações do material cadastrado.
            </p>

        </div>


        {{-- CARD --}}
        <div class="w-full overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- CABEÇALHO DO CARD --}}
            <div class="border-b border-gray-100 px-6 py-6 sm:px-8 lg:px-10">

                <div class="flex items-center gap-4">

                    {{-- ÍCONE --}}
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                            />
                        </svg>

                    </div>


                    {{-- TÍTULO --}}
                    <div>

                        <h2 class="text-lg font-semibold text-gray-900">
                            Informações do material
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Altere os dados necessários e salve as alterações.
                        </p>

                    </div>

                </div>

            </div>


            {{-- FORMULÁRIO DE EDIÇÃO --}}
            <form
                id="material-form"
                action="{{ route('materiais.update', $material) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="px-6 py-8 sm:px-8 lg:px-10">

                    <div class="grid grid-cols-1 gap-7 md:grid-cols-2">


                        {{-- NOME --}}
                        <div class="md:col-span-2">

                            <label
                                for="nome"
                                class="mb-2.5 block text-sm font-semibold text-gray-700"
                            >
                                Nome do material

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                value="{{ old('nome', $material->nome) }}"
                                placeholder="Ex.: Cabo HDMI 2.0"
                                required
                                autofocus
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                            >

                            @error('nome')

                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- CATEGORIA --}}
                        <div>

                            <label
                                for="categoria"
                                class="mb-2.5 block text-sm font-semibold text-gray-700"
                            >
                                Categoria
                            </label>

                            <input
                                type="text"
                                id="categoria"
                                name="categoria"
                                value="{{ old('categoria', $material->categoria) }}"
                                placeholder="Ex.: Informática"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                            >

                            @error('categoria')

                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- UNIDADE --}}
                        <div>

                            <label
                                for="unidade"
                                class="mb-2.5 block text-sm font-semibold text-gray-700"
                            >
                                Unidade

                                <span class="text-red-500">*</span>

                            </label>

                            <select
                                id="unidade"
                                name="unidade"
                                required
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3.5 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                            >

                                <option
                                    value="unidade"
                                    {{ old('unidade', $material->unidade) === 'unidade' ? 'selected' : '' }}
                                >
                                    Unidade
                                </option>

                                <option
                                    value="caixa"
                                    {{ old('unidade', $material->unidade) === 'caixa' ? 'selected' : '' }}
                                >
                                    Caixa
                                </option>

                                <option
                                    value="pacote"
                                    {{ old('unidade', $material->unidade) === 'pacote' ? 'selected' : '' }}
                                >
                                    Pacote
                                </option>

                                <option
                                    value="metro"
                                    {{ old('unidade', $material->unidade) === 'metro' ? 'selected' : '' }}
                                >
                                    Metro
                                </option>

                                <option
                                    value="litro"
                                    {{ old('unidade', $material->unidade) === 'litro' ? 'selected' : '' }}
                                >
                                    Litro
                                </option>

                                <option
                                    value="kg"
                                    {{ old('unidade', $material->unidade) === 'kg' ? 'selected' : '' }}
                                >
                                    Quilograma
                                </option>

                            </select>

                            @error('unidade')

                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- ESTOQUE MÍNIMO --}}
                        <div>

                            <label
                                for="estoque_minimo"
                                class="mb-2.5 block text-sm font-semibold text-gray-700"
                            >
                                Estoque mínimo

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="number"
                                id="estoque_minimo"
                                name="estoque_minimo"
                                value="{{ old('estoque_minimo', $material->estoque_minimo) }}"
                                min="0"
                                required
                                placeholder="Ex.: 10"
                                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                            >

                            <p class="mt-2 text-xs text-gray-400">
                                Quantidade mínima desejada para este material.
                            </p>

                            @error('estoque_minimo')

                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>

            </form>


            {{-- RODAPÉ --}}
            <div class="border-t border-gray-100 bg-gray-50 px-6 py-5 sm:px-8 lg:px-10">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">


                    {{-- ATIVAR / DESATIVAR --}}
                    <div class="w-full sm:w-auto">

                        @if($material->ativo)

                            <form
                                id="desativar-form"
                                action="{{ route('materiais.destroy', $material) }}"
                                method="POST"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="button"
                                    onclick="abrirModalStatus()"
                                    class="inline-flex min-h-11 w-full items-center justify-center rounded-xl border border-red-200 bg-white px-5 text-sm font-semibold text-red-600 transition hover:bg-red-50 sm:w-auto"
                                >
                                    Desativar material
                                </button>

                            </form>

                        @else

                            <form
                                id="reativar-form"
                                action="{{ route('materiais.reativar', $material) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="button"
                                    onclick="abrirModalStatus()"
                                    class="inline-flex min-h-11 w-full items-center justify-center rounded-xl border border-green-200 bg-white px-5 text-sm font-semibold text-green-600 transition hover:bg-green-50 sm:w-auto"
                                >
                                    Reativar material
                                </button>

                            </form>

                        @endif

                    </div>


                    {{-- AÇÕES PRINCIPAIS --}}
                    <div class="grid w-full grid-cols-2 gap-3 sm:flex sm:w-auto">


                        {{-- CANCELAR --}}
                        <a
                            href="{{ route('materiais.index') }}"
                            class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
                        >
                            Cancelar
                        </a>


                        {{-- SALVAR --}}
                        <button
                            type="button"
                            onclick="abrirModalSalvar()"
                            class="inline-flex min-h-11 items-center justify-center rounded-xl bg-orange-500 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200 sm:px-7"
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

                            <span class="sm:hidden">
                                Salvar
                            </span>

                            <span class="hidden sm:inline">
                                Salvar alterações
                            </span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ========================================================= --}}
{{-- MODAL SALVAR ALTERAÇÕES --}}
{{-- ========================================================= --}}

<div
    id="modal-salvar"
    class="fixed inset-0 z-50 hidden items-center justify-center px-4"
    aria-hidden="true"
>

    {{-- OVERLAY --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="fecharModalSalvar()"
    ></div>


    {{-- MODAL --}}
    <div class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

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
                        d="M5 13l4 4L19 7"
                    />

                </svg>

            </div>

        </div>


        {{-- TEXTO --}}
        <div class="px-6 pb-6 pt-5 text-center">

            <h2 class="text-lg font-bold text-gray-900">
                Salvar alterações?
            </h2>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Tem certeza que deseja salvar as alterações deste material?
            </p>

            <p class="mt-1 text-xs text-gray-400">
                Os dados atuais serão atualizados no sistema.
            </p>

        </div>


        {{-- BOTÕES --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

            <button
                type="button"
                onclick="fecharModalSalvar()"
                class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
            >
                Cancelar
            </button>


            <button
                type="button"
                onclick="confirmarSalvar()"
                class="inline-flex min-h-11 items-center justify-center rounded-xl bg-orange-500 px-5 text-sm font-semibold text-white transition hover:bg-orange-600"
            >
                Confirmar alterações
            </button>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- MODAL ATIVAR / DESATIVAR --}}
{{-- ========================================================= --}}

<div
    id="modal-status"
    class="fixed inset-0 z-50 hidden items-center justify-center px-4"
    aria-hidden="true"
>

    {{-- OVERLAY --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="fecharModalStatus()"
    ></div>


    {{-- MODAL --}}
    <div class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

        {{-- ÍCONE --}}
        <div class="flex justify-center px-6 pt-7">

            @if($material->ativo)

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

            @else

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-100 text-green-500">

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
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                </div>

            @endif

        </div>


        {{-- TEXTO --}}
        <div class="px-6 pb-6 pt-5 text-center">

            @if($material->ativo)

                <h2 class="text-lg font-bold text-gray-900">
                    Desativar material?
                </h2>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Tem certeza que deseja desativar este material?
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    O material continuará registrado, mas ficará indisponível para uso.
                </p>

            @else

                <h2 class="text-lg font-bold text-gray-900">
                    Reativar material?
                </h2>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Tem certeza que deseja reativar este material?
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    O material voltará a ficar disponível no setor.
                </p>

            @endif

        </div>


        {{-- BOTÕES --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

            <button
                type="button"
                onclick="fecharModalStatus()"
                class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
            >
                Cancelar
            </button>


            @if($material->ativo)

                <button
                    type="button"
                    onclick="confirmarStatus()"
                    class="inline-flex min-h-11 items-center justify-center rounded-xl bg-red-500 px-5 text-sm font-semibold text-white transition hover:bg-red-600"
                >
                    Desativar material
                </button>

            @else

                <button
                    type="button"
                    onclick="confirmarStatus()"
                    class="inline-flex min-h-11 items-center justify-center rounded-xl bg-green-500 px-5 text-sm font-semibold text-white transition hover:bg-green-600"
                >
                    Reativar material
                </button>

            @endif

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | MODAL SALVAR
    |--------------------------------------------------------------------------
    */

    function abrirModalSalvar() {

        const modal = document.getElementById('modal-salvar');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
    }


    function fecharModalSalvar() {

        const modal = document.getElementById('modal-salvar');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
    }


    function confirmarSalvar() {

        document.getElementById('material-form').submit();

    }



    /*
    |--------------------------------------------------------------------------
    | MODAL ATIVAR / DESATIVAR
    |--------------------------------------------------------------------------
    */

    function abrirModalStatus() {

        const modal = document.getElementById('modal-status');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
    }


    function fecharModalStatus() {

        const modal = document.getElementById('modal-status');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
    }


    function confirmarStatus() {

        @if($material->ativo)

            document.getElementById('desativar-form').submit();

        @else

            document.getElementById('reativar-form').submit();

        @endif

    }



    /*
    |--------------------------------------------------------------------------
    | ESC
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            fecharModalSalvar();
            fecharModalStatus();

        }

    });

</script>

@endsection