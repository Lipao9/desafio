<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assignments')->insert([
            ['person_id' => 1, 'room_id' => 2, 'coffee_space_id' => 1, 'step' => 'Etapa 1'],
            ['person_id' => 2, 'room_id' => 1, 'coffee_space_id' => 2, 'step' => 'Etapa 2'],
            ['person_id' => 3, 'room_id' => 3, 'coffee_space_id' => 3, 'step' => 'Etapa 1'],
            ['person_id' => 4, 'room_id' => 4, 'coffee_space_id' => 1, 'step' => 'Etapa 2'],
            ['person_id' => 5, 'room_id' => 2, 'coffee_space_id' => 2, 'step' => 'Etapa 1'],
            ['person_id' => 1, 'room_id' => 3, 'coffee_space_id' => 2, 'step' => 'Etapa 2'],
            ['person_id' => 2, 'room_id' => 4, 'coffee_space_id' => 2, 'step' => 'Etapa 1'],
            ['person_id' => 3, 'room_id' => 3, 'coffee_space_id' => 3, 'step' => 'Etapa 2'],
            ['person_id' => 4, 'room_id' => 1, 'coffee_space_id' => 2, 'step' => 'Etapa 1'],
            ['person_id' => 5, 'room_id' => 1, 'coffee_space_id' => 2, 'step' => 'Etapa 2'],
        ]);
    }
}
