<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Arena') }}
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

                    <div class="text-center">
                        Eroi disponibli oggi: {{ $heroes_number }}
                    </div>

                    <br>
                    <br>

                    <div class="w-full">
                        <div class="">
                            <div class="text-center text-lg">
                                {{ $hero1->fullname }}
                            </div>
                            <div class="text-center text-xl">
                                VS
                            </div>
                            <div class="text-center text-lg">
                                {{ $hero2->fullname }}
                            </div>
                            <br>
                            <div class="text-center">
                                <a href="{{ route('arena.fight') }}">FIGHT!</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
