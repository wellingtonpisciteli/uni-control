@extends('layouts.unicontrol')

@section('content')

<div class="min-h-screen bg-gray-100 px-4 py-6 sm:px-6 lg:px-8">

    {{-- ========================================= --}}
    {{-- CABEÇALHO --}}
    {{-- ========================================= --}}

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex flex-wrap items-center gap-2">

                <p class="text-sm font-semibold text-orange-500">
                    {{ $solicitacao->setor->nome }}
                </p>

                <span class="text-gray-300">
                    •
                </span>

                <p class="text-sm text-gray-500">
                    Solicitação
                </p>

            </div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-950 sm:text-3xl">
                    #{{ str_pad($solicitacao->id, 4, '0', STR_PAD_LEFT) }}
                </h1>


                {{-- STATUS --}}

                @if($solicitacao->status === 'rascunho')

                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-700">
                        <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                        Rascunho
                    </div>

                @elseif($solicitacao->status === 'enviada')

                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-orange-100 px-4 py-2.5 text-sm font-semibold text-orange-700">
                        <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                        Enviada
                    </div>

                @elseif($solicitacao->status === 'em_analise')

                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-blue-100 px-4 py-2.5 text-sm font-semibold text-blue-700">
                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                        Em análise
                    </div>

                @elseif($solicitacao->status === 'aprovada')

                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-green-100 px-4 py-2.5 text-sm font-semibold text-green-700">
                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                        Aprovada
                    </div>

                @elseif($solicitacao->status === 'rejeitada')

                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-red-100 px-4 py-2.5 text-sm font-semibold text-red-700">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        Rejeitada
                    </div>

                @elseif($solicitacao->status === 'atendida')

                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-green-100 px-4 py-2.5 text-sm font-semibold text-green-700">
                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                        Atendida
                    </div>

                @elseif($solicitacao->status === 'cancelada')

                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-red-100 px-4 py-2.5 text-sm font-semibold text-red-700">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        Cancelada
                    </div>

                @endif

            </div>

            <p class="mt-2 text-sm text-gray-500">
                Detalhes e atendimento da solicitação de materiais.
            </p>

        </div>


        <a href="{{ route('solicitacoesCompras.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-200">

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                />

            </svg>

            Voltar

        </a>

    </div>


    {{-- ========================================= --}}
    {{-- RESUMO --}}
    {{-- ========================================= --}}

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">


        {{-- DATA --}}

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                        />

                    </svg>

                </div>


                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Solicitação criada
                    </p>

                    <p class="mt-1 font-semibold text-gray-950">
                        {{ $solicitacao->created_at->format('d/m/Y') }}
                    </p>

                    <p class="mt-0.5 text-xs text-gray-500">
                        às {{ $solicitacao->created_at->format('H:i') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- SOLICITANTE --}}

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19a4 4 0 00-8 0m4-8a3 3 0 100-6 3 3 0 000 6zm8 8a4 4 0 00-3-3.87M17 5.13a3 3 0 010 5.74"
                        />

                    </svg>

                </div>


                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Solicitante
                    </p>

                    <p class="mt-1 truncate font-semibold text-gray-950">
                        {{ $solicitacao->usuario->name }}
                    </p>

                    <p class="mt-0.5 truncate text-xs text-gray-500">
                        {{ $solicitacao->setor->nome }}
                    </p>

                </div>

            </div>

        </div>


        {{-- ITENS --}}

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>

                </div>


                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Materiais
                    </p>

                    <p class="mt-1 font-semibold text-gray-950">
                        {{ $solicitacao->itens->count() }}
                        {{ $solicitacao->itens->count() === 1 ? 'item' : 'itens' }}
                    </p>

                    <p class="mt-0.5 text-xs text-gray-500">
                        Nesta solicitação
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- APROVAÇÃO FINANCEIRA --}}
    {{-- ========================================= --}}

    @if($solicitacao->requer_aprovacao_financeira)

        <div class="mb-6 rounded-2xl border border-orange-200 bg-orange-50 px-5 py-4">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v2m0 4h.01M10.29 3.86l-8.13 14A2 2 0 013.87 21h16.26a2 2 0 001.71-3.14l-8.13-14a2 2 0 00-3.42 0z"
                        />

                    </svg>

                </div>


                <div>

                    <p class="text-sm font-semibold text-orange-900">
                        Requer aprovação financeira
                    </p>

                    <p class="mt-1 text-sm leading-6 text-orange-800">
                        Esta solicitação foi marcada pelo setor como superior a
                        <strong>R$ 1.000,00</strong>
                        e deverá passar pela aprovação do Diretor Financeiro.
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- ========================================= --}}
    {{-- OBSERVAÇÃO GERAL --}}
    {{-- ========================================= --}}

    @if($solicitacao->observacao)

        <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 10h8M8 14h5m7-2a8 8 0 11-16 0 8 8 0 0016 0z"
                        />

                    </svg>

                </div>


                <div class="min-w-0">

                    <p class="text-sm font-semibold text-gray-950">
                        Observação geral
                    </p>

                    <p class="mt-1 whitespace-pre-line text-sm leading-6 text-gray-600">
                        {{ $solicitacao->observacao }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- ========================================= --}}
    {{-- MATERIAIS --}}
    {{-- ========================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 px-5 py-5 sm:px-6">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-base font-bold text-gray-950 sm:text-lg">
                        Materiais solicitados
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Acompanhe as quantidades solicitadas e atendidas.
                    </p>

                </div>


                <span class="inline-flex w-fit items-center rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">

                    {{ $solicitacao->itens->count() }}

                    {{ $solicitacao->itens->count() === 1 ? 'item' : 'itens' }}

                </span>

            </div>

        </div>


        @if($solicitacao->itens->isEmpty())

            <div class="px-6 py-14 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-500">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>

                </div>


                <h3 class="mt-4 text-base font-semibold text-gray-950">
                    Nenhum item encontrado
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Esta solicitação ainda não possui materiais registrados.
                </p>

            </div>

        @else

            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px] text-left text-sm">

                    <thead class="border-b border-gray-200 bg-gray-50">

                        <tr>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-500">
                                Material
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-500">
                                Solicitada
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-500">
                                Atendida
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-500">
                                Status
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-500">
                                Observação
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Ação
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($solicitacao->itens as $item)

                            <tr class="transition hover:bg-gray-50">


                                {{-- MATERIAL --}}

                                <td class="px-5 py-5 align-top">

                                    <div class="min-w-[180px]">

                                        <p class="font-semibold text-gray-950">
                                            {{ $item->material->nome }}
                                        </p>

                                        @if($item->material->categoria)

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $item->material->categoria }}
                                            </p>

                                        @endif

                                    </div>

                                </td>


                                {{-- SOLICITADA --}}

                                <td class="px-5 py-5 align-top">

                                    <div>

                                        <p class="font-semibold text-gray-950">
                                            {{ $item->quantidade }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-gray-500">
                                            {{ $item->material->unidade }}
                                        </p>

                                    </div>

                                </td>


                                {{-- ATENDIDA --}}

                                <td class="px-5 py-5 align-top">

                                    <div class="min-w-[130px]">

                                        <div class="flex items-baseline gap-1">

                                            <span class="font-semibold text-gray-950">
                                                {{ $item->quantidade_atendida }}
                                            </span>

                                            <span class="text-xs text-gray-500">
                                                / {{ $item->quantidade }}
                                            </span>

                                        </div>

                                        <p class="mt-0.5 text-xs text-gray-500">
                                            {{ $item->material->unidade }}
                                        </p>


                                        {{-- Barra de progresso --}}

                                        <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-gray-100">

                                            @if($item->quantidade > 0)

                                                <div
                                                    class="h-full rounded-full bg-orange-500 transition-all"
                                                    style="width: {{ min(100, round(($item->quantidade_atendida / $item->quantidade) * 100)) }}%;"
                                                ></div>

                                            @else

                                                <div
                                                    class="h-full rounded-full bg-orange-500"
                                                    style="width: 0%;"
                                                ></div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- STATUS --}}

                                <td class="px-5 py-5 align-top">

                                    @if($item->status === 'pendente')

                                        <span class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                            Pendente
                                        </span>

                                    @elseif($item->status === 'em_compra')

                                        <span class="inline-flex items-center gap-2 rounded-lg bg-orange-100 px-3 py-1.5 text-xs font-semibold text-orange-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                            Em compra
                                        </span>

                                    @elseif($item->status === 'parcialmente_atendido')

                                        <span class="inline-flex items-center gap-2 rounded-lg bg-blue-100 px-3 py-1.5 text-xs font-semibold text-blue-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                            Parcialmente atendido
                                        </span>

                                    @elseif($item->status === 'atendido')

                                        <span class="inline-flex items-center gap-2 rounded-lg bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                            Atendido
                                        </span>

                                    @elseif($item->status === 'cancelado')

                                        <span class="inline-flex items-center gap-2 rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                            Cancelado
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    @endif

                                </td>


                                {{-- OBSERVAÇÃO --}}

                                <td class="px-5 py-5 align-top">

                                    @if($item->observacao)

                                        <div class="max-w-xs">

                                            <p class="whitespace-pre-line text-sm leading-5 text-gray-600">
                                                {{ $item->observacao }}
                                            </p>

                                        </div>

                                    @else

                                        <span class="text-sm text-gray-300">
                                            —
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4 text-right">

                                    <button
                                        type="button"
                                        onclick="abrirModalResposta(
                                            {{ $item->id }},
                                            '{{ addslashes($item->material->nome) }}',
                                            {{ $item->quantidade }},
                                            {{ $item->quantidade_atendida }},
                                            '{{ addslashes($item->material->unidade) }}',
                                            '{{ $item->status }}',
                                            '{{ addslashes($item->observacao ?? '') }}'
                                        )"
                                        class="inline-flex items-center rounded-lg bg-orange-500 px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-orange-600"
                                    >
                                        Responder
                                    </button>

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
{{-- MODAL DE RESPOSTA --}}
{{-- ========================================= --}}

