<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('people')->insert([
            ['name' => 'Ana Clara', 'surname' => 'Orionte'],
            ['name' => 'Luis Felipe', 'surname' => 'Ramos'],
            ['name' => 'Maria', 'surname' => 'Costa'],
            ['name' => 'João', 'surname' => 'Pereira'],
            ['name' => 'Fernanda', 'surname' => 'Almeida'],
        ]);
    }
}
