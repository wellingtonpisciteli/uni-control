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

            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Cadastrar material
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Cadastre um novo material para controlar o estoque do seu setor.
            </p>

        </div>


        {{-- CARD --}}
        <div class="w-full overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- CABEÇALHO DO CARD --}}
            <div class="border-b border-gray-100 px-6 py-6 sm:px-8 lg:px-10">

                <div class="flex items-center gap-4">

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
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                            />
                        </svg>

                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            Informações do material
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Informe os dados básicos do material.
                        </p>
                    </div>

                </div>

            </div>


            {{-- FORM --}}
            <form
                id="material-form"
                action="{{ route('materiais.store') }}"
                method="POST"
            >

                @csrf

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
                                value="{{ old('nome') }}"
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
                                value="{{ old('categoria') }}"
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

                                <option value="unidade">
                                    Unidade
                                </option>

                                <option value="caixa" {{ old('unidade') === 'caixa' ? 'selected' : '' }}>
                                    Caixa
                                </option>

                                <option value="pacote" {{ old('unidade') === 'pacote' ? 'selected' : '' }}>
                                    Pacote
                                </option>

                                <option value="metro" {{ old('unidade') === 'metro' ? 'selected' : '' }}>
                                    Metro
                                </option>

                                <option value="litro" {{ old('unidade') === 'litro' ? 'selected' : '' }}>
                                    Litro
                                </option>

                                <option value="kg" {{ old('unidade') === 'kg' ? 'selected' : '' }}>
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
                                value="{{ old('estoque_minimo', 0) }}"
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


                {{-- RODAPÉ --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8 lg:px-10">

                    <p class="hidden text-xs text-gray-400 sm:block">
                        <span class="text-red-500">*</span>
                        Campos obrigatórios
                    </p>

                    <div class="flex w-full flex-col-reverse gap-3 sm:w-auto sm:flex-row">

                        <a
                            href="{{ route('materiais.index') }}"
                            class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-6 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
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

                            Cadastrar material

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- MODAL DE CONFIRMAÇÃO --}}
<div
    id="modal-cadastro"
    class="fixed inset-0 z-50 hidden items-center justify-center px-4"
    aria-hidden="true"
>

    {{-- OVERLAY --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="fecharModalCadastro()"
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
                Confirmar cadastro
            </h2>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Tem certeza que deseja cadastrar este material?
            </p>

            <p class="mt-1 text-xs text-gray-400">
                O material será adicionado ao estoque do seu setor.
            </p>

        </div>


        {{-- AÇÕES --}}
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


{{-- JAVASCRIPT DO MODAL --}}
<script>

    function abrirModalCadastro() {

        const modal = document.getElementById('modal-cadastro');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
    }


    function fecharModalCadastro() {

        const modal = document.getElementById('modal-cadastro');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
    }


    function confirmarCadastro() {

        document.getElementById('material-form').submit();

    }


    // Fechar com ESC
    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            fecharModalCadastro();

        }

    });

</script>

@endsection