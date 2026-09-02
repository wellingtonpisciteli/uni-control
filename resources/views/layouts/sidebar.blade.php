{{-- Overlay mobile --}}
<div id="sidebar-overlay"
     class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden">
</div>


<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col bg-[#111111] text-white transition-transform duration-300 lg:translate-x-0">

    {{-- Logo --}}
    <div class="flex h-20 shrink-0 items-center border-b border-gray-800 px-6">

        <a href="{{ route('dashboard') }}" class="text-2xl font-bold">
            <span class="text-orange-500">Uni</span>Control
        </a>

        {{-- Botão fechar mobile --}}
        <button id="sidebar-close"
                type="button"
                class="ml-auto rounded-lg p-2 text-gray-400 hover:bg-gray-800 hover:text-white lg:hidden">

            ✕

        </button>

    </div>


    {{-- Usuário --}}
    <div class="shrink-0 border-b border-gray-800 px-6 py-5">

        <p class="truncate font-medium">
            {{ Auth::user()->name }}
        </p>

        @if(Auth::user()->setor)

            <p class="mt-1 truncate text-xs text-gray-400">
                {{ Auth::user()->setor->nome }}
            </p>

        @endif

    </div>


    {{-- Navegação --}}
    <nav class="flex-1 overflow-y-auto px-3 py-5">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium
                {{ request()->routeIs('dashboard')
                    ? 'bg-orange-500 text-white'
                    : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

            <span class="mr-3">⌂</span>

            Dashboard

        </a>


        {{-- ================================= --}}
        {{-- SETORES --}}
        {{-- ================================= --}}

        @if(in_array(Auth::user()->role, ['setor', 'lider']))

            <div class="mb-2 mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                Meu Setor
            </div>


            {{-- Estoque --}}
            <a href="{{ route('estoque.index') }}"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium
                    {{ request()->routeIs('estoque.*')
                        ? 'bg-orange-500 text-white'
                        : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

                <span class="mr-3">📦</span>

                Estoque

            </a>


            {{-- Materiais --}}
            <a href="{{ route('materiais.index') }}"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium
                    {{ request()->routeIs('materiais.*')
                        ? 'bg-orange-500 text-white'
                        : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

                <span class="mr-3">🗃️</span>

                Materiais

            </a>


            {{-- Solicitações --}}
            <a href="{{ route('solicitacoes.index') }}"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">📨</span>

                Solicitações

            </a>


            {{-- Movimentações --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">🔄</span>

                Movimentações

            </a>


            {{-- Usuários - somente líder --}}
            @if(Auth::user()->role === 'lider')

                <a href="{{ route('usuarios.index') }}"
                   class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium
                        {{ request()->routeIs('usuarios.*')
                            ? 'bg-orange-500 text-white'
                            : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

                    <span class="mr-3">👥</span>

                    Usuários

                </a>

            @endif


        {{-- ================================= --}}
        {{-- COMPRAS --}}
        {{-- ================================= --}}

        @elseif(Auth::user()->role === 'compras')

            <div class="mb-2 mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                Compras
            </div>


            {{-- Solicitações --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">📨</span>

                Solicitações

            </a>


            {{-- Compras --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">🛒</span>

                Compras

            </a>


            {{-- Fornecedores --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">🏢</span>

                Fornecedores

            </a>


        {{-- ================================= --}}
        {{-- ADMINISTRADOR --}}
        {{-- ================================= --}}

        @elseif(Auth::user()->role === 'administrador')

            <div class="mb-2 mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                Administração
            </div>


            {{-- Usuários --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">👥</span>

                Usuários

            </a>


            {{-- Setores --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">🏢</span>

                Setores

            </a>


            {{-- Estoque --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">📦</span>

                Estoque

            </a>


            {{-- Compras --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">🛒</span>

                Compras

            </a>


            {{-- Fornecedores --}}
            <a href="#"
               class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white">

                <span class="mr-3">🏢</span>

                Fornecedores

            </a>

        @endif

    </nav>


    {{-- ================================= --}}
    {{-- SAIR --}}
    {{-- ================================= --}}

    <div class="shrink-0 border-t border-gray-800 p-4">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button type="submit"
                    class="flex w-full items-center rounded-lg px-4 py-3 text-sm font-medium text-gray-300 hover:bg-red-500/10 hover:text-red-400">

                <span class="mr-3">↪</span>

                Sair

            </button>

        </form>

    </div>

</aside>