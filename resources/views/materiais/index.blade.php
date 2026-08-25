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
                Materiais
            </h1>

            <p class="mt-2 text-sm text-gray-500 sm:text-base">
                Cadastre e gerencie os materiais utilizados pelo seu setor.
            </p>

        </div>


        {{-- Novo material --}}
        <a href="{{ route('materiais.create') }}"
           class="flex w-full items-center justify-center rounded-lg bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600 sm:w-auto">

            + Novo material

        </a>

    </div>


    {{-- Indicadores --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">

        {{-- Total --}}
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

            <p class="text-sm text-gray-500">
                Materiais cadastrados
            </p>

            <p class="mt-2 text-2xl font-bold text-gray-900">
                {{ $materiais->count() }}
            </p>

        </div>


        {{-- Categorias --}}
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">

            <p class="text-sm text-gray-500">
                Categorias
            </p>

            <p class="mt-2 text-2xl font-bold text-gray-900">
                {{ $materiais->pluck('categoria')->filter()->unique()->count() }}
            </p>

        </div>

    </div>


    {{-- Lista de materiais --}}
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

        @if($materiais->isEmpty())

            {{-- Estado vazio --}}
            <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-orange-100 text-3xl">
                    🗃️
                </div>

                <h2 class="text-lg font-semibold text-gray-900">
                    Nenhum material cadastrado
                </h2>

                <p class="mt-2 max-w-md text-sm text-gray-500">
                    Seu setor ainda não possui materiais cadastrados.
                    Cadastre o primeiro material para começar.
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
                                Unidade
                            </th>

                            <th class="px-6 py-4 font-semibold text-gray-600">
                                Estoque mínimo
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

                                {{-- Material --}}
                                <td class="px-6 py-4">

                                    <p class="font-medium text-gray-900">
                                        {{ $material->nome }}
                                    </p>

                                </td>


                                {{-- Categoria --}}
                                <td class="px-6 py-4 text-gray-500">

                                    {{ $material->categoria ?? '—' }}

                                </td>


                                {{-- Unidade --}}
                                <td class="px-6 py-4 text-gray-500">

                                    {{ $material->unidade }}

                                </td>


                                {{-- Estoque mínimo --}}
                                <td class="px-6 py-4 text-gray-500">

                                    {{ $material->estoque_minimo }}

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    @if($material->ativo ?? true)

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                            Ativo
                                        </span>

                                    @else

                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                            Inativo
                                        </span>

                                    @endif

                                </td>


                                {{-- Ações --}}
                                <td class="px-6 py-4">

                                    <div class="flex justify-end">

                                        <a
                                            href="{{ route('materiais.edit', $material) }}"
                                            class="rounded-lg bg-gray-100 px-4 py-2 text-xs font-semibold text-gray-600 transition hover:bg-gray-200"
                                        >
                                            Editar
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