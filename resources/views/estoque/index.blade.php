@extends('layouts.unicontrol')

@section('content')

<div class="min-h-screen bg-gray-100 px-4 py-6 sm:px-6 lg:px-8">

    {{-- ========================================= --}}
    {{-- CABEÇALHO --}}
    {{-- ========================================= --}}

    <div class="mb-6 flex flex-col gap-4 sm:mb-8 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-sm font-semibold text-orange-500">
                {{ Auth::user()->setor->nome }}
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-950 sm:text-3xl">
                Estoque
            </h1>

            <p class="mt-2 text-sm text-gray-600 sm:text-base">
                Controle as entradas, saídas e quantidades dos materiais.
            </p>

        </div>


        {{-- AÇÕES --}}
        <div class="flex w-full gap-2 sm:w-auto">

            <a
                href="{{ route('estoque.entrada.form') }}"
                class="flex flex-1 items-center justify-center rounded-xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200 sm:flex-none"
            >
                + Entrada
            </a>

            <a
                href="{{ route('estoque.saida.form') }}"
                class="flex flex-1 items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 sm:flex-none"
            >
                − Saída
            </a>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- MENSAGEM DE SUCESSO --}}
    {{-- ========================================= --}}

    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700 shadow-sm">
            {{ session('success') }}
        </div>

    @endif


    {{-- ========================================= --}}
    {{-- INDICADORES --}}
    {{-- ========================================= --}}

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Total de materiais --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-600">
                        Materiais em estoque
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-950">
                        {{ $materiais->count() }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-600">

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

            </div>

        </div>


        {{-- Estoque baixo --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-600">
                        Estoque baixo
                    </p>

                    <p class="mt-2 text-2xl font-bold text-orange-500">
                        {{ $estoqueBaixo }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

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
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.36 12.73A2 2 0 004.66 19.6h14.68a2 2 0 001.73-3.01L13.71 3.86a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Sem estoque --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-600">
                        Sem estoque
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-500">
                        {{ $semEstoque }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-500">

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
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- ESTOQUE --}}
    {{-- ========================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        @if($materiais->isEmpty())

            {{-- Estado vazio --}}
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
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                        />
                    </svg>

                </div>

                <h2 class="text-lg font-semibold text-gray-950">
                    Estoque vazio
                </h2>

                <p class="mt-2 max-w-md text-sm leading-6 text-gray-600">
                    Nenhum material foi cadastrado para este setor.
                    Cadastre os materiais primeiro para começar a controlar o estoque.
                </p>

                <a
                    href="{{ route('materiais.create') }}"
                    class="mt-6 inline-flex items-center rounded-xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
                >
                    Cadastrar material
                </a>

            </div>

        @else

            {{-- Tabela --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px] text-left text-sm">

                    <thead class="border-b border-gray-200 bg-gray-100">

                        <tr>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Material
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Categoria
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Quantidade
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Mínimo
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-gray-600">
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        @foreach($materiais as $material)

                            <tr class="transition hover:bg-gray-50">

                                {{-- Material --}}
                                <td class="px-6 py-4">

                                    <p class="font-semibold text-gray-950">
                                        {{ $material->nome }}
                                    </p>

                                    <p class="mt-1 text-xs font-medium text-gray-500">
                                        {{ $material->unidade }}
                                    </p>

                                </td>


                                {{-- Categoria --}}
                                <td class="px-6 py-4 font-medium text-gray-600">
                                    {{ $material->categoria ?? '—' }}
                                </td>


                                {{-- Quantidade --}}
                                <td class="px-6 py-4">

                                    <span class="font-bold text-gray-950">
                                        {{ $material->estoque_atual }}
                                    </span>

                                    <span class="text-gray-500">
                                        {{ $material->unidade }}
                                    </span>

                                </td>


                                {{-- Mínimo --}}
                                <td class="px-6 py-4 font-medium text-gray-600">
                                    {{ $material->estoque_minimo }}
                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    @if($material->estoque_atual <= 0)

                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Sem estoque
                                        </span>

                                    @elseif($material->estoque_atual <= $material->estoque_minimo)

                                        <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                            Estoque baixo
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Normal
                                        </span>

                                    @endif

                                </td>


                                {{-- Ações --}}
                                <td class="px-6 py-4">

                                    <div class="flex justify-end gap-2">

                                        <button
                                            type="button"
                                            onclick="abrirModalEntrada(
                                                {{ $material->id }},
                                                '{{ addslashes($material->nome) }}',
                                                '{{ $material->unidade }}'
                                            )"
                                            class="rounded-lg bg-orange-50 px-3 py-2 text-xs font-semibold text-orange-600 transition hover:bg-orange-100"
                                        >
                                            Entrada
                                        </button>

                                        <button
                                            type="button"
                                            onclick="abrirModalSaida(
                                                {{ $material->id }},
                                                '{{ addslashes($material->nome) }}',
                                                '{{ $material->unidade }}',
                                                {{ $material->estoque_atual }}
                                            )"
                                            class="rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-700 transition hover:bg-gray-200"
                                        >
                                            Saída
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>


    {{-- ========================================= --}}
    {{-- MOVIMENTAÇÕES RECENTES --}}
    {{-- ========================================= --}}

    <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Cabeçalho --}}
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
                            d="M4 7h16M4 12h16M4 17h16"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-semibold text-gray-950 sm:text-lg">
                        Movimentações recentes
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Últimas movimentações realizadas no estoque.
                    </p>

                </div>

            </div>

        </div>


        @if($movimentacoes->isEmpty())

            {{-- Sem movimentações --}}
            <div class="px-6 py-10 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 7h16M4 12h16M4 17h16"
                        />
                    </svg>

                </div>

                <p class="mt-3 text-sm font-semibold text-gray-800">
                    Nenhuma movimentação registrada.
                </p>

                <p class="mt-1 text-sm text-gray-600">
                    As entradas e saídas realizadas aparecerão aqui.
                </p>

            </div>

        @else

            {{-- Tabela --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px] text-left text-sm">

                    <thead class="border-b border-gray-200 bg-gray-100">

                        <tr>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Material
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Tipo
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Quantidade
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Responsável
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-gray-600">
                                Data
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        @foreach($movimentacoes as $movimentacao)

                            <tr class="transition hover:bg-gray-50">

                                {{-- Material --}}
                                <td class="px-6 py-4">

                                    <p class="font-semibold text-gray-950">
                                        {{ $movimentacao->material->nome }}
                                    </p>

                                    <p class="mt-1 text-xs font-medium text-gray-500">
                                        {{ $movimentacao->material->unidade }}
                                    </p>

                                    @if($movimentacao->observacao)

                                        <p class="mt-2 max-w-xs text-xs text-gray-600">
                                            {{ $movimentacao->observacao }}
                                        </p>

                                    @endif

                                </td>


                                {{-- Tipo --}}
                                <td class="px-6 py-4">

                                    @if($movimentacao->tipo === 'entrada')

                                        <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Entrada
                                        </span>

                                    @else

                                        <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Saída
                                        </span>

                                    @endif

                                </td>


                                {{-- Quantidade --}}
                                <td class="px-6 py-4">

                                    @if($movimentacao->tipo === 'entrada')

                                        <span class="font-bold text-green-600">
                                            +{{ $movimentacao->quantidade }}
                                        </span>

                                    @else

                                        <span class="font-bold text-red-600">
                                            -{{ $movimentacao->quantidade }}
                                        </span>

                                    @endif

                                    <span class="text-gray-500">
                                        {{ $movimentacao->material->unidade }}
                                    </span>

                                </td>


                                {{-- Responsável --}}
                                <td class="px-6 py-4 font-medium text-gray-700">
                                    {{ $movimentacao->user->name }}
                                </td>


                                {{-- Data --}}
                                <td class="px-6 py-4 text-right">

                                    <p class="font-medium text-gray-700">
                                        {{ $movimentacao->created_at->format('d/m/Y') }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $movimentacao->created_at->format('H:i') }}
                                    </p>

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
{{-- MODAL DE ENTRADA --}}
{{-- ========================================= --}}

<div
    id="modalEntrada"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
>

    <div class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

        {{-- Cabeçalho --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

            <div>

                <h2 class="text-lg font-semibold text-gray-950">
                    Dar entrada no estoque
                </h2>

                <p
                    id="modalMaterialNome"
                    class="mt-1 text-sm text-gray-600"
                >
                    Material
                </p>

            </div>

            <button
                type="button"
                onclick="fecharModalEntrada()"
                class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>


        {{-- Conteúdo --}}
        <div class="space-y-5 px-6 py-5">

            {{-- Unidade --}}
            <div class="rounded-xl bg-gray-100 p-4">

                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Unidade
                </p>

                <p
                    id="modalMaterialUnidade"
                    class="mt-1 font-semibold text-gray-950"
                >
                    unidade
                </p>

            </div>


            {{-- Quantidade --}}
            <div>

                <label
                    for="quantidadeEntrada"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Quantidade da entrada
                </label>

                <input
                    type="number"
                    id="quantidadeEntrada"
                    min="1"
                    step="1"
                    placeholder="Digite a quantidade"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

                <p
                    id="erroQuantidadeEntrada"
                    class="mt-2 hidden text-sm font-medium text-red-600"
                >
                    Informe uma quantidade válida.
                </p>

            </div>


            {{-- Observação --}}
            <div>

                <label
                    for="observacaoEntrada"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Observação
                    <span class="font-normal text-gray-400">
                        (opcional)
                    </span>
                </label>

                <textarea
                    id="observacaoEntrada"
                    rows="3"
                    placeholder="Ex: Compra realizada, reposição de estoque..."
                    class="w-full resize-none rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                ></textarea>

            </div>

        </div>


        {{-- Rodapé --}}
        <div class="flex flex-col-reverse gap-2 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

            <button
                type="button"
                onclick="fecharModalEntrada()"
                class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
            >
                Cancelar
            </button>

            <button
                type="button"
                onclick="confirmarEntrada()"
                class="rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600"
            >
                Confirmar entrada
            </button>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- MODAL DE SAÍDA --}}
{{-- ========================================= --}}

<div
    id="modalSaida"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
>

    <div class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

        {{-- Cabeçalho --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

            <div>

                <h2 class="text-lg font-semibold text-gray-950">
                    Dar saída no estoque
                </h2>

                <p
                    id="modalSaidaMaterialNome"
                    class="mt-1 text-sm text-gray-600"
                >
                    Material
                </p>

            </div>

            <button
                type="button"
                onclick="fecharModalSaida()"
                class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>


        {{-- Conteúdo --}}
        <div class="space-y-5 px-6 py-5">

            {{-- Estoque disponível --}}
            <div class="rounded-xl bg-gray-100 p-4">

                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Estoque disponível
                </p>

                <p class="mt-1 font-bold text-gray-950">

                    <span id="modalSaidaEstoque">
                        0
                    </span>

                    <span
                        id="modalSaidaUnidade"
                        class="font-normal text-gray-500"
                    >
                        unidade
                    </span>

                </p>

            </div>


            {{-- Quantidade --}}
            <div>

                <label
                    for="quantidadeSaida"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Quantidade da saída
                </label>

                <input
                    type="number"
                    id="quantidadeSaida"
                    min="1"
                    step="1"
                    placeholder="Digite a quantidade"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

                <p
                    id="erroQuantidadeSaida"
                    class="mt-2 hidden text-sm font-medium text-red-600"
                ></p>

            </div>


            {{-- Observação --}}
            <div>

                <label
                    for="observacaoSaida"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Observação
                    <span class="font-normal text-gray-400">
                        (opcional)
                    </span>
                </label>

                <textarea
                    id="observacaoSaida"
                    rows="3"
                    placeholder="Ex: Material entregue ao setor..."
                    class="w-full resize-none rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                ></textarea>

            </div>

        </div>


        {{-- Rodapé --}}
        <div class="flex flex-col-reverse gap-2 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

            <button
                type="button"
                onclick="fecharModalSaida()"
                class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
            >
                Cancelar
            </button>

            <button
                type="button"
                onclick="confirmarSaida()"
                class="rounded-xl bg-red-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600"
            >
                Confirmar saída
            </button>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================= --}}

<script>

    let materialEntradaId = null;

    function abrirModalEntrada(id, nome, unidade)
    {
        materialEntradaId = id;

        document.getElementById('modalMaterialNome').textContent = nome;
        document.getElementById('modalMaterialUnidade').textContent = unidade;

        document.getElementById('quantidadeEntrada').value = '';
        document.getElementById('observacaoEntrada').value = '';

        document.getElementById('erroQuantidadeEntrada')
            .classList.add('hidden');

        const modal = document.getElementById('modalEntrada');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.getElementById('quantidadeEntrada').focus();
    }


    function fecharModalEntrada()
    {
        const modal = document.getElementById('modalEntrada');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        materialEntradaId = null;
    }


    function confirmarEntrada()
    {
        const quantidadeInput =
            document.getElementById('quantidadeEntrada');

        const quantidade =
            quantidadeInput.value;

        const erro =
            document.getElementById('erroQuantidadeEntrada');


        if (!quantidade || Number(quantidade) <= 0) {

            erro.classList.remove('hidden');

            quantidadeInput.focus();

            return;
        }


        erro.classList.add('hidden');


        const observacao =
            document.getElementById('observacaoEntrada').value;


        const form = document.createElement('form');

        form.method = 'POST';

        form.action = `/estoque/${materialEntradaId}/entrada`;


        // CSRF
        const csrf = document.createElement('input');

        csrf.type = 'hidden';

        csrf.name = '_token';

        csrf.value = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');


        // Quantidade
        const quantidadeHidden = document.createElement('input');

        quantidadeHidden.type = 'hidden';

        quantidadeHidden.name = 'quantidade';

        quantidadeHidden.value = quantidade;


        // Observação
        const observacaoHidden = document.createElement('input');

        observacaoHidden.type = 'hidden';

        observacaoHidden.name = 'observacao';

        observacaoHidden.value = observacao;


        form.appendChild(csrf);

        form.appendChild(quantidadeHidden);

        form.appendChild(observacaoHidden);


        document.body.appendChild(form);

        form.submit();
    }


    let materialSaidaId = null;

    let estoqueSaidaDisponivel = 0;


    function abrirModalSaida(id, nome, unidade, estoque)
    {
        materialSaidaId = id;

        estoqueSaidaDisponivel = estoque;


        document.getElementById('modalSaidaMaterialNome').textContent = nome;

        document.getElementById('modalSaidaUnidade').textContent = unidade;

        document.getElementById('modalSaidaEstoque').textContent = estoque;


        document.getElementById('quantidadeSaida').value = '';

        document.getElementById('observacaoSaida').value = '';


        const erro =
            document.getElementById('erroQuantidadeSaida');

        erro.textContent = '';

        erro.classList.add('hidden');


        const modal =
            document.getElementById('modalSaida');

        modal.classList.remove('hidden');

        modal.classList.add('flex');


        document.getElementById('quantidadeSaida').focus();
    }


    function fecharModalSaida()
    {
        const modal =
            document.getElementById('modalSaida');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        materialSaidaId = null;

        estoqueSaidaDisponivel = 0;
    }


    function confirmarSaida()
    {
        const quantidadeInput =
            document.getElementById('quantidadeSaida');

        const quantidade =
            Number(quantidadeInput.value);

        const erro =
            document.getElementById('erroQuantidadeSaida');


        erro.classList.add('hidden');

        erro.textContent = '';


        if (!quantidade || quantidade <= 0) {

            erro.textContent =
                'Informe uma quantidade válida.';

            erro.classList.remove('hidden');

            quantidadeInput.focus();

            return;
        }


        if (quantidade > estoqueSaidaDisponivel) {

            erro.textContent =
                'A quantidade não pode ser maior que o estoque disponível.';

            erro.classList.remove('hidden');

            quantidadeInput.focus();

            return;
        }


        const form =
            document.createElement('form');

        form.method = 'POST';

        form.action =
            `/estoque/${materialSaidaId}/saida`;


        // CSRF
        const csrf =
            document.createElement('input');

        csrf.type = 'hidden';

        csrf.name = '_token';

        csrf.value =
            document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');


        // Quantidade
        const quantidadeHidden =
            document.createElement('input');

        quantidadeHidden.type = 'hidden';

        quantidadeHidden.name = 'quantidade';

        quantidadeHidden.value = quantidade;


        // Observação
        const observacaoHidden =
            document.createElement('input');

        observacaoHidden.type = 'hidden';

        observacaoHidden.name = 'observacao';

        observacaoHidden.value =
            document
                .getElementById('observacaoSaida')
                .value;


        form.appendChild(csrf);

        form.appendChild(quantidadeHidden);

        form.appendChild(observacaoHidden);


        document.body.appendChild(form);

        form.submit();
    }

</script>

@endsection