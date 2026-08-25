@extends('layouts.unicontrol')

@section('content')

<div class="px-4 py-6 sm:px-6 lg:px-8">

    {{-- Cabeçalho --}}
    <div class="mb-6 flex flex-col gap-4 sm:mb-8 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-sm font-medium text-orange-500">
                {{ Auth::user()->setor->nome }}
            </p>

            <h1 class="mt-1 text-2xl font-bold text-gray-900 sm:text-3xl">
                Estoque
            </h1>

            <p class="mt-2 text-sm text-gray-500 sm:text-base">
                Controle as entradas, saídas e quantidades dos materiais.
            </p>

        </div>


        {{-- Ações --}}
        <div class="flex w-full gap-2 sm:w-auto">

            <a href="#"
               class="flex flex-1 items-center justify-center rounded-lg bg-orange-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-600 sm:flex-none">

                + Entrada

            </a>

            <a href="#"
               class="flex flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 sm:flex-none">

                − Saída

            </a>

        </div>

    </div>


    {{-- Indicadores --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Total de materiais --}}
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

            <p class="text-sm text-gray-500">
                Materiais em estoque
            </p>

            <p class="mt-2 text-2xl font-bold text-gray-900">
                {{ $materiais->count() }}
            </p>

        </div>


        {{-- Estoque baixo --}}
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

            <p class="text-sm text-gray-500">
                Estoque baixo
            </p>

            <p class="mt-2 text-2xl font-bold text-orange-500">
                0
            </p>

        </div>


        {{-- Sem estoque --}}
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

            <p class="text-sm text-gray-500">
                Sem estoque
            </p>

            <p class="mt-2 text-2xl font-bold text-red-500">
                0
            </p>

        </div>

    </div>


    {{-- Estoque --}}
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

        @if($materiais->isEmpty())

            {{-- Estado vazio --}}
            <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-orange-100 text-3xl">
                    📦
                </div>

                <h2 class="text-lg font-semibold text-gray-900">
                    Estoque vazio
                </h2>

                <p class="mt-2 max-w-md text-sm text-gray-500">
                    Nenhum material foi cadastrado para este setor.
                    Cadastre os materiais primeiro para começar a controlar o estoque.
                </p>

                <a href="{{ route('materiais.create') }}"
                   class="mt-6 rounded-lg bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">

                    Cadastrar material

                </a>

            </div>

        @else

            {{-- Tabela --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px] text-left text-sm">

                    <thead class="border-b border-gray-200 bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 font-semibold text-gray-600">
                                Material
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-600">
                                Categoria
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-600">
                                Quantidade
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-600">
                                Mínimo
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-600">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right font-semibold text-gray-600">
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($materiais as $material)

                            <tr class="transition hover:bg-gray-50">

                                <td class="px-6 py-4">

                                    <p class="font-medium text-gray-900">
                                        {{ $material->nome }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        {{ $material->unidade }}
                                    </p>

                                </td>


                                <td class="px-6 py-4 text-gray-500">
                                    {{ $material->categoria ?? '—' }}
                                </td>


                                {{-- Quantidade --}}
                                <td class="px-6 py-4">

                                    <span class="font-semibold text-gray-900">
                                        0
                                    </span>

                                    <span class="text-gray-400">
                                        {{ $material->unidade }}
                                    </span>

                                </td>


                                {{-- Mínimo --}}
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $material->estoque_minimo }}
                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                        Normal
                                    </span>

                                </td>


                                {{-- Ações --}}
                                <td class="px-6 py-4">

                                    <div class="flex justify-end gap-2">

                                        <a href="#"
                                           class="rounded-lg bg-orange-50 px-3 py-2 text-xs font-semibold text-orange-600 hover:bg-orange-100">

                                            Entrada

                                        </a>

                                        <a href="#"
                                           class="rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-200">

                                            Saída

                                        </a>

                                    </div>

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