<x-guest-layout>

    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">

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


            {{-- CARD --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl shadow-gray-200/50">

                <div class="px-6 py-8 sm:px-10 sm:py-9">

                    {{-- TÍTULO --}}
                    <div class="mb-7">

                        <h2 class="text-xl font-bold text-gray-900">
                            Recuperar senha
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Para redefinir sua senha, entre em contato com o administrador do sistema.
                        </p>

                    </div>


                    {{-- AVISO --}}
                    <div class="rounded-xl border border-orange-100 bg-orange-50 p-4">

                        <div class="flex items-start">

                            <div class="mr-3 mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-orange-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.5m0 3h.01M10.29 3.86l-7.3 12.64A2 2 0 004.72 19.5h14.56a2 2 0 001.73-3L13.71 3.86a2 2 0 00-3.42 0z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h3 class="text-sm font-semibold text-gray-800">
                                    Solicitação de redefinição
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Informe ao administrador que você precisa redefinir sua senha.
                                    Após a alteração, você poderá acessar novamente o UniControl com a nova senha.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- BOTÃO --}}
                    <div class="mt-7">

                        <a
                            href="{{ route('login') }}"
                            class="inline-flex min-h-11 w-full items-center justify-center rounded-xl bg-orange-500 px-6 text-sm font-semibold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 hover:shadow-orange-300 focus:outline-none focus:ring-4 focus:ring-orange-200"
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
                                    d="M10 6l-6 6 6 6M4 12h16"
                                />
                            </svg>

                            Voltar para o login

                        </a>

                    </div>

                </div>


                {{-- RODAPÉ --}}
                <div class="border-t border-gray-100 bg-gray-50 px-6 py-4 text-center sm:px-10">

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