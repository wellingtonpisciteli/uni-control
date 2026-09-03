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
            Cadastrar material
        </h1>

        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            Cadastre um novo material para controlar o estoque do seu setor.
        </p>

    </div>

    <a href="{{ route('materiais.index') }}"
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
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                />

            </svg>

        </div>


        <div>

            <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
                Informações do material
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Informe os dados básicos do material.
            </p>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- FORMULÁRIO --}}
{{-- ========================================= --}}

<form
    id="material-form"
    action="{{ route('materiais.store') }}"
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
                    for="nome"
                    class="mb-2 block text-sm font-semibold text-gray-700"
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
                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
                >


                @error('nome')

                    <p class="mt-2 text-sm font-medium text-red-500">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- ========================================= --}}
            {{-- CATEGORIA --}}
            {{-- ========================================= --}}

            <div>

                <label
                    for="categoria"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >

                    Categoria

                </label>


                <input
                    type="text"
                    id="categoria"
                    name="categoria"
                    value="{{ old('categoria') }}"
                    placeholder="Ex.: Informática"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
                >


                @error('categoria')

                    <p class="mt-2 text-sm font-medium text-red-500">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- ========================================= --}}
            {{-- UNIDADE --}}
            {{-- ========================================= --}}

            <div>

                <label
                    for="unidade"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >

                    Unidade

                    <span class="text-red-500">*</span>

                </label>


                <select
                    id="unidade"
                    name="unidade"
                    required
                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
                >

                    <option
                        value="unidade"
                        {{ old('unidade', 'unidade') === 'unidade' ? 'selected' : '' }}
                    >
                        Unidade
                    </option>

                    <option
                        value="caixa"
                        {{ old('unidade') === 'caixa' ? 'selected' : '' }}
                    >
                        Caixa
                    </option>

                    <option
                        value="pacote"
                        {{ old('unidade') === 'pacote' ? 'selected' : '' }}
                    >
                        Pacote
                    </option>

                    <option
                        value="metro"
                        {{ old('unidade') === 'metro' ? 'selected' : '' }}
                    >
                        Metro
                    </option>

                    <option
                        value="litro"
                        {{ old('unidade') === 'litro' ? 'selected' : '' }}
                    >
                        Litro
                    </option>

                    <option
                        value="kg"
                        {{ old('unidade') === 'kg' ? 'selected' : '' }}
                    >
                        Quilograma
                    </option>

                </select>


                @error('unidade')

                    <p class="mt-2 text-sm font-medium text-red-500">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- ========================================= --}}
            {{-- ESTOQUE MÍNIMO --}}
            {{-- ========================================= --}}

            <div>

                <label
                    for="estoque_minimo"
                    class="mb-2 block text-sm font-semibold text-gray-700"
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
                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
                >


                <p class="mt-2 text-xs text-gray-400">
                    Quantidade mínima desejada para este material.
                </p>


                @error('estoque_minimo')

                    <p class="mt-2 text-sm font-medium text-red-500">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- AÇÕES --}}
    {{-- ========================================= --}}

    <div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-5 py-5 sm:flex-row sm:justify-end sm:px-6">

        <a
            href="{{ route('materiais.index') }}"
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

            Cadastrar material

        </button>

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
                    d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.36 12.73A2 2 0 004.66 19.6h14.68a2 2 0 001.73-3.01L13.71 3.86a2 2 0 00-3.42 0z"
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
            Tem certeza que deseja cadastrar este material?
        </p>

        <p class="mt-1 text-xs text-gray-400">
            O material será adicionado ao estoque do seu setor.
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
{{-- JAVASCRIPT --}}
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
        document
            .getElementById('material-form')
            .submit();
    }


    // Fechar com ESC

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            fecharModalCadastro();

        }

    });

</script>

@endsection
