<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            ['name' => 'Sala 101', 'capacity' => 10],
            ['name' => 'Sala 102', 'capacity' => 15],
            ['name' => 'Sala 201', 'capacity' => 20],
            ['name' => 'Sala 202', 'capacity' => 30],
        ]);
    }
}
