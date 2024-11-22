<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeAccommodationRestrictionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = DB::table('room_types')->pluck('id', 'name');
        $accommodations = DB::table('accommodations')->pluck('id', 'name');

        $restrictions = [
            ['room_type' => 'Estándar', 'accommodation' => ['Sencilla', 'Doble']],

            ['room_type' => 'Junior', 'accommodation' => ['Triple', 'Cuádruple']],

            ['room_type' => 'Suite', 'accommodation' => ['Sencilla', 'Doble', 'Triple']],
        ];

        foreach ($restrictions as $restriction) {
            $roomTypeId = $roomTypes[$restriction['room_type']];
            
            foreach ($restriction['accommodation'] as $accommodation) {
                $accommodationId = $accommodations[$accommodation];
                
                DB::table('room_type_accommodation_restrictions')->insert([
                    'room_type_id' => $roomTypeId,
                    'accommodation_id' => $accommodationId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
