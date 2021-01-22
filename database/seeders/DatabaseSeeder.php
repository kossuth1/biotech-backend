<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locale;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Locale::create(['id' => 'hu', 'name' => 'Magyar', 'currency' => 'Ft']);
        Locale::create(['id' => 'en', 'name' => 'Angol', 'currency' => '£']);
    }
}
