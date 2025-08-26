<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'room_types';

    protected $fillable = [
      'hotel_id',
      'type_of_rooms',
      'rates',
      'no_of_rooms',
      'created_at',
      'updated_at',
    ];

    static public function getSingle($id)
    {
        return self::where('id', $id)->first();
    }


    public static function getRoomInfo($room_id, $hotel_id)
    {
        return self::where('hotel_id', $hotel_id)
                ->where('id', $room_id)
                ->select('type_of_rooms', 'rates')
                ->first();
    }

}
