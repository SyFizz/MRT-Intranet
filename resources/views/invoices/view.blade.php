<x-app-layout>
    <x-slot name="header" class="mb-5">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visualisation d\'une facture ') }}
        </h2>
        <div class="justify-center flex my-2">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                {{ __('Actions :') }}
            </h2>
        </div>
        <div class="justify-center flex my-2 gap-4">
            <a href="{{ route('invoice.download', $invoice->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                @svg('carbon-download', 'w-7 h-7 text-white')
            </a>
            <form method="post" action="{{ route('invoice.destroy', $invoice->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    @svg('carbon-trash-can', 'w-7 h-7 text-white')
                </button>
            </form>
        </div>
    </x-slot>


    <div class="flex justify-center">
        <iframe src="{{ env("APP_URL") . "/storage/" . $invoice->filePath . "#toolbar=0"}}" width="90%" height="1000px"></iframe>
    </div>


</x-app-layout>
