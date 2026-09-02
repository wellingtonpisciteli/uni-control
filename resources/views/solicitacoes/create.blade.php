@extends('layouts.unicontrol')

@section('content')

<div class="min-h-screen bg-gray-100 px-4 py-6 sm:px-6 lg:px-8">

    {{-- Cabeçalho --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="mb-1 text-sm font-semibold text-orange-500">
                {{ Auth::user()->setor->nome }}
            </p>

            <h1 class="text-2xl font-bold tracking-tight text-gray-950">
                Nova solicitação
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Solicite materiais para o seu setor.
            </p>
        </div>

        <a href="{{ route('solicitacoes.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-200">

            <svg class="h-4 w-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

            </svg>

            Voltar
        </a>

    </div>


    {{-- Formulário --}}
    <form id="solicitacaoForm"
          action="{{ route('solicitacoes.store') }}"
          method="POST">

        @csrf

        <div class="grid items-start gap-6 lg:grid-cols-3">

            {{-- Materiais --}}
            <div class="lg:col-span-2">

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-200 px-5 py-5 sm:px-6">

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <h2 class="text-base font-bold text-gray-950">
                                    Materiais
                                </h2>

                                <p class="mt-1 text-sm text-gray-500">
                                    Adicione os materiais e informe a quantidade desejada.
                                </p>
                            </div>

                            <span id="contadorMateriais"
                                  class="inline-flex w-fit items-center rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">
                                0 materiais
                            </span>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        {{-- Seleção --}}
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end">

                            <div class="flex-1">

                                <label for="materialSelect"
                                       class="mb-2 block text-sm font-semibold text-gray-700">
                                    Material
                                </label>

                                <select id="materialSelect"
                                        class="w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-orange-500 focus:ring-orange-200">

                                    <option value="">
                                        Selecione um material
                                    </option>

                                    @foreach($materiais as $material)

                                        <option value="{{ $material->id }}"
                                                data-nome="{{ $material->nome }}"
                                                data-unidade="{{ $material->unidade }}">

                                            {{ $material->nome }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <button type="button"
                                    onclick="adicionarMaterial()"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-200">

                                <svg class="h-4 w-4"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 4v16m8-8H4"/>

                                </svg>

                                Adicionar
                            </button>

                        </div>


                        {{-- Lista de materiais --}}
                        <div id="listaMateriais"
                             class="mt-6 space-y-3">

                            <div id="estadoVazio"
                                 class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-5 py-10 text-center">

                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                                    <svg class="h-5 w-5"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M20 13V7a2 2 0 00-2-2h-4l-2-2H6a2 2 0 00-2 2v8m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4"/>

                                    </svg>

                                </div>

                                <p class="mt-3 text-sm font-semibold text-gray-700">
                                    Nenhum material adicionado
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Selecione um material acima para começar.
                                </p>

                            </div>

                        </div>


                        {{-- Aprovação financeira --}}
                        <div class="mt-6 border-t border-gray-100 pt-6">

                            <div>
                                <p class="text-sm font-semibold text-gray-700">
                                    A solicitação ultrapassará R$ 1.000,00?
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Solicitações acima desse valor precisam da aprovação do Diretor Financeiro.
                                </p>
                            </div>

                            <div class="mt-4 grid gap-3 sm:grid-cols-2">

                                {{-- Não --}}
                                <label class="cursor-pointer">

                                    <input
                                        type="radio"
                                        name="requer_aprovacao_financeira"
                                        value="0"
                                        class="peer sr-only"
                                        @checked(old('requer_aprovacao_financeira', '0') == '0')
                                    >

                                    <div class="rounded-xl border border-gray-200 bg-white p-4 transition
                                                hover:bg-gray-50
                                                peer-checked:border-orange-500
                                                peer-checked:bg-orange-50">

                                        <p class="text-sm font-semibold text-gray-800">
                                            Não
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Não necessita de aprovação financeira.
                                        </p>

                                    </div>

                                </label>


                                {{-- Sim --}}
                                <label class="cursor-pointer">

                                    <input
                                        type="radio"
                                        name="requer_aprovacao_financeira"
                                        value="1"
                                        class="peer sr-only"
                                        @checked(old('requer_aprovacao_financeira', '0') == '1')
                                    >

                                    <div class="rounded-xl border border-gray-200 bg-white p-4 transition
                                                hover:bg-gray-50
                                                peer-checked:border-orange-500
                                                peer-checked:bg-orange-50">

                                        <p class="text-sm font-semibold text-gray-800">
                                            Sim
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Requer aprovação do Diretor Financeiro.
                                        </p>

                                    </div>

                                </label>

                            </div>

                            @error('requer_aprovacao_financeira')

                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Observação geral --}}
                        <div class="mt-6 border-t border-gray-100 pt-6">

                            <label for="observacao"
                                   class="mb-2 block text-sm font-semibold text-gray-700">

                                Observação

                                <span class="font-normal text-gray-400">
                                    (opcional)
                                </span>

                            </label>

                            <textarea
                                id="observacao"
                                name="observacao"
                                rows="4"
                                maxlength="5000"
                                placeholder="Adicione alguma informação importante sobre a solicitação..."
                                class="w-full resize-none rounded-xl border-gray-300 px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-200">{{ old('observacao') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Resumo --}}
            <div class="lg:sticky lg:top-6">

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-200 px-5 py-5">

                        <h2 class="text-base font-bold text-gray-950">
                            Resumo
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Confira antes de enviar.
                        </p>

                    </div>


                    <div class="p-5">

                        <div class="rounded-xl bg-gray-50 p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-gray-500">
                                    Materiais adicionados
                                </span>

                                <span id="resumoQuantidade"
                                      class="text-lg font-bold text-gray-950">
                                    0
                                </span>

                            </div>

                        </div>


                        <div id="resumoItens"
                             class="mt-4 space-y-2">
                        </div>


                        <div class="mt-6 border-t border-gray-100 pt-5">

                            <button type="button"
                                    id="btnEnviar"
                                    onclick="abrirConfirmacao()"
                                    disabled
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-200 disabled:cursor-not-allowed disabled:opacity-50">

                                <svg class="h-4 w-4"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 19V5m0 0l-6 6m6-6l6 6"/>

                                </svg>

                                Enviar solicitação

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


{{-- Modal de confirmação --}}
<div id="modalConfirmacao"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">

    <div class="w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-xl">

        {{-- Cabeçalho --}}
        <div class="flex items-start justify-between border-b border-gray-200 px-5 py-5">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 5.591 3.824 10.29 9 11.622C17.176 22.29 21 17.591 21 12c0-1.19-.173-2.34-.497-3.424"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-bold text-gray-950">
                        Confirmar solicitação
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Confira os dados antes de enviar.
                    </p>

                </div>

            </div>

            <button type="button"
                    onclick="fecharConfirmacao()"
                    class="rounded-lg p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">

                <svg class="h-5 w-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>

                </svg>

            </button>

        </div>


        {{-- Conteúdo --}}
        <div class="px-5 py-5">

            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">

                <div class="flex items-center justify-between">

                    <span class="text-sm font-medium text-gray-500">
                        Materiais
                    </span>

                    <span id="modalQuantidade"
                          class="text-sm font-bold text-gray-950">
                        0
                    </span>

                </div>

            </div>


            <div id="modalItens"
                 class="mt-4 max-h-72 space-y-3 overflow-y-auto">
            </div>


            <div id="modalAprovacao"
                 class="mt-4">
            </div>


            <div id="modalObservacaoContainer"
                 class="mt-4 hidden">

                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-400">
                    Observação geral
                </p>

                <div id="modalObservacao"
                     class="rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-600">
                </div>

            </div>

        </div>


        {{-- Rodapé --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-200 px-5 py-4 sm:flex-row sm:justify-end">

            <button type="button"
                    onclick="fecharConfirmacao()"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-200">

                Voltar e revisar

            </button>

            <button type="button"
                    onclick="confirmarEnvio()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-200">

                <svg class="h-4 w-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>

                </svg>

                Confirmar e enviar

            </button>

        </div>

    </div>

</div>


<script>

    let materiaisSelecionados = [];


    function escaparHtml(texto) {

        const div = document.createElement('div');

        div.textContent = texto ?? '';

        return div.innerHTML;

    }


    function adicionarMaterial() {

        const select = document.getElementById('materialSelect');

        const id = select.value;

        if (!id) {
            return;
        }


        const option = select.options[select.selectedIndex];

        const nome = option.dataset.nome;

        const unidade = option.dataset.unidade;


        if (materiaisSelecionados.some(material => material.id === id)) {

            alert('Este material já foi adicionado.');

            return;

        }


        materiaisSelecionados.push({

            id: id,

            nome: nome,

            unidade: unidade,

            quantidade: 1,

            observacao: '',

            observacaoAberta: false

        });


        select.value = '';

        renderizarItens();

    }


    function removerMaterial(id) {

        materiaisSelecionados =
            materiaisSelecionados.filter(
                material => material.id !== id
            );

        renderizarItens();

    }


    function alterarQuantidade(id, quantidade) {

        const material =
            materiaisSelecionados.find(
                material => material.id === id
            );

        if (!material) {
            return;
        }


        quantidade = parseInt(quantidade);


        if (isNaN(quantidade) || quantidade < 1) {

            quantidade = 1;

        }


        material.quantidade = quantidade;

        renderizarResumo();

    }


    function abrirObservacao(id) {

        const material =
            materiaisSelecionados.find(
                material => material.id === id
            );

        if (!material) {
            return;
        }


        material.observacaoAberta = true;

        renderizarItens();

    }


    function fecharObservacao(id) {

        const material =
            materiaisSelecionados.find(
                material => material.id === id
            );

        if (!material) {
            return;
        }


        material.observacaoAberta = false;

        renderizarItens();

    }


    function atualizarObservacao(id, valor) {

        const material =
            materiaisSelecionados.find(
                material => material.id === id
            );

        if (!material) {
            return;
        }


        material.observacao = valor;

    }


    function renderizarItens() {

        const lista =
            document.getElementById('listaMateriais');


        if (materiaisSelecionados.length === 0) {

            lista.innerHTML = `

                <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-5 py-10 text-center">

                    <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-orange-100 text-orange-500">

                        <svg class="h-5 w-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M20 13V7a2 2 0 00-2-2h-4l-2-2H6a2 2 0 00-2 2v8m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4"/>

                        </svg>

                    </div>

                    <p class="mt-3 text-sm font-semibold text-gray-700">
                        Nenhum material adicionado
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Selecione um material acima para começar.
                    </p>

                </div>

            `;

            renderizarResumo();

            return;

        }


        lista.innerHTML = materiaisSelecionados.map(material => `

            <div class="rounded-xl border border-gray-200 bg-white p-4 transition hover:border-gray-300">

                {{-- Linha principal --}}
                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="truncate text-sm font-semibold text-gray-900">
                            ${escaparHtml(material.nome)}
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Unidade: ${escaparHtml(material.unidade)}
                        </p>

                    </div>


                    <div class="flex shrink-0 items-center gap-3">

                        <div>

                            <label class="mb-1 block text-xs font-semibold text-gray-500">
                                Quantidade
                            </label>

                            <input
                                type="number"
                                min="1"
                                value="${material.quantidade}"
                                onchange="alterarQuantidade('${material.id}', this.value)"
                                class="w-24 rounded-xl border-gray-300 px-3 py-2.5 text-center text-sm text-gray-700 shadow-sm focus:border-orange-500 focus:ring-orange-200"
                            >

                        </div>


                        <button
                            type="button"
                            onclick="removerMaterial('${material.id}')"
                            class="mt-5 rounded-xl p-2.5 text-gray-400 transition hover:bg-red-50 hover:text-red-500"
                            title="Remover material">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14"/>

                            </svg>

                        </button>

                    </div>

                </div>


                {{-- Observação do item --}}
                <div class="mt-3 border-t border-gray-100 pt-3">

                    ${material.observacaoAberta ? `

                        <div>

                            <div class="mb-2 flex items-center justify-between">

                                <label class="text-xs font-semibold text-gray-600">
                                    Observação do material
                                </label>

                                <button
                                    type="button"
                                    onclick="fecharObservacao('${material.id}')"
                                    class="text-xs font-medium text-gray-400 transition hover:text-gray-600">

                                    Fechar

                                </button>

                            </div>


                            <textarea
                                name="itens[${material.id}][observacao]"
                                rows="2"
                                maxlength="2000"
                                placeholder="Ex.: tamanho, modelo, finalidade ou outra informação..."
                                oninput="atualizarObservacao('${material.id}', this.value)"
                                class="w-full resize-none rounded-xl border-gray-300 px-3 py-2.5 text-sm text-gray-700 shadow-sm placeholder:text-gray-400 focus:border-orange-500 focus:ring-orange-200">${escaparHtml(material.observacao)}</textarea>

                        </div>

                    ` : `

                        <button
                            type="button"
                            onclick="abrirObservacao('${material.id}')"
                            class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-400 transition hover:text-orange-500">

                            <svg class="h-4 w-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M8 10h8M8 14h5m-7 7h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4v10a4 4 0 004 4z"/>

                            </svg>

                            ${material.observacao.trim()
                                ? 'Editar observação'
                                : 'Adicionar observação'}

                        </button>

                        ${material.observacao.trim() ? `

                            <span class="ml-2 text-xs text-gray-400">
                                Observação adicionada
                            </span>

                        ` : ''}

                    `}

                </div>


                {{-- Inputs enviados pelo formulário --}}
                <input
                    type="hidden"
                    name="itens[${material.id}][material_id]"
                    value="${material.id}"
                >

                <input
                    type="hidden"
                    name="itens[${material.id}][quantidade]"
                    value="${material.quantidade}"
                >

            </div>

        `).join('');


        renderizarResumo();

    }


    function renderizarResumo() {

        const resumo =
            document.getElementById('resumoItens');

        const contador =
            document.getElementById('contadorMateriais');

        const resumoQuantidade =
            document.getElementById('resumoQuantidade');

        const btnEnviar =
            document.getElementById('btnEnviar');


        const quantidadeMateriais =
            materiaisSelecionados.length;


        contador.textContent =
            quantidadeMateriais === 1
                ? '1 material'
                : `${quantidadeMateriais} materiais`;


        resumoQuantidade.textContent =
            quantidadeMateriais;


        btnEnviar.disabled =
            quantidadeMateriais === 0;


        resumo.innerHTML = materiaisSelecionados.map(material => `

            <div class="flex items-center justify-between gap-3 rounded-lg px-2 py-1.5">

                <span class="min-w-0 truncate text-sm text-gray-600">
                    ${escaparHtml(material.nome)}
                </span>

                <span class="shrink-0 text-sm font-semibold text-gray-900">
                    ${material.quantidade} ${escaparHtml(material.unidade)}
                </span>

            </div>

        `).join('');


        materiaisSelecionados.forEach(material => {

            const hidden =
                document.querySelector(
                    `input[name="itens[${material.id}][quantidade]"]`
                );


            if (hidden) {

                hidden.value =
                    material.quantidade;

            }

        });

    }


    function abrirConfirmacao() {

        if (materiaisSelecionados.length === 0) {
            return;
        }


        const modal =
            document.getElementById('modalConfirmacao');

        const modalItens =
            document.getElementById('modalItens');

        const modalQuantidade =
            document.getElementById('modalQuantidade');

        const modalAprovacao =
            document.getElementById('modalAprovacao');

        const modalObservacaoContainer =
            document.getElementById('modalObservacaoContainer');

        const modalObservacao =
            document.getElementById('modalObservacao');


        const observacaoGeral =
            document.getElementById('observacao').value.trim();


        const aprovacaoFinanceira =
            document.querySelector(
                'input[name="requer_aprovacao_financeira"]:checked'
            )?.value === '1';


        modalQuantidade.textContent =
            materiaisSelecionados.length === 1
                ? '1 material'
                : `${materiaisSelecionados.length} materiais`;


        modalItens.innerHTML =
            materiaisSelecionados.map(material => `

                <div class="rounded-xl border border-gray-200 bg-white px-4 py-3">

                    <div class="flex items-center justify-between gap-3">

                        <span class="min-w-0 truncate text-sm font-medium text-gray-700">
                            ${escaparHtml(material.nome)}
                        </span>

                        <span class="shrink-0 text-sm font-bold text-gray-950">
                            ${material.quantidade} ${escaparHtml(material.unidade)}
                        </span>

                    </div>


                    ${material.observacao.trim() ? `

                        <div class="mt-3 border-t border-gray-100 pt-3">

                            <p class="text-xs font-semibold text-gray-400">
                                Observação
                            </p>

                            <p class="mt-1 whitespace-pre-line text-xs text-gray-600">
                                ${escaparHtml(material.observacao)}
                            </p>

                        </div>

                    ` : ''}

                </div>

            `).join('');


        if (aprovacaoFinanceira) {

            modalAprovacao.innerHTML = `

                <div class="rounded-xl border border-orange-200 bg-orange-50 px-4 py-3">

                    <p class="text-sm font-semibold text-orange-800">
                        Requer aprovação financeira
                    </p>

                    <p class="mt-1 text-xs text-orange-700">
                        Esta solicitação será encaminhada para aprovação do Diretor Financeiro.
                    </p>

                </div>

            `;

        } else {

            modalAprovacao.innerHTML = `

                <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">

                    <p class="text-sm font-medium text-gray-600">
                        Não requer aprovação financeira.
                    </p>

                </div>

            `;

        }


        if (observacaoGeral) {

            modalObservacao.textContent =
                observacaoGeral;

            modalObservacaoContainer.classList.remove('hidden');

        } else {

            modalObservacao.textContent = '';

            modalObservacaoContainer.classList.add('hidden');

        }


        modal.classList.remove('hidden');

        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

    }


    function fecharConfirmacao() {

        const modal =
            document.getElementById('modalConfirmacao');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');

    }


    function confirmarEnvio() {

        document.getElementById('solicitacaoForm').submit();

    }


    document.getElementById('modalConfirmacao')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                fecharConfirmacao();

            }

        });


    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            fecharConfirmacao();

        }

    });


    renderizarItens();

</script>

@endsection

