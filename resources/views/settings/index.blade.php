@php use App\Models\Setting; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Édition des paramètres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Paramètres du site') }}
                            </h2>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('settings.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <div id="contact-info">
                                <x-input-label for="app_name" :value="__('Nom du site')"/>
                                <div class="flex align-middle">
                                    <x-text-input id="app_name" name="app_name" type="text"
                                                  :value="old('app_name', Setting::all()->where('name', '=', 'app_name')->first()->value)"
                                                  class="mt-1 block w-full" required autofocus
                                                  autocomplete="app_name"/>
                                    @error('site_name')
                                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                                    <script>
                                        document.getElementById('app_name').classList.add('border-red-500');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('app_name')"/>
                            </div>
                            <div>
                                <x-input-label for="maps_api_key" :value="__('Clé d\'API Google Maps')"/>
                                <div class="flex align-middle">
                                    <x-text-input id="maps_api_key" name="maps_api_key" type="text" :value="old('maps_api_key', Setting::all()->where('name', '=', 'maps_api_key')->first()->value)" class="mt-1 block w-full" required autocomplete="maps_api_key"/>
                                    @error('maps_api_key')
                                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                                    <script>
                                        document.getElementById('maps_api_key').classList.add('border-red-500');
                                    </script>
                                    @enderror
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('maps_api_key')"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
