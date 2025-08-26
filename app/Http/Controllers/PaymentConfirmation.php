<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\PaymentNotificationMail;
use Illuminate\Support\Facades\Mail;


class PaymentConfirmation extends Controller
{
    public function index()
    {

        $data['meta_title'] = 'Payment Confirmation';

        $doc_list = Payment::getPaymentList();

        // Calculate date differences and total amounts
        foreach ($doc_list as $doc) {
            $checkIn = \Carbon\Carbon::parse($doc->check_in_date);
            $checkOut = \Carbon\Carbon::parse($doc->check_out_date);

            $doc->date_diff_days = $checkIn->diffInDays($checkOut);
            $doc->total_amount = $doc->rates * $doc->no_of_rooms * $doc->date_diff_days;
        }

        $data['doc_list'] = $doc_list;
        // dd($data['doc_list']);
        return view('backend.payment.index', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $auth_email = Auth::user()->email;

        $validator = Validator::make($request->input('formData'), [
            'total_amount_payed' => 'required|numeric',
            'date_payed' => 'required|date',
            'booking_id' => 'required|exists:bookings,id',
            'ref_tag' => 'required|exists:bookings,ref_tag',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $validated = $validator->validated();

        $booking_id = $validated['booking_id'];
        $total_amount_payed = $validated['total_amount_payed'];
        $date_payed = $validated['date_payed'];
        $ref_tag = $validated['ref_tag'];
        $timestamp = now();

        DB::beginTransaction();

        try {
            Payment::create([
                'bookings_id' => $booking_id,
                'total_amount_paid' => $total_amount_payed,
                'date_paid' => $date_payed,
                'status' => 1,
                'inby' => $auth_email,
                'modiby' => $auth_email,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);

            Booking::where('ref_tag', $ref_tag)->update(['payment_status' => 1]);

            DB::commit();

            $bookings_info = Booking::getBookingDetails($ref_tag);
    
            $contact_rep_name = "Joseph Imokia";
            $contact_rep_email = "imokhiajoseph@gmail.com";
            $contact_rep_phone = '0909987654';

            Mail::to($bookings_info->email)->send(new PaymentNotificationMail(
                $bookings_info->email,
                $bookings_info->name,
                $contact_rep_name,
                $contact_rep_email,
                $contact_rep_phone,
            ));

            return response()->json([
                'status' => 'success',
                'message' => 'Payment Confirmed successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing payment: ' . $e->getMessage(),
            ], 500);
        }
    }
}
