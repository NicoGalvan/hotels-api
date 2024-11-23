<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hotel_id' => $this->hotel_id,
            'room_type' => new RoomTypeResource($this->whenLoaded('room_type')), // Relación con room_type
            'accommodation' => new AccommodationResource($this->whenLoaded('accommodation')), // Relación con accommodation
            'total_rooms' => $this->total_rooms,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
