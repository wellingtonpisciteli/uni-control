@extends('layouts.unicontrol')

@section('content')

<div class="px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

    {{-- ========================================= --}}
    {{-- CABEÇALHO --}}
    {{-- ========================================= --}}

    <div class="mb-6 sm:mb-8">

        <p class="text-sm font-medium text-orange-500">
            {{ ucfirst(Auth::user()->role) }}

            @if(Auth::user()->setor)
                • {{ Auth::user()->setor->nome }}
            @endif
        </p>

        <h1 class="mt-1 text-2xl font-bold text-gray-900 sm:text-3xl">
            Dashboard
        </h1>

        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            Bem-vindo de volta, {{ Auth::user()->name }}.
        </p>

    </div>


    {{-- ========================================= --}}
    {{-- DASHBOARD DOS SETORES --}}
    {{-- ========================================= --}}

    @if(Auth::user()->role === 'setor')

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">

            {{-- Materiais --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Materiais
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Materiais cadastrados
                </p>

            </div>


            {{-- Solicitações --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Solicitações
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Solicitações pendentes
                </p>

            </div>


            {{-- Movimentações --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Movimentações
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Movimentações recentes
                </p>

            </div>


            {{-- Usuários --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Usuários
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Usuários do setor
                </p>

            </div>

        </div>


    {{-- ========================================= --}}
    {{-- DASHBOARD DE COMPRAS --}}
    {{-- ========================================= --}}

    @elseif(Auth::user()->role === 'compras')

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">

            {{-- Solicitações --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Solicitações
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Aguardando análise
                </p>

            </div>


            {{-- Compras --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Compras
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Compras em andamento
                </p>

            </div>


            {{-- Fornecedores --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Fornecedores
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Fornecedores cadastrados
                </p>

            </div>


            {{-- Solicitações aprovadas --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Aprovadas
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Solicitações aprovadas
                </p>

            </div>

        </div>


    {{-- ========================================= --}}
    {{-- DASHBOARD DO ADMINISTRADOR --}}
    {{-- ========================================= --}}

    @elseif(Auth::user()->role === 'administrador')

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">

            {{-- Usuários --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Usuários
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Usuários cadastrados
                </p>

            </div>


            {{-- Setores --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Setores
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Setores cadastrados
                </p>

            </div>


            {{-- Solicitações --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Solicitações
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Solicitações no sistema
                </p>

            </div>


            {{-- Compras --}}
            <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6">

                <p class="text-sm text-gray-500">
                    Compras
                </p>

                <p class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    0
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Compras registradas
                </p>

            </div>

        </div>

    @endif

</div>

@endsection