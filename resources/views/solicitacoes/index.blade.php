@extends('layouts.unicontrol')

@section('content')

<div class="min-h-screen bg-gray-100 px-4 py-6 sm:px-6 lg:px-8">


{{-- ========================================= --}}
{{-- CABEÇALHO --}}
{{-- ========================================= --}}

<div class="mb-6 sm:mb-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-sm font-semibold text-orange-500">
                {{ Auth::user()->setor->nome }}
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-950 sm:text-3xl">
                Solicitações
            </h1>

            <p class="mt-2 text-sm text-gray-600 sm:text-base">
                Acompanhe as solicitações de materiais do seu setor.
            </p>

        </div>

        <a
            href="{{ route('solicitacoes.create') }}"
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

            Nova solicitação
        </a>

    </div>

</div>


{{-- ========================================= --}}
{{-- INDICADORES --}}
{{-- ========================================= --}}

@php

    $totalSolicitacoes = $solicitacoes->count();

    $emAndamento = $solicitacoes->whereIn('status', [
        'enviada',
        'em_analise',
        'aprovada',
    ])->count();

    $atendidas = $solicitacoes->where('status', 'atendida')->count();

    $rascunhos = $solicitacoes->where('status', 'rascunho')->count();

@endphp


<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

    {{-- Total --}}

    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Total de solicitações
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-950">
                    {{ $totalSolicitacoes }}
                </p>

            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

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
                        d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                    />
                </svg>

            </div>

        </div>

    </div>


    {{-- Em andamento --}}

    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Em andamento
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-950">
                    {{ $emAndamento }}
                </p>

            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-500">

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
                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>

            </div>

        </div>

    </div>


    {{-- Atendidas --}}

    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Atendidas
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-950">
                    {{ $atendidas }}
                </p>

            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-green-600">

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
                        d="M5 13l4 4L19 7"
                    />
                </svg>

            </div>

        </div>

    </div>


    {{-- Rascunhos --}}

    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Rascunhos
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-950">
                    {{ $rascunhos }}
                </p>

            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600">

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
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z"
                    />
                </svg>

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- LISTA DE SOLICITAÇÕES --}}
{{-- ========================================= --}}

<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    {{-- Cabeçalho --}}

    <div class="border-b border-gray-200 px-5 py-5 sm:px-6">

        <div>

            <h2 class="text-base font-semibold text-gray-950 sm:text-lg">
                Minhas solicitações
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Histórico e acompanhamento das solicitações realizadas pelo setor.
            </p>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- ESTADO VAZIO --}}
    {{-- ========================================= --}}

    @if($solicitacoes->isEmpty())

        <div class="px-6 py-14 text-center">

            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-500">

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
                        d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                    />
                </svg>

            </div>

            <h3 class="mt-4 text-base font-semibold text-gray-950">
                Nenhuma solicitação encontrada
            </h3>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                Seu setor ainda não possui solicitações de materiais.
                Crie uma nova solicitação para começar.
            </p>

            <a
                href="{{ route('solicitacoes.create') }}"
                class="mt-5 inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
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

                Nova solicitação
            </a>

        </div>

    @else


        {{-- ========================================= --}}
        {{-- TABELA --}}
        {{-- ========================================= --}}

        <div class="overflow-x-auto">

            <table class="w-full min-w-[800px] text-left text-sm">

                <thead class="border-b border-gray-200 bg-gray-100">

                    <tr>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Solicitação
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Itens
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Status
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Data
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wide text-gray-600">
                            Ação
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200">

                    @foreach($solicitacoes as $solicitacao)

                        @php

                            $status = match($solicitacao->status) {

                                'rascunho' => [
                                    'label' => 'Rascunho',
                                    'class' => 'bg-gray-100 text-gray-700'
                                ],

                                'enviada' => [
                                    'label' => 'Enviada',
                                    'class' => 'bg-blue-100 text-blue-700'
                                ],

                                'em_analise' => [
                                    'label' => 'Em análise',
                                    'class' => 'bg-orange-100 text-orange-700'
                                ],

                                'aprovada' => [
                                    'label' => 'Aprovada',
                                    'class' => 'bg-green-100 text-green-700'
                                ],

                                'rejeitada' => [
                                    'label' => 'Rejeitada',
                                    'class' => 'bg-red-100 text-red-700'
                                ],

                                'atendida' => [
                                    'label' => 'Atendida',
                                    'class' => 'bg-green-100 text-green-700'
                                ],

                                'cancelada' => [
                                    'label' => 'Cancelada',
                                    'class' => 'bg-gray-100 text-gray-600'
                                ],

                                default => [
                                    'label' => ucfirst($solicitacao->status),
                                    'class' => 'bg-gray-100 text-gray-700'
                                ]

                            };

                            $quantidadeItens =
                                $solicitacao->itens->count();

                        @endphp


                        <tr class="transition hover:bg-gray-50">

                            {{-- Solicitação --}}

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

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
                                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-950">
                                            Solicitação #{{ str_pad($solicitacao->id, 4, '0', STR_PAD_LEFT) }}
                                        </p>

                                        @if($solicitacao->observacao)

                                            <p class="mt-1 max-w-xs truncate text-xs text-gray-500">
                                                {{ $solicitacao->observacao }}
                                            </p>

                                        @else

                                            <p class="mt-1 text-xs text-gray-400">
                                                Sem observação
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Itens --}}

                            <td class="px-5 py-4">

                                <span class="font-semibold text-gray-800">
                                    {{ $quantidadeItens }}
                                </span>

                                <span class="text-gray-500">
                                    {{ $quantidadeItens === 1 ? 'item' : 'itens' }}
                                </span>

                            </td>


                            {{-- Status --}}

                            <td class="px-5 py-4">

                                <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-semibold {{ $status['class'] }}">
                                    {{ $status['label'] }}
                                </span>

                            </td>


                            {{-- Data --}}

                            <td class="px-5 py-4">

                                <p class="font-medium text-gray-800">
                                    {{ $solicitacao->created_at->format('d/m/Y') }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $solicitacao->created_at->format('H:i') }}
                                </p>

                            </td>


                            {{-- Ação --}}

                            <td class="px-5 py-4 text-right">

                                <a
                                    href="{{ route('solicitacoes.show', $solicitacao) }}"
                                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200"
                                >
                                    Ver detalhes
                                </a>

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
