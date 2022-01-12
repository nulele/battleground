<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eroi') }} - Crea
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

                    @if ($errors->any())
                    <div class="">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                    <form method="POST" action="{{ route('heroes.store') }}">
                                        @csrf

                                        <div>
                                            <label>Nome</label>
                                            <input name="name" type="text" value="{{ old('name') }}">
                                        </div>

                                        <div>
                                            <label>Energia</label>
                                            <input name="energy" type="text" value="{{ old('energy') }}">
                                        </div>

                                        <div>
                                            <label>Attacco</label>
                                            <input name="attack" type="text" value="{{ old('attack') }}">
                                        </div>

                                        <div>
                                            <label>Difesa</label>
                                            <input name="defense" type="text" value="{{ old('defense') }}">
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
