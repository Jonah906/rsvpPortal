<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BookingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rsvp_name, $hotel_info, $room_info, $check_in_date, $check_out_date, $ref_tag, $hotel_id, $number_of_nights, $total_amount, $contact_rep_phone, $contact_rep_email, $contact_rep_name, $qrPath ;

    public function __construct($rsvp_name, $hotel_id, $hotel_info, $room_info, $check_in_date, $check_out_date, $ref_tag, $contact_rep_phone, $contact_rep_email, $contact_rep_name, $qrPath  )
    {
        $this->rsvp_name = $rsvp_name;
        $this->hotel_id = $hotel_id;
        $this->hotel_info = $hotel_info;
        $this->room_info = $room_info;
        $this->check_in_date = $check_in_date;
        $this->check_out_date = $check_out_date;
        $this->ref_tag = $ref_tag;
        $this->contact_rep_phone = $contact_rep_phone;
        $this->contact_rep_email = $contact_rep_email;
        $this->contact_rep_name = $contact_rep_name;

        $this->number_of_nights = now()->parse($check_in_date)->diffInDays(now()->parse($check_out_date));
        $this->total_amount = $this->number_of_nights * ($room_info->rates ?? 0);

        $this->qrPath = $qrPath;
    }

    public function build()
    {
        return $this->subject('Your RSVP Confirmation – Dr. Henry Akpata')
                    ->view('emails.booking_notification')
                    ->attach($this->qrPath, [
                        'as' => 'qr-code.png',
                        'mime' => 'image/png',
                    ]);
    }
}
