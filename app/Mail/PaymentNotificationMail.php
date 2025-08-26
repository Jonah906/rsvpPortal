<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentNotificationMail extends Mailable
{
   use Queueable, SerializesModels;

    public $recipient_email, $recipient_name, $contact_rep_name, $contact_rep_email, $contact_rep_phone;

    public function __construct($recipient_email, $recipient_name, $contact_rep_name, $contact_rep_email, $contact_rep_phone)
    {
        $this->recipient_email = $recipient_email;
        $this->recipient_name = $recipient_name;
        $this->contact_rep_name = $contact_rep_name;
        $this->contact_rep_email = $contact_rep_email;
        $this->contact_rep_phone = $contact_rep_phone;
    }

    public function build()
    {
        return $this->subject('Payment Confirmation')
                    ->view('emails.payment_notification');
                    
    }
}
