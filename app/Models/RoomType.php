<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomType
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Accommodation[] $accommodations
 * @property Collection|Room[] $rooms
 *
 * @package App\Models
 */
class RoomType extends Model
{
	protected $table = 'room_types';

	protected $fillable = [
		'name'
	];

	public function accommodations()
	{
		return $this->belongsToMany(Accommodation::class, 'room_type_accommodation_restrictions')
					->withPivot('id')
					->withTimestamps();
	}

	public function rooms()
	{
		return $this->hasMany(Room::class);
	}
}
