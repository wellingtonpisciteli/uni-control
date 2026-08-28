@extends('layouts.unicontrol')

@section('content')

<div class="px-4 py-6 sm:px-6 lg:px-8">

{{-- Cabeçalho --}}
<div class="mb-6 flex flex-col gap-4 sm:mb-8 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <p class="text-sm font-semibold text-orange-500">
            {{ Auth::user()->setor->nome }}
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            Materiais
        </h1>

        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            Cadastre e gerencie os materiais utilizados pelo seu setor.
        </p>

    </div>


    {{-- Novo material --}}
    <a
        href="{{ route('materiais.create') }}"
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

        Novo material

    </a>

</div>


{{-- Indicadores --}}
<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">

    {{-- Total --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">

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
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                    />
                </svg>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Materiais cadastrados
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $materiais->count() }}
                </p>

            </div>

        </div>

    </div>


    {{-- Categorias --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

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
                        d="M7 7h.01M7 3h5.586a2 2 0 011.414.586l6.414 6.414a2 2 0 010 2.828l-5.586 5.586a2 2 0 01-2.828 0L5.586 12A2 2 0 015 10.586V5a2 2 0 012-2z"
                    />
                </svg>

            </div>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Categorias
                </p>

                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $materiais->pluck('categoria')->filter()->unique()->count() }}
                </p>

            </div>

        </div>

    </div>

</div>


{{-- Lista de materiais --}}
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

    {{-- Cabeçalho da lista --}}
    <div class="border-b border-gray-200 px-5 py-4 sm:px-6">

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

                <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
                    Materiais cadastrados
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Visualize e gerencie os materiais do seu setor.
                </p>

            </div>

        </div>

    </div>


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

            <h2 class="text-lg font-semibold text-gray-900">
                Nenhum material cadastrado
            </h2>

            <p class="mt-2 max-w-md text-sm leading-6 text-gray-500">
                Seu setor ainda não possui materiais cadastrados.
                Cadastre o primeiro material para começar.
            </p>

            <a
                href="{{ route('materiais.create') }}"
                class="mt-6 inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
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
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Cadastrar material

            </a>

        </div>

    @else

        {{-- Tabela --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px] text-left text-sm">

                <thead class="border-b border-gray-200 bg-gray-50">

                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Material
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Categoria
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Unidade
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Estoque mínimo
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-gray-600">
                            Ações
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @foreach($materiais as $material)

                        <tr class="transition hover:bg-gray-50">

                            {{-- Material --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-orange-500">

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
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                            />
                                        </svg>

                                    </div>

                                    <p class="font-semibold text-gray-900">
                                        {{ $material->nome }}
                                    </p>

                                </div>

                            </td>


                            {{-- Categoria --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $material->categoria ?? '—' }}
                            </td>


                            {{-- Unidade --}}
                            <td class="px-6 py-4">

                                <span class="font-medium text-gray-700">
                                    {{ $material->unidade }}
                                </span>

                            </td>


                            {{-- Estoque mínimo --}}
                            <td class="px-6 py-4">

                                <span class="font-medium text-gray-700">
                                    {{ $material->estoque_minimo }}
                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($material->ativo ?? true)

                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Ativo
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                        Inativo
                                    </span>

                                @endif

                            </td>


                            {{-- Ações --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- EDITAR --}}
                                    <a
                                        href="{{ route('materiais.edit', $material) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-xs font-semibold text-gray-700 transition hover:bg-orange-50 hover:text-orange-600"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h5m4-14l2-2a2.121 2.121 0 113 3l-8.5 8.5L10 15l1-4z"
                                            />
                                        </svg>

                                        Editar

                                    </a>


                                    {{-- EXCLUIR --}}
                                    <form
                                        action="{{ route('materiais.destroy', $material) }}"
                                        method="POST"
                                        class="form-excluir-material"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            onclick="abrirModalExclusao({{ $material->id }}, @js($material->nome))"
                                            class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100 hover:text-red-700 focus:outline-none focus:ring-4 focus:ring-red-100"
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
                                                    d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H9a2 2 0 01-2-2V7m3 4v6m4-6v6"
                                                />
                                            </svg>

                                            Excluir

                                        </button>

                                    </form>

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

{{-- ========================================= --}}
{{-- MODAL DE CONFIRMAÇÃO DE EXCLUSÃO --}}
{{-- ========================================= --}}

<div
    id="modalExclusao"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4"
>

    <div
        class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl"
    >

        {{-- Ícone --}}
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-red-100 text-red-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v4m0 4h.01M10.29 3.86l-7.36 12a2 2 0 001.71 3h14.72a2 2 0 001.71-3l-7.36-12a2 2 0 00-3.42 0z"
                />
            </svg>

        </div>


        <h2 class="text-lg font-bold text-gray-900">
            Excluir material?
        </h2>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Tem certeza que deseja excluir
            <span
                id="nomeMaterialExclusao"
                class="font-semibold text-gray-700"
            ></span>?
            Essa ação não poderá ser desfeita.
        </p>


        {{-- Botões --}}
        <div class="mt-6 flex justify-end gap-3">

            <button
                type="button"
                onclick="fecharModalExclusao()"
                class="rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-200"
            >
                Cancelar
            </button>

            <button
                type="button"
                onclick="confirmarExclusao()"
                class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-100"
            >
                Excluir material
            </button>

        </div>

    </div>

</div>


<script>

    let materialParaExcluir = null;

    function abrirModalExclusao(id, nome) {

        materialParaExcluir = id;

        document.getElementById('nomeMaterialExclusao').textContent = nome;

        const modal = document.getElementById('modalExclusao');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function fecharModalExclusao() {

        materialParaExcluir = null;

        const modal = document.getElementById('modalExclusao');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


    function confirmarExclusao() {

        if (!materialParaExcluir) {
            return;
        }

        const form = document.querySelector(
            `.form-excluir-material[action$="/${materialParaExcluir}"]`
        );

        if (form) {
            form.submit();
        }
    }


    // Fecha ao clicar fora do modal
    document.getElementById('modalExclusao').addEventListener('click', function(event) {

        if (event.target === this) {
            fecharModalExclusao();
        }

    });

</script>

@endsection
