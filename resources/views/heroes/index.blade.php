<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('heroes.heroes') }}
            <a href="{{ route('heroes.create') }}">{{ __('crud.create') }}</a>
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

                                    <form method="POST" action="{{ route('heroes.search') }}">
                                        @csrf
                                        <input placeholder="Cerca tra gli Eroi..." style="width:90%" class="shadow border-gray-200" name="search" id="search" value="{{ $search ?? null }}" />
                                        <button type="submit">Cerca</button>
                                        @if(isset($search))
                                        <a href="{{ route('heroes.index') }}">Annulla</a>
                                        @endif
                                    </form>

                                    <table class="w-full table-fixed">
                                        <thead>
                                        <tr>
                                            <th class="p-2" width="400px">
                                                <a href="{{ route('heroes.index', ['sort' => 'heroes.name', 'direction' => $direction]) }}">{{ __('heroes.name') }}</a>
                                            </th>
                                        <tr>
                                            <th class="p-2">
                                                <a href="{{ route('heroes.index', ['sort' => 'heroes.user_id', 'direction' => $direction]) }}">{{ __('heroes.user') }}</a>
                                            </th>
{{--                                            <th class="p-2" >--}}
{{--                                                <a href="{{ route('heroes.index', ['sort' => 'clans.name', 'direction' => $direction]) }}">{{ __('heroes.clan') }}</a>--}}
{{--                                            </th>--}}
                                            <th class="p-2">
                                                <a href="{{ route('heroes.index', ['sort' => 'heroes.energy', 'direction' => $direction]) }}">{{ __('heroes.energy') }}</a>
                                            </th>
                                            <th class="p-2">
                                                <a href="{{ route('heroes.index', ['sort' => 'heroes.attack', 'direction' => $direction]) }}">{{ __('heroes.attack') }}</a>
                                            </th>
                                            <th class="p-2">
                                                <a href="{{ route('heroes.index', ['sort' => 'heroes.defense', 'direction' => $direction]) }}">{{ __('heroes.defense') }}</a>
                                            </th>
                                            <th class="p-2">
                                                {{ __('crud.actions') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($heroes as $hero)
                                        <tr>
                                            <td class="p-2 text-center">
                                                {{ $hero->fullname }}
                                            </td>
{{--                                            <td class="p-2 text-center">--}}
{{--                                                {{ $hero->clan ? $hero->clan->name : null }}--}}
{{--                                            </td>--}}
                                            <td class="p-2 text-center">
                                                {{ $hero->user ? $hero->user->name : null }}
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
                                                <a href="{{ route('heroes.edit', $hero->id) }}">{{ __('crud.edit') }}</a>
                                                @can('delete', $hero)
                                                <form class="inline-flex" method="POST" action="{{ route('heroes.destroy', $hero->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Confermi di voler eliminare?')" type="submit">{{ __('crud.delete') }}</button>
                                                </form>
                                                @endcan
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
