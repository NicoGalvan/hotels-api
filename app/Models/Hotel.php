<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Hotel
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $city_id
 * @property string $nit
 * @property int $max_rooms
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property City $city
 * @property Collection|Room[] $rooms
 *
 * @package App\Models
 */
class Hotel extends Model
{
	use SoftDeletes;
	protected $table = 'hotels';

	protected $casts = [
		'city_id' => 'int',
		'max_rooms' => 'int'
	];

	protected $fillable = [
		'name',
		'address',
		'city_id',
		'nit',
		'max_rooms'
	];

	public function city()
	{
		return $this->belongsTo(City::class);
	}

	public function rooms()
	{
		return $this->hasMany(Room::class);
	}
}
