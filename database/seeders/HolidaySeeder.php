<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Localization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $locale = Localization::where([
            'locale' => 'cs_CZ',
        ])->first();

        Holiday::insert([[
            'localization_id' =>  $locale->id,
            'name' => 'Nový rok',
            'date' => '2024-12-01',
        ],[
            'localization_id' =>  $locale->id,
            'name' => 'Den obnovy samostatného českého státu',
            'date' => '2024-10-28',
        ],[
            'localization_id' =>  $locale->id,
            'name' => 'Vánoce',
            'date' => '2024-12-24',
        ],[
            'localization_id' =>  $locale->id,
            'name' => 'Svátek práce',
            'date' => '2024-05-01',
        ]]);
    }
}
