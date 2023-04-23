<x-app-layout>
    <nav x-data="{ open: true }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('settings')" :active="request()->routeIs('settings')">
                            {{ __('Paramètres du site') }}
                        </x-nav-link>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('settings.users')" :active="str_contains(request()->fullUrl(), '/settings/users')">
                            {{ __('Gestion des utilisateurs') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @if(isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    {{ $slot }}

</x-app-layout>
