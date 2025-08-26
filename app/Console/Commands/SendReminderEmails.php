<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionRenewalMail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscription Renewal Reminder';

    public function handle()
    {
      $subscriptions = Subscription::with(["paymentcycles", "users"])->get();
      foreach($subscriptions as $subscription)
      {
          $paymentCycle = $subscription->paymentcycles;

          if($paymentCycle)
          {
            $nextPaymentDate = Carbon::parse($subscription->next_payment_date);

            $firstReminderPeriod = $paymentCycle->first_reminder_period;

            $secondReminderPeriod = $paymentCycle->second_reminder_period;

            $currentDate = Carbon::now();

            $daysDifference = $currentDate->diffInDays($nextPaymentDate);
            $roundedDaysDifference = ceil($daysDifference);

            if ($roundedDaysDifference == $firstReminderPeriod) {
              info("First Subscription Reminder");
              Mail::to('Jonah@example.com')->send(new SubscriptionRenewalMail($subscription));
            } elseif ($roundedDaysDifference == $secondReminderPeriod) {
              info("Second Subscription Reminder");
              Mail::to('Jonah@example.com')->send(new SubscriptionRenewalMail($subscription));
            } else {
              info("No Subscription Reminder Available at the moment");
            }
          }
      }
    }
}
