<?php

namespace App\Http\Controllers;

use App\Classes\Arena;
use App\Models\Hero;
use Illuminate\Http\Request;

class ArenaController extends Controller
{
    public function select(Request $request)
    {
        $request->session()->forget(['hero1', 'hero2', 'hero1_roll', 'hero2_roll', 'hero1_energy',
            'hero2_energy', 'winner']);

        $heroes = Hero::query()->get();

        $hero1 = $heroes->random(1)->first();
        $hero2 = $heroes->reject(function ($item) use ($hero1) {
            return $item->id == $hero1->id;
        })->random(1)->first();

        session([
            'hero1' => $hero1->id,
            'hero2' => $hero2->id,
        ]);

        return view('arena.select', [
            'hero1' => $hero1,
            'hero2' => $hero2,
            'heroes_number' => $heroes->count(),
        ]);
    }

    public function fight()
    {
        $hero1 = Hero::query()->find(session()->get('hero1'));
        $hero2 = Hero::query()->find(session()->get('hero2'));

        $arena = new Arena($hero1, $hero2);

        return view('arena.fight', array_merge($arena->fight(), [
            'hero1' => $hero1,
            'hero2' => $hero2,
        ]));
    }
}
