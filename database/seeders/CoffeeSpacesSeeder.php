<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoffeeSpacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coffee_spaces')->insert([
            ['name' => 'Café Central', 'capacity' => 50],
            ['name' => 'Café Lounge', 'capacity' => 30],
            ['name' => 'Café Externo', 'capacity' => 40],
        ]);
    }
}
