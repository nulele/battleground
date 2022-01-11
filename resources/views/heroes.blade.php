<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eroi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                    <table class="w-full table-auto">
                                        <thead>
                                        <tr>
                                            <th class="p-2">
                                                Nome
                                            </th>
                                            <th class="p-2">
                                                Energia
                                            </th>
                                            <th class="p-2">
                                                Attacco
                                            </th>
                                            <th class="p-2">
                                                Difesa
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

                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
