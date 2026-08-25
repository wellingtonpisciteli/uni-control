<x-guest-layout>

    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-lg">

            {{-- LOGO / IDENTIDADE --}}
            <div class="mb-8 text-center">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-500 shadow-lg shadow-orange-200">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 text-white"
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

                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    Uni<span class="text-orange-500">Control</span>
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Controle e gestão de materiais
                </p>

            </div>


            {{-- CARD DE LOGIN --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl shadow-gray-200/50">

                <div class="px-6 py-7 sm:px-8 sm:py-8">

                    {{-- TÍTULO --}}
                    <div class="mb-7">

                        <h2 class="text-xl font-bold text-gray-900">
                            Bem-vindo de volta
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Entre com suas credenciais para continuar.
                        </p>

                    </div>


                    {{-- STATUS --}}
                    <x-auth-session-status
                        class="mb-5"
                        :status="session('status')"
                    />


                    {{-- FORMULÁRIO --}}
                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="space-y-5"
                    >

                        @csrf


                        {{-- EMAIL --}}
                        <div>

                            <x-input-label
                                for="email"
                                value="E-mail"
                                class="mb-2 text-sm font-semibold text-gray-700"
                            />

                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>

                                </div>

                                <x-text-input
                                    id="email"
                                    class="block w-full rounded-xl border-gray-300 py-3 pl-11 pr-4 text-sm shadow-sm transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="seu@email.com"
                                />

                            </div>

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-2"
                            />

                        </div>


                        {{-- SENHA --}}
                        <div>

                            <x-input-label
                                for="password"
                                value="Senha"
                                class="mb-2 text-sm font-semibold text-gray-700"
                            />

                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 11V7a3 3 0 00-6 0v4m-3 0h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2z"
                                        />
                                    </svg>

                                </div>

                                <x-text-input
                                    id="password"
                                    class="block w-full rounded-xl border-gray-300 py-3 pl-11 pr-4 text-sm shadow-sm transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Digite sua senha"
                                />

                            </div>

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />

                        </div>


                        {{-- LEMBRAR + ESQUECI SENHA --}}
                        <div class="flex items-center justify-between gap-3">

                            <label
                                for="remember_me"
                                class="inline-flex cursor-pointer items-center"
                            >

                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500"
                                >

                                <span class="ms-2 text-sm text-gray-500">
                                    Lembrar de mim
                                </span>

                            </label>


                            @if (Route::has('password.request'))

                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-sm font-medium text-orange-500 transition hover:text-orange-600"
                                >
                                    Esqueci minha senha
                                </a>

                            @endif

                        </div>


                        {{-- BOTÃO --}}
                        <button
                            type="submit"
                            class="flex w-full items-center justify-center rounded-xl bg-orange-500 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 hover:shadow-orange-300 focus:outline-none focus:ring-4 focus:ring-orange-200"
                        >

                            Entrar no UniControl

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="ml-2 h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"
                                />
                            </svg>

                        </button>

                    </form>

                </div>


                {{-- RODAPÉ --}}
                <div class="border-t border-gray-100 bg-gray-50 px-6 py-4 text-center sm:px-8">

                    <p class="text-xs text-gray-400">
                        UniControl · Sistema de gestão de materiais
                    </p>

                </div>

            </div>


            {{-- COPYRIGHT --}}
            <p class="mt-6 text-center text-xs text-gray-400">
                © {{ date('Y') }} UniControl. Todos os direitos reservados.
            </p>

        </div>

    </div>

</x-guest-layout>