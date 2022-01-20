<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class ArenaController extends Controller
{
    public function select(Request $request)
    {
        $request->session()->forget(['hero1', 'hero2', 'hero1_roll_value', 'hero2_roll_value', 'hero1_current_energy',
            'hero2_current_energy', 'winner']);

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

        return view('arena.fight', [
            'hero1' => $hero1,
            'hero2' => $hero2,
            'hero1_current_energy' => session()->get('hero1_current_energy', $hero1->energy),
            'hero2_current_energy' => session()->get('hero2_current_energy', $hero2->energy),
            'hero1_roll_value' => session()->get('hero1_roll_value', 0),
            'hero2_roll_value' => session()->get('hero2_roll_value', 0),
        ]);
    }

    public function roll()
    {
        $hero1 = Hero::query()->find(session()->get('hero1'));
        $hero2 = Hero::query()->find(session()->get('hero2'));

        $dice = collect()->range(1, 6);
        $hero1_roll_value = $dice->random(1)->first();
        $hero2_roll_value = $dice->random(1)->first();

        $hero2_current_energy = session()->get('hero2_current_energy', $hero2->energy);
        if($hero1->attack + $hero1_roll_value > $hero2->defense + $hero2_roll_value) {
            $hero2_current_energy -= 1;
        }
        $hero1_current_energy = session()->get('hero1_current_energy', $hero1->energy);
        if($hero2->attack + $hero2_roll_value > $hero1->defense + $hero1_roll_value) {
            $hero1_current_energy -= 1;
        }

        session([
            'hero1_roll_value' => $hero1_roll_value,
            'hero2_roll_value' => $hero2_roll_value,
            'hero1_current_energy' => $hero1_current_energy,
            'hero2_current_energy' => $hero2_current_energy,
            'winner' => $this->setWinner($hero1_current_energy, $hero2_current_energy, $hero2, $hero1)
        ]);

        return redirect()->route('arena.fight');
    }

    private function setWinner($hero1_current_energy, $hero2_current_energy, $hero2, $hero1)
    {
        if($hero1_current_energy == 0) {
            return $hero2->fullname;
        }
        if($hero2_current_energy == 0) {
            return $hero1->fullname;
        }
        return null;
    }
}
