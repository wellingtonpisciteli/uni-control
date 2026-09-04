@extends('layouts.unicontrol')

@section('content')

<div class="min-h-full bg-slate-50">

    <div class="w-full px-5 py-6 sm:px-7 lg:px-9 xl:px-10 2xl:px-12">

        {{-- =========================================================
            CABEÇALHO
        ========================================================== --}}
        <div class="mb-7 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>
        
                <p class="mb-1 text-sm font-semibold tracking-wide text-orange-600">
                    Setor
                    <span class="mx-1 text-slate-300">•</span>
                    Compras
                </p>

                <h1 class="text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">
                    Dashboard
                </h1>

                <p class="mt-2 text-sm text-slate-500 sm:text-base">
                    Visão geral das solicitações e atividades do setor de compras.
                </p>

            </div>


            {{-- DATA --}}
            <div class="flex items-center gap-3 lg:pb-1">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-slate-200">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/>

                    </svg>

                </div>

                <div>

                    <p class="text-[11px] font-medium uppercase tracking-wider text-slate-400">
                        Hoje
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ now()->translatedFormat('d \d\e F \d\e Y') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- =========================================================
            INDICADORES
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- SOLICITAÇÕES PENDENTES --}}
            <a href="{{ route('solicitacoes.index') }}"
               class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-orange-200 hover:shadow-md">

                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-orange-50 transition group-hover:bg-orange-100"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                            </svg>

                        </div>

                        <span class="text-slate-300 transition group-hover:text-orange-500">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-slate-500">
                        Solicitações pendentes
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $solicitacoesPendentes }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Aguardando análise
                    </p>

                </div>

            </a>


            {{-- EM ANÁLISE --}}
            <a href="{{ route('solicitacoes.index') }}"
               class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">

                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-blue-50 transition group-hover:bg-blue-100"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                            </svg>

                        </div>

                        <span class="text-slate-300 transition group-hover:text-blue-500">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-slate-500">
                        Em análise
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $solicitacoesEmAnalise }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Solicitações sendo avaliadas
                    </p>

                </div>

            </a>


            {{-- EM ANDAMENTO --}}
            <a href="{{ route('solicitacoes.index') }}"
               class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">

                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-emerald-50 transition group-hover:bg-emerald-100"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4"/>

                            </svg>

                        </div>

                        <span class="text-slate-300 transition group-hover:text-emerald-500">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-slate-500">
                        Solicitações aprovadas
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $solicitacoesAprovadas }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Aguardando atendimento
                    </p>

                </div>

            </a>


            {{-- ATENDIDAS --}}
            <a href="{{ route('solicitacoes.index') }}"
               class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-purple-200 hover:shadow-md">

                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-purple-50 transition group-hover:bg-purple-100"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-600">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                        </div>

                        <span class="text-slate-300 transition group-hover:text-purple-500">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-slate-500">
                        Solicitações atendidas
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $solicitacoesAtendidas }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Solicitações concluídas
                    </p>

                </div>

            </a>

        </div>


        {{-- =========================================================
            PAINÉIS PRINCIPAIS
        ========================================================== --}}
        <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">


            {{-- =====================================================
                SOLICITAÇÕES RECENTES
            ====================================================== --}}
            <div class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-2">

                <div class="flex items-start justify-between border-b border-slate-100 px-5 py-5">

                    <div class="min-w-0">

                        <h2 class="text-base font-bold text-slate-900">
                            Solicitações recentes
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            Últimas solicitações enviadas pelos setores
                        </p>

                    </div>

                    <a href="{{ route('solicitacoes.index') }}"
                       class="ml-3 shrink-0 rounded-lg px-2 py-1.5 text-xs font-semibold text-orange-600 transition hover:bg-orange-50">
                        Ver todas
                    </a>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="border-b border-slate-100 bg-slate-50">

                            <tr>

                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Solicitação
                                </th>

                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Setor
                                </th>

                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Status
                                </th>

                                <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Data
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($solicitacoesRecentes as $solicitacao)

                                <tr class="transition hover:bg-slate-50">

                                    <td class="px-5 py-4">

                                        <p class="text-sm font-semibold text-slate-700">
                                            #{{ $solicitacao->id }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            {{ $solicitacao->usuario?->name ?? 'Usuário' }}
                                        </p>

                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-600">
                                        {{ $solicitacao->setor?->nome ?? '—' }}
                                    </td>

                                    <td class="px-5 py-4">

                                        @php
                                            $statusClasses = match ($solicitacao->status) {
                                                'enviada' => 'bg-amber-100 text-amber-700',
                                                'em_analise' => 'bg-blue-100 text-blue-700',
                                                'aprovada' => 'bg-emerald-100 text-emerald-700',
                                                'atendida' => 'bg-purple-100 text-purple-700',
                                                'rejeitada' => 'bg-red-100 text-red-700',
                                                'cancelada' => 'bg-slate-100 text-slate-600',
                                                default => 'bg-slate-100 text-slate-600',
                                            };

                                            $statusLabel = match ($solicitacao->status) {
                                                'enviada' => 'Pendente',
                                                'em_analise' => 'Em análise',
                                                'aprovada' => 'Aprovada',
                                                'atendida' => 'Atendida',
                                                'rejeitada' => 'Rejeitada',
                                                'cancelada' => 'Cancelada',
                                                default => ucfirst($solicitacao->status),
                                            };
                                        @endphp

                                        <span class="inline-flex rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>

                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-500">
                                        {{ $solicitacao->created_at->format('d/m/Y') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="px-5 py-8 text-center text-sm text-slate-400">
                                        Nenhuma solicitação recente
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =====================================================
                FILA DE ATENDIMENTO
            ====================================================== --}}
            <div class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5">

                    <h2 class="text-base font-bold text-slate-900">
                        Fila de atendimento
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Solicitações que precisam de atenção
                    </p>

                </div>


                <div class="flex flex-1 flex-col p-5">

                    <div class="space-y-3">

                        {{-- PRIORIDADE --}}
                        <div class="flex items-center justify-between rounded-xl border border-red-100 bg-red-50/70 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100">

                                    <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>

                                </span>

                                <div>

                                    <p class="text-sm font-semibold text-slate-700">
                                        Prioridade alta
                                    </p>

                                    <p class="mt-0.5 text-[11px] text-slate-400">
                                        Atendimento imediato
                                    </p>

                                </div>

                            </div>

                            <span class="text-lg font-bold text-red-600">
                                0
                            </span>

                        </div>


                        {{-- PENDENTES --}}
                        <div class="flex items-center justify-between rounded-xl border border-amber-100 bg-amber-50/70 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100">

                                    <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>

                                </span>

                                <div>

                                    <p class="text-sm font-semibold text-slate-700">
                                        Pendentes
                                    </p>

                                    <p class="mt-0.5 text-[11px] text-slate-400">
                                        Aguardando análise
                                    </p>

                                </div>

                            </div>

                            <span class="text-lg font-bold text-amber-600">
                                0
                            </span>

                        </div>


                        {{-- EM ANDAMENTO --}}
                        <div class="flex items-center justify-between rounded-xl border border-blue-100 bg-blue-50/70 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100">

                                    <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>

                                </span>

                                <div>

                                    <p class="text-sm font-semibold text-slate-700">
                                        Em andamento
                                    </p>

                                    <p class="mt-0.5 text-[11px] text-slate-400">
                                        Compras em processo
                                    </p>

                                </div>

                            </div>

                            <span class="text-lg font-bold text-blue-600">
                                0
                            </span>

                        </div>

                    </div>


                    <div class="mt-auto pt-5">

                        <a href="{{ route('solicitacoes.index') }}"
                           class="flex w-full items-center justify-center rounded-xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                            Acessar solicitações
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            RESUMO POR SETOR
        ========================================================== --}}
        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-5">

                <h2 class="text-base font-bold text-slate-900">
                    Resumo por setor
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    Acompanhe a demanda de cada setor
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="border-b border-slate-100 bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Setor
                            </th>

                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Pendentes
                            </th>

                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Em andamento
                            </th>

                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        <tr>

                            <td class="px-5 py-5 text-sm text-slate-400">
                                Nenhum setor com solicitações
                            </td>

                            <td class="px-5 py-5 text-sm text-slate-400">
                                0
                            </td>

                            <td class="px-5 py-5 text-sm text-slate-400">
                                0
                            </td>

                            <td class="px-5 py-5 text-sm font-semibold text-slate-400">
                                0
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =========================================================
        BOTÃO IA
    ========================================================== --}}
    <button
        type="button"
        title="Assistente IA"
        class="group fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-lg transition-all duration-200 hover:-translate-y-1 hover:bg-orange-600 hover:shadow-xl">

        <svg class="h-6 w-6 transition-transform duration-200 group-hover:scale-110"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.8"
                  d="M12 3v2m0 14v2M5.64 5.64l1.42 1.42m9.88 9.88l1.42 1.42M3 12h2m14 0h2M5.64 18.36l1.42-1.42m9.88-9.88l1.42-1.42M15.5 12a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0z"/>

        </svg>

        <span class="absolute right-0 top-0 h-3 w-3 rounded-full border-2 border-white bg-orange-500"></span>

    </button>

</div>

@endsection
