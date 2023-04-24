<x-admin-layout>
    <x-slot name="header">
            {{ __('Liste des utilisateurs') }}
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
                                <form action="{{ route('settings.users.search') }}" method="GET" class="space-x-5">
                                    <input class="border-gray-200 border-b-2" type="text" name="search" placeholder="Rechercher..." value="{{ request()->query('search') }}">
                                    <button class="rounded bg-blue-300 align-middle justify-items-center p-3" type="submit">@svg('carbon-search', 'w-4 h-4')</button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="text-black dark:text-green-100">
                                <form action="{{route('settings.users.create')}}" method="GET" class="space-x-5">
                                    <button class="rounded bg-green-300 p-3" type="submit">@svg('carbon-add', 'w-4 h-4')</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 w-80">Nom</th>
                        <th class="px-4 py-2 w-80">Email</th>
                        <th class="px-4 py-2 w-80">Créé le</th>
                        <th class="px-4 py-2 w-30">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user->isAdmin === 1)
                            <tr class="align-middle justify-items-center justify-center align bg-blue-50">
                        @else
                        <tr class="align-middle justify-items-center justify-center align">
                        @endif
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->created_at->format('d/m/Y à H:i') }}</td>
                            <td class="border px-1 py-2 flex items-center justify-center gap-9">
                                <a href="{{ route('settings.users.edit', $user) }}" class="text-blue-500 hover:text-blue-600 underline">@svg('carbon-edit', 'w-6 h-6 ')</a>

                                @if($user->id !== auth()->user()->id)
                                    <form action="{{ route('settings.users.resetPassword', $user) }}" method="POST" onsubmit="return confirm('Voulez-vous réeellement réinitialiser le mot de passe de cet utilisateur ?')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="text-blue-500 hover:text-blue-700" type="submit">
                                            @svg('carbon-password', 'w-6 h-6')
                                        </button>
                                    </form>
                                    <form action="{{ route('settings.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Voulez-vous réeellement supprimer cet utilisateur ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700" type="submit">
                                            @svg('carbon-trash-can', 'w-6 h-6')
                                        </button>
                                    </form>
                                @else
                                    <button onclick="alert('Vous ne pouvez pas réinitialiser le mot de passe de l\'utilisateur connecté !')" class="text-gray-400">@svg('carbon-password', 'w-6 h-6')</button>
                                    <button onclick="alert('Vous ne pouvez pas supprimer l\'utilisateur connecté !')" class="text-gray-400">@svg('carbon-trash-can', 'w-6 h-6')</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <div class="m-2 p-2">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
