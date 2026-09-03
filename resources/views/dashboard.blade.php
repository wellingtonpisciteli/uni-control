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

                    @if($setorNome)
                        <span class="mx-1 text-slate-300">•</span>
                        {{ $setorNome }}
                    @endif
                </p>

                <h1 class="text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">
                    Dashboard
                </h1>

                <p class="mt-2 text-sm text-slate-500 sm:text-base">
                    Visão geral das atividades e recursos do seu setor.
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

            {{-- MATERIAIS --}}
            <a href="{{ route('estoque.index') }}"
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
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>

                            </svg>

                        </div>

                        <span class="text-slate-300 transition group-hover:text-orange-500">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-slate-500">
                        Materiais em estoque
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $totalMateriais }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Materiais cadastrados no setor
                    </p>

                </div>

            </a>


            {{-- SOLICITAÇÕES --}}
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
                        Solicitações
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $totalSolicitacoes }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Solicitações realizadas
                    </p>

                </div>

            </a>


            {{-- MOVIMENTAÇÕES --}}
            <a href="{{ route('estoque.index') }}"
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
                        Movimentações
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $totalMovimentacoes }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Entradas e saídas registradas
                    </p>

                </div>

            </a>


            {{-- ESTOQUE BAIXO --}}
            <a href="{{ route('estoque.index') }}"
               class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-red-200 hover:shadow-md">

                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-red-50 transition group-hover:bg-red-100"></div>

                <div class="relative">

                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"/>

                            </svg>

                        </div>

                        <span class="text-slate-300 transition group-hover:text-red-500">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-slate-500">
                        Estoque baixo
                    </p>

                    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $estoqueBaixo }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Materiais que precisam de atenção
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
            <div class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-start justify-between border-b border-slate-100 px-5 py-5">

                    <div class="min-w-0">

                        <h2 class="text-base font-bold text-slate-900">
                            Solicitações recentes
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            Últimas solicitações realizadas
                        </p>

                    </div>

                    <a href="{{ route('solicitacoes.index') }}"
                       class="ml-3 shrink-0 rounded-lg px-2 py-1.5 text-xs font-semibold text-orange-600 transition hover:bg-orange-50">
                        Ver todas
                    </a>

                </div>


                @if($solicitacoesRecentes->count())

                    <div class="divide-y divide-slate-100">

                        @foreach($solicitacoesRecentes as $solicitacao)

                            <a href="{{ route('solicitacoes.show', $solicitacao) }}"
                               class="flex items-center justify-between gap-3 px-5 py-4 transition hover:bg-slate-50">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                                        <svg class="h-4 w-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-slate-800">
                                            Solicitação #{{ $solicitacao->id }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[11px] text-slate-400">
                                            {{ $solicitacao->created_at->format('d/m/Y H:i') }}
                                        </p>

                                    </div>

                                </div>


                                @switch($solicitacao->status)

                                    @case('pendente')
                                    @case('aguardando')

                                        <span class="shrink-0 rounded-full bg-amber-100 px-2.5 py-1 text-[10px] font-semibold text-amber-700">
                                            Pendente
                                        </span>

                                        @break

                                    @case('aprovada')
                                    @case('aprovado')

                                        <span class="shrink-0 rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-semibold text-emerald-700">
                                            Aprovada
                                        </span>

                                        @break

                                    @case('em_andamento')

                                        <span class="shrink-0 rounded-full bg-blue-100 px-2.5 py-1 text-[10px] font-semibold text-blue-700">
                                            Em andamento
                                        </span>

                                        @break

                                    @case('atendida')
                                    @case('concluida')
                                    @case('concluída')

                                        <span class="shrink-0 rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-semibold text-emerald-700">
                                            Concluída
                                        </span>

                                        @break

                                    @case('cancelada')
                                    @case('cancelado')

                                        <span class="shrink-0 rounded-full bg-red-100 px-2.5 py-1 text-[10px] font-semibold text-red-700">
                                            Cancelada
                                        </span>

                                        @break

                                    @default

                                        <span class="shrink-0 rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-semibold text-slate-600">
                                            {{ ucfirst(str_replace('_', ' ', $solicitacao->status)) }}
                                        </span>

                                @endswitch

                            </a>

                        @endforeach

                    </div>

                @else

                    <div class="flex min-h-[300px] flex-1 flex-col items-center justify-center px-5 py-10 text-center">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

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

                        <p class="mt-3 text-sm font-semibold text-slate-700">
                            Nenhuma solicitação recente
                        </p>

                        <p class="mt-1 text-xs leading-5 text-slate-400">
                            As solicitações realizadas pelo setor aparecerão aqui.
                        </p>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                MOVIMENTAÇÕES RECENTES
            ====================================================== --}}
            <div class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-start justify-between border-b border-slate-100 px-5 py-5">

                    <div class="min-w-0">

                        <h2 class="text-base font-bold text-slate-900">
                            Últimas movimentações
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            Entradas e saídas recentes
                        </p>

                    </div>

                    <a href="{{ route('estoque.index') }}"
                       class="ml-3 shrink-0 rounded-lg px-2 py-1.5 text-xs font-semibold text-orange-600 transition hover:bg-orange-50">
                        Ver todas
                    </a>

                </div>


                @if($movimentacoesRecentes->count())

                    <div class="divide-y divide-slate-100">

                        @foreach($movimentacoesRecentes as $movimentacao)

                            <div class="flex items-center justify-between gap-3 px-5 py-4">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg
                                        {{ $movimentacao->tipo === 'entrada'
                                            ? 'bg-emerald-50 text-emerald-600'
                                            : 'bg-red-50 text-red-600' }}">

                                        @if($movimentacao->tipo === 'entrada')

                                            <svg class="h-4 w-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.8"
                                                      d="M7 16V4m0 0L3 8m4-4l4 4"/>

                                            </svg>

                                        @else

                                            <svg class="h-4 w-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.8"
                                                      d="M17 8v12m0 0l4-4m-4 4l-4-4"/>

                                            </svg>

                                        @endif

                                    </div>


                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-slate-800">
                                            {{ $movimentacao->material?->nome ?? 'Material removido' }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[11px] text-slate-400">

                                            {{ $movimentacao->user?->name ?? 'Usuário' }}

                                            <span class="mx-1">
                                                •
                                            </span>

                                            {{ $movimentacao->created_at->format('d/m/Y H:i') }}

                                        </p>

                                    </div>

                                </div>


                                <div class="shrink-0 text-right">

                                    <p class="text-sm font-bold
                                        {{ $movimentacao->tipo === 'entrada'
                                            ? 'text-emerald-600'
                                            : 'text-red-600' }}">

                                        {{ $movimentacao->tipo === 'entrada' ? '+' : '-' }}
                                        {{ $movimentacao->quantidade }}
                                        {{ $movimentacao->material?->unidade ?? '' }}

                                    </p>

                                    <p class="mt-0.5 text-[10px] font-medium uppercase tracking-wide text-slate-400">
                                        {{ $movimentacao->tipo === 'entrada' ? 'Entrada' : 'Saída' }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="flex min-h-[300px] flex-1 flex-col items-center justify-center px-5 py-10 text-center">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

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

                        <p class="mt-3 text-sm font-semibold text-slate-700">
                            Nenhuma movimentação registrada
                        </p>

                        <p class="mt-1 text-xs leading-5 text-slate-400">
                            As movimentações aparecerão aqui conforme forem realizadas.
                        </p>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                SITUAÇÃO DO ESTOQUE
            ====================================================== --}}
            <div class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5">

                    <h2 class="text-base font-bold text-slate-900">
                        Situação do estoque
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Resumo dos níveis atuais
                    </p>

                </div>


                <div class="flex flex-1 flex-col p-5">

                    <div class="space-y-3">

                        {{-- NORMAL --}}
                        <div class="flex items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50/70 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100">

                                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>

                                </span>

                                <span class="text-sm font-semibold text-slate-700">
                                    Estoque normal
                                </span>

                            </div>

                            <span class="text-lg font-bold text-emerald-600">
                                {{ $estoqueNormal }}
                            </span>

                        </div>


                        {{-- BAIXO --}}
                        <div class="flex items-center justify-between rounded-xl border border-amber-100 bg-amber-50/70 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100">

                                    <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>

                                </span>

                                <span class="text-sm font-semibold text-slate-700">
                                    Estoque baixo
                                </span>

                            </div>

                            <span class="text-lg font-bold text-amber-600">
                                {{ $estoqueBaixo }}
                            </span>

                        </div>


                        {{-- SEM ESTOQUE --}}
                        <div class="flex items-center justify-between rounded-xl border border-red-100 bg-red-50/70 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100">

                                    <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>

                                </span>

                                <span class="text-sm font-semibold text-slate-700">
                                    Sem estoque
                                </span>

                            </div>

                            <span class="text-lg font-bold text-red-600">
                                {{ $semEstoque }}
                            </span>

                        </div>

                    </div>


                    <div class="mt-auto pt-5">

                        <a href="{{ route('estoque.index') }}"
                           class="flex w-full items-center justify-center rounded-xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                            Acessar estoque
                        </a>

                    </div>

                </div>

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