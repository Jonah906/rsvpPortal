<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionRenewalMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SubscriptionRenewal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $subscriptions = Subscription::with(["paymentcycles", "users"])->get();
        // foreach($subscriptions as $subscription)
        // {
        //    $paymentCycle = $subscription->paymentcycles;

        //    if($paymentCycle)
        //    {
            //   $nextPaymentDate = Carbon::parse($subscription->next_payment_date);

            //   $firstReminderPeriod = $paymentCycle->first_reminder_period;
            //   $secondReminderPeriod = $paymentCycle->second_reminder_period;

            //   $currentDate = Carbon::now();

            //   $daysDifference = $currentDate->diffInDays($nextPaymentDate);
            //   $roundedDaysDifference = ceil($daysDifference);

            //    if ($roundedDaysDifference == $firstReminderPeriod) {
            //       info("Send First Mail Reminder");
            //       // Mail::to($subscription->users->email)->send(new SubscriptionRenewalMail($subscription));
            //    }

            //    if ($roundedDaysDifference == $secondReminderPeriod) {
            //         info("Send Second Mail Reminder");
            //         Log::info('Subscription details', ['subscription' => $subscription]);
            //         $email = $subscription->users->email;

            //         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //             // Log::error('Valid email address', ['email' => $email]);
            //             Mail::to($email)->send(new SubscriptionRenewalMail($subscription));
            //         } else {
            //             Log::error('Invalid email address', ['email' => $email]);
            //         }
            //     }
        //    }
        // }
    }
}
