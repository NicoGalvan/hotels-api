<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 * 
 * @property int $id
 * @property int $hotel_id
 * @property int $room_type_id
 * @property int $accommodation_id
 * @property int $total_rooms
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Hotel $hotel
 * @property RoomType $room_type
 * @property Accommodation $accommodation
 *
 * @package App\Models
 */
class Room extends Model
{
	protected $table = 'rooms';

	protected $casts = [
		'hotel_id' => 'int',
		'room_type_id' => 'int',
		'accommodation_id' => 'int',
		'total_rooms' => 'int'
	];

	protected $fillable = [
		'hotel_id',
		'room_type_id',
		'accommodation_id',
		'total_rooms'
	];

	public function hotel()
	{
		return $this->belongsTo(Hotel::class);
	}

	public function room_type()
	{
		return $this->belongsTo(RoomType::class);
	}

	public function accommodation()
	{
		return $this->belongsTo(Accommodation::class);
	}
}
