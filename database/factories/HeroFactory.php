<?php

namespace Database\Factories;

use App\Models\Hero;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hero::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stats = $this->generateStats(10);

        return [
            'name' => $this->faker->name(),
            'energy' => $stats[0],
            'attack' => $stats[1],
            'defense' => $stats[2],
            'enabled' => true,
        ];
    }

    private function generateStats($max, $min = 2)
    {
        do {
            $sum = [
                rand($min, $max),
                rand($min, $max),
                rand($min, $max),
            ];
        }
        while (array_sum($sum) != $max);
        return $sum;
    }
}
