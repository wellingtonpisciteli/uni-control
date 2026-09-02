@extends('layouts.unicontrol')

@section('content')

<div class="min-h-screen bg-gray-100 px-4 py-6 sm:px-6 lg:px-8">

    {{-- ========================================= --}}
    {{-- CABEÇALHO --}}
    {{-- ========================================= --}}

    <div class="mb-6 sm:mb-8">

        <a
            href="{{ route('solicitacoes.index') }}"
            class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-gray-500 transition hover:text-orange-500"
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

            Voltar para solicitações
        </a>


        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div class="min-w-0">

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


                <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-950 sm:text-3xl">
                    #{{ str_pad($solicitacao->id, 4, '0', STR_PAD_LEFT) }}
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Detalhes e acompanhamento da solicitação de materiais.
                </p>

            </div>


            {{-- STATUS --}}

           <div class="inline-flex w-fit items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold {{ $status['class'] }}">

                <span class="h-2 w-2 rounded-full {{ $status['dot'] }}"></span>

                {{ $status['label'] }}

            </div>

        </div>

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

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($solicitacao->itens as $item)

                            @php

                                $statusItem = match($item->status) {

                                    'pendente' => [
                                        'label' => 'Pendente',
                                        'class' => 'bg-gray-100 text-gray-700',
                                        'dot' => 'bg-gray-400'
                                    ],

                                    'em_compra' => [
                                        'label' => 'Em compra',
                                        'class' => 'bg-orange-100 text-orange-700',
                                        'dot' => 'bg-orange-500'
                                    ],

                                    'parcialmente_atendido' => [
                                        'label' => 'Parcialmente atendido',
                                        'class' => 'bg-blue-100 text-blue-700',
                                        'dot' => 'bg-blue-500'
                                    ],

                                    'atendido' => [
                                        'label' => 'Atendido',
                                        'class' => 'bg-green-100 text-green-700',
                                        'dot' => 'bg-green-500'
                                    ],

                                    'cancelado' => [
                                        'label' => 'Cancelado',
                                        'class' => 'bg-red-100 text-red-700',
                                        'dot' => 'bg-red-500'
                                    ],

                                    default => [
                                        'label' => ucfirst($item->status),
                                        'class' => 'bg-gray-100 text-gray-700',
                                        'dot' => 'bg-gray-400'
                                    ]

                                };


                                $percentualAtendido = $item->quantidade > 0
                                    ? min(
                                        100,
                                        round(
                                            ($item->quantidade_atendida / $item->quantidade) * 100
                                        )
                                    )
                                    : 0;

                            @endphp


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

                                            <div
                                                class="h-full rounded-full bg-orange-500 transition-all"
                                                style="width: {{ $percentualAtendido }}%;"
                                            ></div>

                                        </div>

                                    </div>

                                </td>


                                {{-- STATUS --}}

                                <td class="px-5 py-5 align-top">

                                    <span class="inline-flex items-center gap-2 rounded-lg px-3 py-1.5 text-xs font-semibold {{ $statusItem['class'] }}">

                                        <span class="h-1.5 w-1.5 rounded-full {{ $statusItem['dot'] }}"></span>

                                        {{ $statusItem['label'] }}

                                    </span>

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

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

@endsection