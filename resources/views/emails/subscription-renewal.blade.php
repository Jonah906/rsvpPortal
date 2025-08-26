@php
    use Carbon\Carbon;
@endphp

<x-mail::message>
E-Notice Subscription Renewal

<p>Dear {{ $subscription->users->fname ?? 'Valued Customer' }},</p>
<p>  
    This is a reminder for your {{ $subscription->name ?? 'subscription' }} 
    upcoming payment on {{ Carbon::parse($subscription->next_payment_date)->toFormattedDateString() ?? 'a soon-to-be-specified date' }}.
</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
