<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eroi') }}
            <a href="{{ route('heroes.create') }}">Crea</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('status'))
                    <div class="">
                        {{ session('message') }}
                    </div>
                    @endif

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                    <table class="w-full table-fixed">
                                        <thead>
                                        <tr>
                                            <th class="p-2" width="200px">
                                                <a href="{{ route('heroes.index', ['sort' => 'name', 'direction' => $direction]) }}">Nome</a>
                                            </th>
                                            <th class="p-2">
                                                <a href="{{ route('heroes.index', ['sort' => 'energy', 'direction' => $direction]) }}">Energia</a>
                                            </th>
                                            <th class="p-2">
                                                <a href="{{ route('heroes.index', ['sort' => 'attack', 'direction' => $direction]) }}">Attacco</a>
                                            </th>
                                            <th class="p-2">
                                                <a href="{{ route('heroes.index', ['sort' => 'defense', 'direction' => $direction]) }}">Difesa</a>
                                            </th>
                                            <th class="p-2">
                                                Azioni
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($heroes as $hero)
                                        <tr>
                                            <td class="p-2 text-center">
                                                {{ $hero->name }}
                                            </td>
                                            <td class="p-2 text-center">
                                                {{ $hero->energy }}
                                            </td>
                                            <td class="p-2 text-center">
                                                {{ $hero->attack }}
                                            </td>
                                            <td class="p-2 text-center">
                                                {{ $hero->defense }}
                                            </td>
                                            <td class="p-2 text-center">
                                                <a href="{{ route('heroes.edit', $hero->id) }}">Modifica</a>
                                                <form class="inline-flex" method="POST" action="{{ route('heroes.delete', $hero->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Confermi di voler eliminare?')" type="submit">Elimina</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <div class="py-2">
                                    {{ $heroes->links() }}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
