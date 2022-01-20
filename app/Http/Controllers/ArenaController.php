<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class ArenaController extends Controller
{
    public function select(Request $request)
    {
        $heroes = Hero::query()->get();

        $hero1 = $heroes->random(1)->first();
        $hero2 = $heroes->reject(function ($item) use ($hero1) {
            return $item->id == $hero1->id;
        })->random(1)->first();

        return view('arena.select', [
            'hero1' => $hero1,
            'hero2' => $hero2,
            'heroes_number' => $heroes->count(),
        ]);
    }

    public function fight(Hero $hero1, Hero $hero2)
    {
        dd($hero1->toArray(), $hero2->toArray());
    }
}
