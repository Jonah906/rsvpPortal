<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;
    
    protected $table = 'payments';
    protected $guarded = [
      'id',
    ];

    protected $fillable = [
        'bookings_id',
        'total_amount_paid',
        'date_paid',
        'status',
        'inby',
        'modiby	',
        'created_at',
        'updated_at',
    ];


    public static function getSingle($id)
    {
        return self::where('id', $id)->first();
    }


    public static function getPaymentList()
    {
        return DB::table('bookings as b')
            ->leftJoin('hotels as h', DB::raw('TRIM(b.hotel_id)'), '=', DB::raw('TRIM(h.id)'))
            ->leftJoin('room_types as r', DB::raw('TRIM(b.room_type)'), '=', DB::raw('TRIM(r.id)'))
            ->leftJoin('payments as p', DB::raw('TRIM(b.id)'), '=', DB::raw('TRIM(p.bookings_id)'))
            ->whereNotNull('b.hotel_id')
            ->where('b.hotel_id', '!=', '')
            ->where('b.status', '1')
            ->orderByDesc('b.id')
            ->select([
                'b.id as booking_id',
                'b.name',
                'b.hotel_id as hotel_id',
                'b.room_type as room_type_id',
                'b.ref_tag',
                'b.check_in_date',
                'b.check_out_date',
                'b.phone',
                'b.email',
                'b.no_of_rooms',
                'b.created_at',
                'b.payment_status',
                'h.id as hotel_id_ref',
                'r.id as room_type_id_ref',
                'r.rates',
                'p.id as payment_id',
                'p.bookings_id as payment_booking_id',
                'p.total_amount_paid'
            ])
        ->get();
    }

}
