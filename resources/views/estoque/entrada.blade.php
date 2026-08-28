@extends('layouts.unicontrol')

@section('content')

<div class="px-4 py-6 sm:px-6 lg:px-8">

{{-- ========================================= --}}
{{-- CABEÇALHO --}}
{{-- ========================================= --}}

<div class="mb-6 sm:mb-8">

    <a
        href="{{ route('estoque.index') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-orange-500"
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

        Voltar para o estoque

    </a>


    <div class="mt-5">

        <p class="text-sm font-semibold text-orange-500">
            {{ Auth::user()->setor->nome }}
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            Nova entrada
        </h1>

        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            Registre a entrada de vários materiais no estoque.
        </p>

    </div>

</div>


{{-- ========================================= --}}
{{-- FORMULÁRIO --}}
{{-- ========================================= --}}

<form
    id="formEntradaLote"
    method="POST"
    action="{{ route('estoque.entrada.lote') }}"
>

    @csrf


    {{-- ========================================= --}}
    {{-- MATERIAIS --}}
    {{-- ========================================= --}}

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- Cabeçalho --}}
        <div class="border-b border-gray-200 px-5 py-5 sm:px-6">

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

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 14V8m0 0l-2 2m2-2l2 2"
                        />

                    </svg>

                </div>


                <div>

                    <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
                        Materiais
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Informe a quantidade apenas dos materiais que deseja adicionar.
                    </p>

                </div>

            </div>

        </div>


        @if($materiais->isEmpty())

            {{-- Estado vazio --}}
            <div class="flex flex-col items-center justify-center px-6 py-14 text-center">

                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
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

                <p class="text-sm font-semibold text-gray-700">
                    Nenhum material ativo encontrado.
                </p>

                <p class="mt-1 max-w-md text-sm leading-6 text-gray-500">
                    Cadastre ou reative um material para registrar uma entrada.
                </p>

            </div>

        @else

            {{-- ========================================= --}}
            {{-- TABELA --}}
            {{-- ========================================= --}}

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
                                Estoque atual
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Quantidade de entrada
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

                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ $material->nome }}
                                            </p>

                                            <p class="mt-1 text-xs text-gray-400">
                                                {{ $material->unidade }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Categoria --}}
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $material->categoria ?? '—' }}
                                </td>


                                {{-- Estoque atual --}}
                                <td class="px-6 py-4">

                                    <span class="font-semibold text-gray-900">
                                        {{ $material->estoque_atual }}
                                    </span>

                                    <span class="text-gray-400">
                                        {{ $material->unidade }}
                                    </span>

                                </td>


                                {{-- Quantidade --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2">

                                        <input
                                            type="number"
                                            name="itens[{{ $material->id }}]"
                                            min="0"
                                            step="1"
                                            value="{{ old('itens.' . $material->id) }}"
                                            placeholder="0"
                                            class="w-32 rounded-lg border border-orange-200 bg-orange-50/50 px-3 py-2.5 text-sm font-medium text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-500/20"
                                        >

                                        <span class="text-sm text-gray-400">
                                            {{ $material->unidade }}
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>


    {{-- ========================================= --}}
    {{-- OBSERVAÇÃO --}}
    {{-- ========================================= --}}

    @if($materiais->isNotEmpty())

        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

            {{-- Cabeçalho --}}
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
                                d="M8 10h8M8 14h5m7-2a8 8 0 11-16 0 8 8 0 0116 0z"
                            />

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
                            Observação
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Adicione uma informação sobre esta movimentação, se necessário.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Conteúdo --}}
            <div class="px-5 py-5 sm:px-6">

                <label
                    for="observacao"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >

                    Observação

                    <span class="font-normal text-gray-400">
                        (opcional)
                    </span>

                </label>

                <textarea
                    id="observacao"
                    name="observacao"
                    rows="4"
                    maxlength="1000"
                    placeholder="Ex: Entrada referente à NF 4587..."
                    class="w-full resize-none rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20"
                >{{ old('observacao') }}</textarea>

                @error('observacao')

                    <p class="mt-2 text-sm font-medium text-red-500">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>


        {{-- ========================================= --}}
        {{-- AÇÕES --}}
        {{-- ========================================= --}}

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('estoque.index') }}"
                class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-6 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100"
            >

                Cancelar

            </a>


            <button
                type="button"
                onclick="abrirModalEntrada()"
                class="inline-flex min-h-11 items-center justify-center rounded-xl bg-orange-500 px-7 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mr-2 h-5 w-5"
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

                Confirmar entrada

            </button>

        </div>

    @endif

</form>

</div>

{{-- ========================================= --}}
{{-- MODAL DE CONFIRMAÇÃO --}}
{{-- ========================================= --}}

<div
    id="modal-entrada"
    class="fixed inset-0 z-50 hidden items-center justify-center px-4"
    aria-hidden="true"
>

{{-- Overlay --}}
<div
    class="absolute inset-0 bg-black/50 backdrop-blur-sm"
    onclick="fecharModalEntrada()"
></div>


{{-- Modal --}}
<div
    class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
>

    {{-- Ícone --}}
    <div class="flex justify-center px-6 pt-7">

        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-orange-100 text-orange-500">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-7 w-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.36 12.73A2 2 0 004.66 19.6h14.68a2 2 0 001.73-3.01L13.71 3.86a2 2 0 00-3.42 0z"
                />

            </svg>

        </div>

    </div>


    {{-- Conteúdo --}}
    <div class="px-6 pb-6 pt-5 text-center">

        <h2 class="text-lg font-bold text-gray-900">
            Confirmar entrada
        </h2>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Tem certeza que deseja registrar estas entradas?
        </p>

        <p class="mt-1 text-xs text-gray-400">
            As quantidades informadas serão adicionadas ao estoque.
        </p>

    </div>


    {{-- Ações --}}
    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">

        <button
            type="button"
            onclick="fecharModalEntrada()"
            class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
        >

            Cancelar

        </button>


        <button
            type="button"
            onclick="confirmarEntrada()"
            class="inline-flex min-h-11 items-center justify-center rounded-xl bg-orange-500 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mr-2 h-4 w-4"
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

            Confirmar entrada

        </button>

    </div>

</div>

</div>

{{-- ========================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================= --}}

<script>

    function abrirModalEntrada()
    {
        const modal = document.getElementById('modal-entrada');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
    }


    function fecharModalEntrada()
    {
        const modal = document.getElementById('modal-entrada');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
    }


    function confirmarEntrada()
    {
        document
            .getElementById('formEntradaLote')
            .submit();
    }


    // Fechar com ESC
    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            fecharModalEntrada();

        }

    });

</script>

@endsection
