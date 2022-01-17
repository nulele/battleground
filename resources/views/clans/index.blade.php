<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('clans.clans') }}
            <a href="{{ route('clans.create') }}">{{ __('crud.create') }}</a>
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
                                            <th class="p-2" width="400px">
                                                {{ __('clans.name') }}
                                            </th>
                                            <th class="p-2">
                                                {{ __('crud.actions') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clans as $clan)
                                        <tr>
                                            <td class="p-2 text-center">
                                                {{ $clan->name }}
                                            </td>
                                            <td class="p-2 text-center">
                                                <a href="{{ route('clans.edit', $clan->id) }}">{{ __('crud.edit') }}</a>
                                                <form class="inline-flex" method="POST" action="{{ route('clans.destroy', $clan->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Confermi di voler eliminare?')" type="submit">{{ __('crud.delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <div class="py-2">
                                    {{ $clans->links() }}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
