<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des clients') }}
        </h2>
    </x-slot>
    @if( session('success') !== null )
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

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
