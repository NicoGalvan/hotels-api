<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels');
            $table->foreignId('room_type_id')->constrained('room_types');
            $table->foreignId('accommodation_id')->constrained('accommodations'); 
            $table->integer('total_rooms');
            $table->timestamps();

            
            $table->unique(['hotel_id', 'room_type_id', 'accommodation_id'], 'hotel_room_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