<div
    id="modalResposta"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
>

    <div
        id="conteudoModalResposta"
        class="w-full max-w-lg overflow-hidden rounded-2xl bg-white text-left shadow-2xl"
    >

        {{-- CABEÇALHO --}}

        <div class="flex items-start justify-between border-b border-gray-200 px-6 py-5">

            <div>

                <p class="text-xs font-semibold uppercase tracking-wide text-orange-500">
                    Atendimento
                </p>

                <h2 class="mt-1 text-xl font-bold text-gray-950">
                    Responder item
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Informe como este material será atendido.
                </p>

            </div>

            <button
                type="button"
                onclick="fecharModalResposta()"
                class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600"
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
                        d="M6 18L18 6M6 6l12 12"
                    />

                </svg>

            </button>

        </div>


        {{-- CONTEÚDO --}}

        <div class="space-y-5 px-6 py-6">

            {{-- MATERIAL --}}

            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">

                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                    Material
                </p>

                <p
                    id="modalMaterial"
                    class="mt-1 text-base font-bold text-gray-950"
                >
                </p>

                <div class="mt-3 flex gap-6">

                    <div>

                        <p class="text-xs text-gray-400">
                            Solicitada
                        </p>

                        <p
                            id="modalQuantidade"
                            class="mt-0.5 font-semibold text-gray-900"
                        >
                        </p>

                    </div>

                    <div>

                        <p class="text-xs text-gray-400">
                            Já atendida
                        </p>

                        <p
                            id="modalQuantidadeAtendida"
                            class="mt-0.5 font-semibold text-gray-900"
                        >
                        </p>

                    </div>

                </div>

            </div>


            {{-- QUANTIDADE --}}

            <div>

                <label
                    for="modalQuantidadeInput"
                    class="block text-sm font-semibold text-gray-700"
                >
                    Quantidade a atender
                </label>

                <input
                    id="modalQuantidadeInput"
                    type="number"
                    min="0"
                    class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                >

                <p
                    id="modalQuantidadeAjuda"
                    class="mt-1.5 text-xs text-gray-500"
                >
                </p>

            </div>


            {{-- OBSERVAÇÃO --}}

            <div>

                <label
                    for="modalObservacao"
                    class="block text-sm font-semibold text-gray-700"
                >
                    Observação
                </label>

                <textarea
                    id="modalObservacao"
                    rows="3"
                    placeholder="Adicione uma observação sobre o atendimento..."
                    class="mt-2 w-full resize-none rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                ></textarea>

            </div>

        </div>


        {{-- RODAPÉ --}}

        <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">

            <button
                type="button"
                onclick="fecharModalResposta()"
                class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
            >
                Cancelar
            </button>

            <button
                type="button"
                class="rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-600"
            >
                Confirmar atendimento
            </button>

        </div>

    </div>

</div>

<script>

    let itemSelecionado = null;

    function abrirModalResposta(
        id,
        material,
        quantidade,
        quantidadeAtendida,
        unidade,
        status,
        observacao
    ) {

        itemSelecionado = id;

        document.getElementById('modalMaterial').textContent = material;

        document.getElementById('modalQuantidade').textContent =
            quantidade + ' ' + unidade;

        document.getElementById('modalQuantidadeAtendida').textContent =
            quantidadeAtendida + ' ' + unidade;

        const input = document.getElementById('modalQuantidadeInput');

        input.max = quantidade - quantidadeAtendida;

        input.value = quantidade - quantidadeAtendida;

        document.getElementById('modalQuantidadeAjuda').textContent =
            'Restante: ' + (quantidade - quantidadeAtendida) + ' ' + unidade;

        document.getElementById('modalObservacao').value = observacao;

        const modal = document.getElementById('modalResposta');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function fecharModalResposta() {

        const modal = document.getElementById('modalResposta');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        itemSelecionado = null;
    }


    document.getElementById('modalResposta').addEventListener('click', function(event) {

        if (event.target === this) {
            fecharModalResposta();
        }

    });

</script>

@endsection

