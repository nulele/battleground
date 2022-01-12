<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eroi') }} - Modifica
            <a href="{{ route('heroes.index') }}">Indietro</a>
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

                                    <form method="POST" action="{{ route('heroes.update', $hero->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label>Nome</label>
                                            <input name="name" type="text" value="{{ old('name', $hero->name) }}">
                                        </div>

                                        <div>
                                            <label>Energia</label>
                                            <input name="energy" type="text" value="{{ old('energy', $hero->energy) }}">
                                        </div>

                                        <div>
                                            <label>Attacco</label>
                                            <input name="attack" type="text" value="{{ old('attack', $hero->attack) }}">
                                        </div>

                                        <div>
                                            <label>Difesa</label>
                                            <input name="defense" type="text" value="{{ old('defense', $hero->defense) }}">
                                        </div>

                                        <button type="submit" name="save" >Salva</button>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
