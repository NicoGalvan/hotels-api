<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Accommodation
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|RoomType[] $room_types
 * @property Collection|Room[] $rooms
 *
 * @package App\Models
 */
class Accommodation extends Model
{
	protected $table = 'accommodations';

	protected $fillable = [
		'name'
	];

	public function room_types()
	{
		return $this->belongsToMany(RoomType::class, 'room_type_accommodation_restrictions')
					->withPivot('id')
					->withTimestamps();
	}

	public function rooms()
	{
		return $this->hasMany(Room::class);
	}
}
