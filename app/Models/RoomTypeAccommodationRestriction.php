<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomTypeAccommodationRestriction
 * 
 * @property int $id
 * @property int $room_type_id
 * @property int $accommodation_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property RoomType $room_type
 * @property Accommodation $accommodation
 *
 * @package App\Models
 */
class RoomTypeAccommodationRestriction extends Model
{
	protected $table = 'room_type_accommodation_restrictions';

	protected $casts = [
		'room_type_id' => 'int',
		'accommodation_id' => 'int'
	];

	protected $fillable = [
		'room_type_id',
		'accommodation_id'
	];

	public function room_type()
	{
		return $this->belongsTo(RoomType::class);
	}

	public function accommodation()
	{
		return $this->belongsTo(Accommodation::class);
	}
}
