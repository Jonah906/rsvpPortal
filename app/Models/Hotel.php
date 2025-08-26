<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $fillable = [
      'name',
      'address',
      'rating',
      'no_of_rooms',
      'contact_name',
      'contact_phone',
      'status',
      'created_at',
      'updated_at',
      'bank_name',
      'account_name',
      'account_number',
    ];

    static public function getSingle($id)
    {
        return self::where('id', $id)->first();
    }

    static public function getRecord()
    {
        return self::select('*')
               ->where('status', 1)
               ->orderBy('id', 'desc')
               ->get();
    }

    static public function get_rooms_by_hotel($hotel_id)
    {
        return DB::table('room_types as a')
            ->select(
                'a.id',
                'a.type_of_rooms',
                'a.no_of_rooms',
                'a.rates',
                DB::raw('(a.no_of_rooms - COALESCE(SUM(CASE WHEN b.status = 1 THEN b.no_of_rooms ELSE 0 END), 0)) AS available_rooms')
            )
            ->leftJoin('bookings as b', function ($join) {
                $join->on('b.room_type', '=', 'a.id')
                    ->on('b.hotel_id', '=', 'a.hotel_id');
            })
            ->where('a.hotel_id', $hotel_id)
            ->groupBy('a.id', 'a.type_of_rooms', 'a.no_of_rooms', 'a.rates')
            ->orderByDesc('a.id')
            ->get();
    }

    public static function getHotelList()
    {
        $results = DB::table('bookings as a')
            ->select([
                'a.id',
                'a.name',
                'a.arrival_date',
                'a.ref_tag',
                'a.arrival_airline_name',
                'a.arrival_flight_time',
                'a.arrival_airport',
                'a.departure_date',
                'a.departure_airline_name',
                'a.departure_flight_time',
                'a.departure_airport',
                'a.phone',
                'a.hotel_id',
                'a.email',
                'a.no_of_rooms',
                'a.check_in_date',
                'a.check_out_date',
                'a.created_at',
                'b.id as hotel_id',
                'b.name as hotel_name',
                'c.id as room_type_id',
                'c.type_of_rooms as room_type_name',
            ])
            ->leftJoin('hotels as b', DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(b.id)'))
            ->leftJoin('room_types as c', function ($join) {
                $join->on(DB::raw('TRIM(a.room_type)'), '=', DB::raw('TRIM(c.id)'))
                    ->on(DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(c.hotel_id)'));
            })
            ->where('a.status', '1')
            ->where(function ($query) {
                $query->where(function ($q) {
                        $q->whereNotNull(DB::raw('TRIM(a.hotel_id)'))
                        ->where(DB::raw('TRIM(a.hotel_id)'), '!=', '')
                        ->where(DB::raw('TRIM(a.hotel_id)'), '!=', '0');
                    })
                    ->orWhere(function ($q) {
                        $q->whereNotNull(DB::raw('TRIM(a.arrival_date)'))
                        ->where(DB::raw('TRIM(a.arrival_date)'), '!=', '')
                        ->where(DB::raw('TRIM(a.arrival_date)'), '!=', '0000-00-00');
                    })
                    ->orWhere(function ($q) {
                        $q->whereNotNull(DB::raw('TRIM(a.departure_date)'))
                        ->where(DB::raw('TRIM(a.departure_date)'), '!=', '')
                        ->where(DB::raw('TRIM(a.departure_date)'), '!=', '0000-00-00');
                    });
            })
            ->get();

        // Add serial numbers
        $arr = [];
        foreach ($results as $i => $row) {
            $arr[] = array_merge(
                ['sn' => $i + 1],
                (array) $row
            );
        }

        return $arr;
    }

    
}
