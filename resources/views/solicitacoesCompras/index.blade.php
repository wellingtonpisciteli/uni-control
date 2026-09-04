@extends('layouts.unicontrol')

@section('content')

<div class="min-h-screen bg-gray-100 px-4 py-6 sm:px-6 lg:px-8">

{{-- ========================================= --}}
{{-- CABEÇALHO --}}
{{-- ========================================= --}}

<div class="mb-6 sm:mb-8">

    <div>

        <p class="text-sm font-semibold text-orange-500">
            Compras
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-950 sm:text-3xl">
            Solicitações
        </h1>

        <p class="mt-2 text-sm text-gray-600 sm:text-base">
            Acompanhe e gerencie as solicitações recebidas dos setores.
        </p>

    </div>

</div>


{{-- ========================================= --}}
{{-- INDICADORES --}}
{{-- ========================================= --}}

<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

    {{-- Total --}}

    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Total de solicitações
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-950">
                    {{ $solicitacoes->count() }}
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


    {{-- Pendentes --}}

    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Pendentes
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-950">
                    {{ $solicitacoes->where('status', 'enviada')->count() }}
                </p>

            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">

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


    {{-- Em análise --}}

    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Em análise
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-950">
                    {{ $solicitacoes->where('status', 'em_analise')->count() }}
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
                    {{ $solicitacoes->where('status', 'atendida')->count() }}
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

</div>


{{-- ========================================= --}}
{{-- LISTA DE SOLICITAÇÕES --}}
{{-- ========================================= --}}

<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    {{-- Cabeçalho --}}

    <div class="border-b border-gray-200 px-5 py-5 sm:px-6">

        <div>

            <h2 class="text-base font-semibold text-gray-950 sm:text-lg">
                Solicitações recebidas
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Histórico das solicitações enviadas pelos setores.
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
                Nenhuma solicitação recebida
            </h3>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                Ainda não existem solicitações enviadas pelos setores.
            </p>

        </div>

    @else

        {{-- ========================================= --}}
        {{-- TABELA --}}
        {{-- ========================================= --}}

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px] text-left text-sm">

                <thead class="border-b border-gray-200 bg-gray-100">

                    <tr>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Solicitação
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Setor
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Solicitante
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


                            {{-- Setor --}}

                            <td class="px-5 py-4">

                                <p class="font-semibold text-gray-800">
                                    {{ $solicitacao->setor->nome }}
                                </p>

                            </td>


                            {{-- Solicitante --}}

                            <td class="px-5 py-4">

                                <p class="font-medium text-gray-800">
                                    {{ $solicitacao->usuario->name }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $solicitacao->usuario->email }}
                                </p>

                            </td>


                            {{-- Itens --}}

                            <td class="px-5 py-4">

                                <span class="font-semibold text-gray-800">
                                    {{ $solicitacao->itens->count() }}
                                </span>

                                <span class="text-gray-500">
                                    {{ $solicitacao->itens->count() === 1 ? 'item' : 'itens' }}
                                </span>

                            </td>


                            {{-- Status --}}

                            <td class="px-5 py-4">

                                @if($solicitacao->status === 'rascunho')

                                    <span class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-700">
                                        Rascunho
                                    </span>

                                @elseif($solicitacao->status === 'enviada')

                                    <span class="inline-flex items-center rounded-lg bg-blue-100 px-3 py-1.5 text-xs font-semibold text-blue-700">
                                        Pendente
                                    </span>

                                @elseif($solicitacao->status === 'em_analise')

                                    <span class="inline-flex items-center rounded-lg bg-orange-100 px-3 py-1.5 text-xs font-semibold text-orange-700">
                                        Em análise
                                    </span>

                                @elseif($solicitacao->status === 'aprovada')

                                    <span class="inline-flex items-center rounded-lg bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        Aprovada
                                    </span>

                                @elseif($solicitacao->status === 'rejeitada')

                                    <span class="inline-flex items-center rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">
                                        Rejeitada
                                    </span>

                                @elseif($solicitacao->status === 'atendida')

                                    <span class="inline-flex items-center rounded-lg bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        Atendida
                                    </span>

                                @elseif($solicitacao->status === 'cancelada')

                                    <span class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">
                                        Cancelada
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-700">
                                        {{ ucfirst($solicitacao->status) }}
                                    </span>

                                @endif

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
                                    href="{{ route('solicitacoesCompras.show', $solicitacao) }}"
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
