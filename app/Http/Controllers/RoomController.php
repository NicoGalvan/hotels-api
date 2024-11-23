<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with(['roomType', 'accommodation']) // Cargar las relaciones
            ->paginate(10);

        return RoomResource::collection($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'accommodation_id' => 'required|exists:accommodations,id',
            'total_rooms' => 'required|integer|min:1',
        ]);

        // Verificar si ya existe un registro con la misma combinación
        $exists = Room::where('hotel_id', $validated['hotel_id'])
            ->where('room_type_id', $validated['room_type_id'])
            ->where('accommodation_id', $validated['accommodation_id'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Ya existe una habitación con este tipo y acomodación para este hotel.',
            ], 422);
        }

        // Validar restricciones de acomodación para el tipo de habitación
        $isValidAccommodation = DB::table('room_type_accommodation_restrictions')
            ->where('room_type_id', $validated['room_type_id'])
            ->where('accommodation_id', $validated['accommodation_id'])
            ->exists();

        if (!$isValidAccommodation) {
            return response()->json([
                'message' => 'La acomodación seleccionada no está permitida para este tipo de habitación.',
            ], 422);
        }

        // Validar el total de habitaciones no exceda el máximo permitido por el hotel
        $hotel = Hotel::find($validated['hotel_id']);
        $currentRooms = Room::where('hotel_id', $hotel->id)->sum('total_rooms');
        if ($currentRooms + $validated['total_rooms'] > $hotel->max_rooms) {
            return response()->json([
                'message' => 'El total de habitaciones excede el límite permitido por el hotel.',
            ], 422);
        }

        // Crear la habitación
        $room = Room::create($validated);

        return response()->json([
            'message' => 'Habitación creada correctamente.',
            'data' => $room->load(['hotel', 'room_type', 'accommodation']),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'accommodation_id' => 'required|exists:accommodations,id',
            'total_rooms' => 'required|integer|min:1',
        ]);

        // Verificar si ya existe un registro con la misma combinación (excluyendo el actual)
        $exists = Room::where('hotel_id', $validated['hotel_id'])
            ->where('room_type_id', $validated['room_type_id'])
            ->where('accommodation_id', $validated['accommodation_id'])
            ->where('id', '!=', $room->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Ya existe una habitación con este tipo y acomodación para este hotel.',
            ], 422);
        }

        // Validar restricciones de acomodación para el tipo de habitación
        $isValidAccommodation = DB::table('room_type_accommodation_restrictions')
            ->where('room_type_id', $validated['room_type_id'])
            ->where('accommodation_id', $validated['accommodation_id'])
            ->exists();

        if (!$isValidAccommodation) {
            return response()->json([
                'message' => 'La acomodación seleccionada no está permitida para este tipo de habitación.',
            ], 422);
        }

        // Validar el total de habitaciones no exceda el máximo permitido por el hotel
        $hotel = Hotel::find($validated['hotel_id']);
        $currentRooms = Room::where('hotel_id', $hotel->id)
            ->where('id', '!=', $room->id)
            ->sum('total_rooms');

        if ($currentRooms + $validated['total_rooms'] > $hotel->max_rooms) {
            return response()->json([
                'message' => 'El total de habitaciones excede el límite permitido por el hotel.',
            ], 422);
        }

        // Actualizar la habitación
        $room->update($validated);

        return response()->json([
            'message' => 'Habitación actualizada correctamente.',
            'data' => $room->load(['hotel', 'room_type', 'accommodation']),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
