<?php

namespace Database\Seeders;

use App\Models\Localization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Localization::create([
            'country' => 'Czech Republic',
            'locale' => 'cs_CZ',
        ]);

    }
}
