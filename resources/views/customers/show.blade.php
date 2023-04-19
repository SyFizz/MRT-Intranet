<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails du client ') }} {{ $customer->id  }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            {{--<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Informations personnelles</h2>
                    <br>
                    <p class="mb-0.5"> Nom et prénom : {{ $customer->name }} </p>
                    <p class="mb-0.5"> Email : {{ $customer->email }} </p>
                    <p class="mb-0.5"> Téléphone : {{ $customer->phone }} </p>
                    <p class="mb-0.5"> Numéro de TVA : {{ $customer->vat_number }} </p>
                </div>
            </div>--}}
            <div class="rounded overflow-hidden shadow-lg bg-white m-5 w-1/2">
                <div class="px-6 py-4">
                    <div class="font-bold text-2xl mb-2 underline">Informations du client</div>
                    <p class="text-gray-700 text-lg">
                        <b>Nom et prénom</b> : {{ $customer->name }}
                    </p>
                    <p class="text-gray-700 text-lg">
                        <b> Email</b> : {{ $customer->email }}
                    </p>
                    <p class="text-gray-700 text-lg ">
                        <b>Téléphone</b> : {{ $customer->phone }}
                    </p>
                    <p class="text-gray-700 text-lg">
                        <b>Adresse postale </b> :  {{ $customer->address }}
                    </p>
                    <p class="text-gray-700 text-base">
                        <b>Numéro SIRET </b>: {{ $customer->siret ?: 'Non applicable/Non renseigné' }}
                    </p>
                    <p class="text-gray-700 text-base">
                        <b>Numéro TVA</b> : {{ $customer->vat_number ?: 'Non applicable/Non renseigné' }}
                    </p>
                    <p class="text-gray-700 text-base">
                        <b>Forme juridique</b>
                        : {{ $customer->legal_status ?: 'Non applicable/Non renseigné' }}
                    </p>

                </div>
                <div class="px-6 pt-4 pb-2 justify-center align-middle justify-items-center text-center">
                    <a href='{{ route('customers.edit', ['id' => $customer->id]) }}'
                       class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">@svg('carbon-edit',
                        'w-7, h-7')</a>
                </div>
            </div>
            <div class="rounded overflow-hidden shadow-lg bg-white m-5 w-1/2">
                <div class="px-6 py-4">
                    <div class="font-bold text-2xl underline mb-2">Factures</div>

                </div>
                <div class="px-6 pt-4 pb-2 justify-center align-middle justify-items-center text-center">
                    @foreach($customer->invoices as $invoice)
                        <a href='{{ route('invoice.show', ['id' => $invoice->id]) }}'
                           class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 w-full">Facture n°{{ $invoice->id }} - {{ $invoice->created_at->format('d/m/Y à H:i') }}
                        </a>
                    @endforeach
                    <a href='{{ route('customers.add-invoice', ['id' => $customer->id]) }}'
                       class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">@svg('carbon-add',
                        'w-7, h-7')</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
