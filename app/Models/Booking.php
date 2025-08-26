<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Booking extends Model
{
  use HasFactory;

  protected $table = 'bookings';
  
  protected $fillable = [
    'name',
    'phone',
    'email',
    'hotel_id',
    'arrival_date',
    'arrival_airline_name',
    'arrival_flight_time',
    'arrival_airport',
    'departure_date',
    'departure_airline_name',
    'departure_flight_time',
    'departure_airport',
    'room_type',
    'no_of_rooms',
    'ref_tag',
    'check_in_date',
    'check_out_date',
    'car_hire',
    'car_id',
    'status',
    'total_amount',
    'payment_status',
    'created_at',
    'updated_at',
  ];

  public static function getSingle($id)
  {
    return self::where('id', $id)->first();
  }

  static public function getByRefTag($ref_tag)
  {
    return self::where('ref_tag', $ref_tag)->first();
  }

  public static function getTotalRecord()
  {
    return Booking::where('status', '1')->distinct('id')->count('id');
  }

  public static function getBookingsPerHotel()
  {
      return DB::table('hotels as a')
        ->select('a.id as hotel_id', 'a.name as hotel_name', DB::raw('COUNT(b.id) as total_bookings'))
        ->leftJoin('bookings as b', function($join) {
              $join->on('b.hotel_id', '=', 'a.id')
                  ->where('b.status', '=', 1);
        })
        ->groupBy('a.id', 'a.name')
        ->get();
  }

  public static function getRsvpBookings()
  {
      $result = DB::table('bookings')
        ->select(DB::raw('COUNT(DISTINCT id) as total_bookings_rsvp'))
        ->where('status', 1)
        ->where('hotel_id', '!=', 0)
        ->first();

      return $result->total_bookings_rsvp ?? 0;
  }

  public static function getFlightBookings()
  {
    $result = DB::table('bookings')
        ->select(DB::raw('COUNT(DISTINCT id) as total_bookings_rsvp'))
        ->where('status', 1)
        ->whereNotNull('arrival_airline_name')
        ->where('arrival_airline_name', '!=', '')
        ->first();

    return $result->total_bookings_rsvp ?? 0;
  }

  public static function getAttendanceList()
  {
    $bookings = DB::table('bookings as a')->select('a.name', 'a.email', 'a.phone', 'a.created_at', 'a.ref_tag')->where('a.status', 1)->get();

      $arr = [];

      foreach ($bookings as $index => $row) {
        $arr[] = [
          'sn'    => $index + 1,
          'name'  => $row->name,
          'email' => $row->email,
          'phone' => $row->phone,
          'ref_tag' => $row->ref_tag,
          'created_at' => $row->created_at
        ];
      }

    return $arr;
  }

  public static function getHotelRsvpList()
  {
    $results = DB::table('bookings as a')
      ->select(
        'a.id',
        'a.name',
        'a.arrival_date',
        'a.ref_tag',
        'a.phone',
        'a.hotel_id',
        'a.email',
        'a.no_of_rooms',
        'a.check_in_date',
        'a.check_out_date',
        'b.id as hotel_id',
        'b.name as hotel_name',
        'c.id as room_type_id',
        'c.type_of_rooms as room_type_name'
      )
      ->leftJoin('hotels as b', DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(b.id)'))
      ->leftJoin('room_types as c', function ($join) {
        $join->on(DB::raw('TRIM(a.room_type)'), '=', DB::raw('TRIM(c.id)'))
          ->whereRaw('TRIM(a.hotel_id) = TRIM(c.hotel_id)');
      })
      ->where('a.status', '1')
      ->where(function ($query) {
          $query->whereNotNull(DB::raw('TRIM(a.hotel_id)'))
          ->where(DB::raw('TRIM(a.hotel_id)'), '!=', '')
          ->where(DB::raw('TRIM(a.hotel_id)'), '!=', '0');
      })->get();

      // Transform into array with sn
      $arr = [];
      foreach ($results as $i => $row) {
        $arr[$i] = [
          'sn' => $i + 1,
          'id' => $row->id,
          'name' => $row->name,
          'phone' => $row->phone,
          'ref_tag' => $row->ref_tag,
          'email' => $row->email,
          'no_of_rooms' => $row->no_of_rooms,
          'check_in_date' => $row->check_in_date,
          'check_out_date' => $row->check_out_date,
          'hotel_name' => $row->hotel_name,
          'room_type_name' => $row->room_type_name,
        ];
      }
    return $arr;
  }

  public static function getFlightRsvpList()
  {
      $results = DB::table('bookings as a')
        ->select(
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
          'a.email'
        )
        ->where('a.status', '1')
        ->where(function ($query) {
          $query->where(function ($q) {
            $q->whereNotNull(DB::raw('TRIM(a.arrival_date)'))
              ->where(DB::raw('TRIM(a.arrival_date)'), '!=', '0000-00-00')
              ->where(DB::raw('TRIM(a.arrival_date)'), '!=', '');
          })
          ->orWhere(function ($q) {
            $q->whereNotNull(DB::raw('TRIM(a.departure_date)'))
              ->where(DB::raw('TRIM(a.departure_date)'), '!=', '0000-00-00')
              ->where(DB::raw('TRIM(a.departure_date)'), '!=', '');
          });
        })->get();

      // Format result with serial number
      $arr = [];
      foreach ($results as $i => $row) {
        $arr[$i] = [
          'sn' => $i + 1,
          'id' => $row->id,
          'name' => $row->name,
          'phone' => $row->phone,
          'ref_tag' => $row->ref_tag,
          'email' => $row->email,

          'arrival_date' => $row->arrival_date,
          'arrival_airline_name' => $row->arrival_airline_name,
          'arrival_flight_time' => $row->arrival_flight_time,
          'arrival_airport' => $row->arrival_airport,

          'departure_date' => $row->departure_date,
          'departure_airline_name' => $row->departure_airline_name,
          'departure_flight_time' => $row->departure_flight_time,
          'departure_airport' => $row->departure_airport,
        ];
      }

      return $arr;
  }

  public static function getBookingsByAdmin($admin_id)
  {
    $auth_email = Auth::user()->email;

    $subquery = DB::table('email_log')
      ->select(DB::raw('MAX(id) as latest_email_id'), 'booking_id')
      ->whereRaw('TRIM(contact_email) = ?', [$admin_id])
      ->groupBy('booking_id');

    $results = DB::table('bookings as b')
      ->select(
        'b.id as booking_id',
        'b.name',
        'b.hotel_id as hotel_id',
        'b.room_type as room_type_id',
        'b.ref_tag',
        'b.check_in_date',
        'b.check_out_date',
        'b.phone',
        'b.email',
        'b.created_at',
        'b.payment_status',
        'e.contact_email'
      )
      ->joinSub($subquery, 'e_latest', function ($join) {
        $join->on('e_latest.booking_id', '=', 'b.id');
      })
      ->leftJoin('email_log as e', 'e.id', '=', 'e_latest.latest_email_id')
      ->orderByDesc('b.id')
      ->get();

    return $results;
  }

  public static function getBookingPerHotel($hotel_id)
  {
    $results = DB::table('bookings as a')
      ->select(
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
        'b.id as hotel_id',
        'b.name as hotel_name',
        'c.id as room_type_id',
        'c.type_of_rooms as room_type_name',
        'c.rates'
      )
      ->leftJoin('hotels as b', DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(b.id)'))
        ->leftJoin('room_types as c', function ($join) {
          $join->on(DB::raw('TRIM(a.room_type)'), '=', DB::raw('TRIM(c.id)'))
          ->on(DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(c.hotel_id)'));
        })
        ->where('a.status', '1')
        ->where('a.hotel_id', $hotel_id)
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
        })->get();

      // Optional: add serial numbers (sn) like in original
      $arr = [];
      foreach ($results as $i => $row) {
        $arr[$i] = (array) $row;
        $arr[$i]['sn'] = $i + 1;
        $arr[$i]['id'] = $row->id;
        $arr[$i]['name'] = $row->name;
        $arr[$i]['phone'] = $row->phone;
        $arr[$i]['ref_tag'] = $row->ref_tag;
        $arr[$i]['email'] = $row->email;
        $arr[$i]['no_of_rooms'] = $row->no_of_rooms;
        $arr[$i]['check_in_date'] = $row->check_in_date;
        $arr[$i]['check_out_date'] = $row->check_out_date;
        $arr[$i]['hotel_name'] = $row->hotel_name;
        $arr[$i]['arrival_date'] = $row->arrival_date;
        $arr[$i]['arrival_airline_name'] = $row->arrival_airline_name;
        $arr[$i]['arrival_flight_time'] = $row->arrival_flight_time;
        $arr[$i]['arrival_airport'] = $row->arrival_airport;
        $arr[$i]['departure_date'] = $row->departure_date;
        $arr[$i]['departure_airline_name'] = $row->departure_airline_name;
        $arr[$i]['departure_flight_time'] = $row->departure_flight_time;
        $arr[$i]['departure_airport'] = $row->departure_airport;
        $arr[$i]['room_type_name'] = $row->room_type_name;
        $arr[$i]['rates'] = $row->rates;
        $arr[$i]['hotel_id'] = $row->hotel_id;
        ++$i;
      }

    return $arr;
  }

  public static function getBookingPerHotelExport($hotel_id)
  {
    $results = DB::table('bookings as a')
      ->select(
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
        'b.id as hotel_id',
        'b.name as hotel_name',
        'c.id as room_type_id',
        'c.type_of_rooms as room_type_name',
        'c.rates'
      )
      ->leftJoin('hotels as b', DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(b.id)'))
        ->leftJoin('room_types as c', function ($join) {
          $join->on(DB::raw('TRIM(a.room_type)'), '=', DB::raw('TRIM(c.id)'))
          ->on(DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(c.hotel_id)'));
        })
        ->where('a.status', '1')
        ->where('a.hotel_id', $hotel_id)
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
        })->get();

      // Optional: add serial numbers (sn) like in original
      $final = [];

      foreach ($results as $index => $row) {
          $checkIn  = (!empty($row->check_in_date) && $row->check_in_date !== '0000-00-00') ? Carbon::parse($row->check_in_date) : null;
          $checkOut = (!empty($row->check_out_date) && $row->check_out_date !== '0000-00-00') ? Carbon::parse($row->check_out_date) : null;

          $nights = $checkIn && $checkOut ? $checkIn->diffInDays($checkOut) : 0;
          $totalAmount = $nights * ($row->rates ?? 0) * ($row->no_of_rooms ?? 0);

          $final[] = [
              'sn'               => $index + 1,
              'name'             => $row->name,
              'hotel_name'       => $row->hotel_name,
              'phone'            => $row->phone,
              'email'            => $row->email,
              'room_type_name'   => $row->room_type_name,
              'no_of_rooms'      => $row->no_of_rooms,
              'check_in_date'    => $row->check_in_date,
              'check_out_date'   => $row->check_out_date,
              'rates'            => $row->rates,
              'nights'           => $nights,
              'total_amount'     => $totalAmount,
          ];
      }

      return collect($final);
  }

  public static function getBookingDetails($ref_tag)
  {
    return Booking::where('ref_tag', $ref_tag)->first();
  }

  public static function getAdminAttendanceList($admin_email)
  {
    $results = DB::select("
      SELECT b.name, b.email, b.phone, b.created_at, b.ref_tag, e.contact_email
      FROM bookings b
      INNER JOIN (
          SELECT MAX(id) AS latest_email_id, booking_id
          FROM email_log
          WHERE TRIM(contact_email) = ?
          GROUP BY booking_id
      ) e_latest ON e_latest.booking_id = b.id
      LEFT JOIN email_log e ON e.id = e_latest.latest_email_id
      WHERE b.status = '1'
      ORDER BY b.id DESC
    ", [$admin_email]);

    $arr = [];

    foreach ($results as $index => $row) {
      $arr[] = [
          'sn'             => $index + 1,
          'name'           => $row->name,
          'email'          => $row->email,
          'phone'          => $row->phone,
          'ref_tag'        => $row->ref_tag,
          'created_at'     => $row->created_at,
          'contact_email'  => $row->contact_email,
      ];
    }

    return collect($arr); 
  }

  public static function getBookings()
  {
    $results = DB::table('bookings as a')
        ->select(
            'a.id',
            'a.name',
            'a.arrival_date',
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
            DB::raw('b.id AS hotel_id'),
            DB::raw('b.name AS hotel_name'),
            DB::raw('c.id AS room_type_id'),
            DB::raw('c.type_of_rooms AS room_type_name'),
            DB::raw('c.rates')
        )
        ->leftJoin('hotels as b', DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(b.id)'))
        ->leftJoin('room_types as c', function ($join) {
            $join->on(DB::raw('TRIM(a.room_type)'), '=', DB::raw('TRIM(c.id)'))
                ->on(DB::raw('TRIM(a.hotel_id)'), '=', DB::raw('TRIM(c.hotel_id)'));
        })
        ->where(function ($query) {
            $query->whereRaw("TRIM(a.hotel_id) IS NOT NULL AND TRIM(a.hotel_id) != '' AND TRIM(a.hotel_id) != '0'")
                  ->orWhereRaw("TRIM(a.arrival_date) IS NOT NULL AND TRIM(a.arrival_date) != '0000-00-00' AND TRIM(a.arrival_date) != ''")
                  ->orWhereRaw("TRIM(a.departure_date) IS NOT NULL AND TRIM(a.departure_date) != '0000-00-00' AND TRIM(a.departure_date) != ''");
        })
        ->get();

    $arr = [];

    foreach ($results as $index => $row) {
      $arr[] = [
        'sn'                    => $index + 1,
        'name'                  => $row->name,
        'email'                 => $row->email,
        'phone'                 => $row->phone,
        'hotel_name'            => $row->hotel_name ?? 'N/A',
        'room_type_name'        => $row->room_type_name ?? 'N/A',
        'no_of_rooms'           => $row->no_of_rooms ?? '0',
        'check_in_date'         => $row->check_in_date ?? '',
        'check_out_date'        => $row->check_out_date ?? '',
        'arrival_airport'       => $row->arrival_airport ?? '',
        'arrival_airline_name'  => $row->arrival_airline_name ?? '',
        'arrival_date'          => $row->arrival_date ?? '',
        'arrival_flight_time'   => $row->arrival_flight_time ?? '',
        'departure_airport'     => $row->departure_airport ?? '',
        'departure_airline_name'=> $row->departure_airline_name ?? '',
        'departure_date'        => $row->departure_date ?? '',
        'departure_flight_time' => $row->departure_flight_time ?? '',
      ];
    }

    return $arr;
  }

}
