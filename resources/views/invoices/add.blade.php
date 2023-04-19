<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Téléversement d\'une facture pour ') }} {{ $customer->name }}
        </h2>
    </x-slot>

    <div class="py-12 align-middle justify-items-center justify-center items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 align-middle justify-items-center justify-center items-center">
            <div class="flex w-full p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg align-middle justify-items-center justify-center items-center">
                <div class="w-full max-w-2xl align-middle justify-items-center justify-center items-center">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                                {{ __('Téléversement de facture') }}
                            </h2>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('invoice.store', $customer->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}"/>
                            <div>
                                <x-input-label for="filename" :value="__('Nom de la facture à stocker')" />
                                <div class="flex align-middle">
                                    <x-text-input id="filename" name="filename" type="text" class="mt-1 block w-full" :value="old('filename')" autofocus autocomplete="filename" />
                                    @error('filename')
                                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                                    <script>
                                        document.getElementById('filename').classList.add('border-red-500');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('filename')" />
                            </div>

                            <div>
                                <x-input-label for="file" :value="__('Fichier à stocker')" />

                                <div class="flex align-middle items-center justify-center w-full">

                                    <input type="file" id="file" name="file" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />


                                    @error('file')
                                    <script>
                                        document.getElementById('filelabel').classList.add('border-red-500');
                                        document.getElementById('filelabel').classList.add('bg-red-100');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" id="fileerrormsg" :messages="$errors->get('file')" />
                            </div>

                            <div class="flex items-center gap-4 justify-center">
                                <x-primary-button class="disabled">{{ __('Téléverser la facture') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
