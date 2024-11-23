<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validar entrada
        $request->validate([
            'search' => 'nullable|string|max:255',
            'city_id' => 'nullable|integer|exists:cities,id',
            'per_page' => 'nullable|integer|min:1|max:100'
        ]);

        // Aplicar filtros y paginación
        $hotels = Hotel::query()
            ->filterByName($request->get('search'))
            ->filterByCity($request->get('city_id'))
            ->with([
                'city',
                'rooms.room_type', 
                'rooms.accommodation', 
            ])
            ->paginate($request->get('per_page', 10));

        // Retornar datos con recursos
        return HotelResource::collection($hotels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request): HotelResource
    {
        $validated = $request->validated();

        $hotel = Hotel::create($validated);

        return new HotelResource($hotel);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return new HotelResource($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, Hotel $hotel): HotelResource
    {
        $validated = $request->validated();

        $hotel->update($validated);

        return new HotelResource($hotel); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return response()->json(null, 204);
    }
}
