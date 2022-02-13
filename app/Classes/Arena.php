<?php

namespace App\Classes;

use App\Events\HeroWon;
use App\Models\Hero;

class Arena
{
    private $hero1;

    private $hero2;

    private $dice;

    public function __construct(Hero $hero1, Hero $hero2, $dice = 6)
    {
        $this->hero1 = $hero1;
        $this->hero2 = $hero2;
        $this->dice = $dice;
    }

    public function fight()
    {
        $hero1_roll = $this->rollDice();
        $hero2_roll = $this->rollDice();

        $this->assignDamage($hero1_roll, $hero2_roll);

        $hero1_energy = $this->getEnergy('hero1_energy');
        $hero2_energy = $this->getEnergy('hero2_energy');

        return [
            'hero1_roll' => $hero1_roll,
            'hero2_roll' => $hero2_roll,
            'hero1_energy' => $hero1_energy,
            'hero2_energy' => $hero2_energy,
            'winner' => $this->declareWinner($hero1_energy, $hero2_energy),
        ];
    }

    private function rollDice()
    {
        return collect()->range(1, $this->dice)->random(1)->first();
    }

    private function assignDamage($hero1_roll, $hero2_roll)
    {
        $hero1_attack = $this->hero1->attack + $hero1_roll;
        $hero1_defense = $this->hero1->defense + $hero1_roll;

        $hero2_attack = $this->hero2->attack + $hero2_roll;
        $hero2_defense = $this->hero2->defense + $hero2_roll;

        $hero2_energy = $this->getEnergy('hero2_energy', $this->hero2->energy);
        if($hero1_attack > $hero2_defense) {
            $hero2_energy -= 1;
        }
        $this->setEnergy('hero2_energy', $hero2_energy);

        $hero1_energy = $this->getEnergy('hero1_energy', $this->hero1->energy);
        if($hero2_attack > $hero1_defense) {
            $hero1_energy -= 1;
        }
        $this->setEnergy('hero1_energy', $hero1_energy);
    }

    private function getEnergy($key, $defaultValue = null)
    {
        return session()->get($key, $defaultValue);
    }

    private function setEnergy($key, $value)
    {
        session([$key => $value]);
    }

    private function declareWinner($hero1_energy = null, $hero2_energy = null)
    {
        if($hero1_energy == 0) {
            HeroWon::dispatch($this->hero2);
            return $this->hero2;
        }
        if($hero2_energy == 0) {
            HeroWon::dispatch($this->hero1);
            return $this->hero1;
        }
        return null;
    }
}
