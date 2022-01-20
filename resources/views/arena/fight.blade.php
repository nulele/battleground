<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fight') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(session('winner'))
                    <div class="text-center">
                        {{ session('winner') }} vince!!!
                        <br>
                        <a href="{{ route('arena.select') }}">Torna all'arena</a>
                    </div>
                    @endif

                    <br>
                    <br>

                    <div class="w-full">
                        <div class="flex flex-row w-full">
                            <div class="text-center text-lg basis-1/3 w-full">
                                <strong>{{ $hero1->fullname }}</strong>
                                <br>
                                    <div class="text-xl">Tiro: {{ $hero1_roll_value }}</div>
                                <br>
                                Vita: {{ $hero1_current_energy }} / {{ $hero1->energy }}
                                <br>
                                Attacco: {{ $hero1->attack }}
                                <br>
                                Difesa: {{ $hero1->defense }}
                            </div>
                            <div class="text-center basis-1/3 w-full">
                                <br>
                                <br>
                                <br>
                                @if(!session('winner'))
                                <a href="{{ route('arena.roll') }}">Tira dado!</a>
                                @endif
                            </div>
                            <div class="text-center text-lg basis-1/3 w-full">
                                <strong>{{ $hero2->fullname }}</strong>
                                <br>
                                    <div class="text-xl">Tiro: {{ $hero2_roll_value }}</div>
                                <br>
                                Vita: {{ $hero2_current_energy }} / {{ $hero2->energy }}
                                <br>
                                Attacco: {{ $hero2->attack }}
                                <br>
                                Difesa: {{ $hero2->defense }}
                            </div>
                            <br>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
