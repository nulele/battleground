<?php

namespace Database\Seeders;

use App\Models\Clan;
use Illuminate\Database\Seeder;

class ClanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clan::factory()
            ->count(4)
            ->create();
    }
}
