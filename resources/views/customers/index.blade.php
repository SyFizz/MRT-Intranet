<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Table with 1 line per customer
                Must have buttons to edit, view and delete each customer
                Also add a search bar to dynamically filter customers by name or
                --}}
                <table class="table-auto w-full">
                    <tr>
                        <td>
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <form action="{{ route('customers.search') }}" method="GET" class="space-x-5">
                                    <input class="border-gray-200 border-b-2" type="text" name="search" placeholder="Rechercher un client" value="{{ request()->query('search') }}">
                                    <button class="rounded bg-blue-300 align-middle justify-items-center p-3" type="submit">@svg('carbon-search', 'w-4 h-4')</button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="text-black dark:text-green-100">
                                <form action="{{route('customers.create')}}" method="GET" class="space-x-5">
                                    <button class="rounded bg-green-300 p-3" type="submit">@svg('carbon-add', 'w-4 h-4')</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 w-15">ID</th>
                        <th class="px-4 py-2 w-80">Nom</th>
                        <th class="px-4 py-2 w-80">Email</th>
                        <th class="px-4 py-2 w-80">Téléphone</th>
                        <th class="px-4 py-2 w-30">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr class="align-middle justify-items-center justify-center align">
                            <td class="border px-4 py-2">{{ $customer->id }}</td>
                            <td class="border px-4 py-2">{{ $customer->name }}</td>
                            <td class="border px-4 py-2">{{ $customer->email }}</td>
                            <td class="border px-4 py-2">{{ $customer->phone }}</td>
                            <td class="border px-1 py-2 flex items-center justify-center gap-9">
                                <a href="{{ route('customers.show', $customer) }}" class="text-blue-500 hover:text-blue-600 underline">@svg('carbon-view', 'w-6 h-6 ')</a>
                                <a href="{{ route('customers.edit', $customer) }}" class="text-blue-500 hover:text-blue-600 underline">@svg('carbon-edit', 'w-6 h-6 ')</a>
                                <form action="{{ route('customer.destroy', $customer) }}" method="POST" onsubmit="return confirm('Voulez-vous réeellement supprimer ce client ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700" type="submit">
                                        @svg('carbon-trash-can', 'w-6 h-6')
                                    </button>
                                </form>

                            </td>
                        </tr>
                        <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Fermer le modal</span>
                                    </button>
                                    <div class="p-6 text-center">
                                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Voulez-vous réellement supprimer ce client {{ dump($customer) }}?</h3>

                                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Non, annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>

                </table>
               <div class="m-2 p-2">
                     {{ $customers->links() }}
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
