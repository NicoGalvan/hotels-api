<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Bogotá'],
            ['name' => 'Medellín'],
            ['name' => 'Cali'],
            ['name' => 'Barranquilla'],
            ['name' => 'Cartagena'],
            ['name' => 'Bucaramanga'],
            ['name' => 'Pereira'],
            ['name' => 'Manizales'],
            ['name' => 'Cúcuta'],
            ['name' => 'Santa Marta'],
        ];

        City::insert($cities);
    }
}
