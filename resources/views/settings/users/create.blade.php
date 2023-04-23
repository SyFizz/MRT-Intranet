<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Création d\'un utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Création de compte utilisateur') }}
                            </h2>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('settings.users.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Nom/Prénom')" />
                                <div class="flex align-middle">
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" autofocus autocomplete="name" />
                                    @error('name')
                                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                                    <script>
                                        document.getElementById('name').classList.add('border-red-500');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('E-mail')" />
                                <div class="flex align-middle">
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" autocomplete="username" />
                                    @error('email')
                                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                                    <script>
                                        document.getElementById('email').classList.add('border-red-500');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Mot de passe')" />
                                <div class="flex align-middle">
                                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="password" />
                                    @error('password')
                                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                                    <script>
                                        document.getElementById('password').classList.add('border-red-500');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>

                            <div>
                                <x-input-label for="passwordConfirm" :value="__('Confirmez le mot de passe')" />
                                <div class="flex align-middle">
                                    <x-text-input id="passwordConfirm" name="passwordConfirm" type="password" class="mt-1 block w-full" autocomplete="password" />
                                    @error('passwordConfirm')
                                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                                    <script>
                                        document.getElementById('passwordConfirm').classList.add('border-red-500');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('passwordConfirm')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Créer le compte') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
