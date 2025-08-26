<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Paymentcycle;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;

class SubscriptionController extends Controller
{
    public function index()
    {
        $permissionsSubscription = PermissionRole::getPermission('Subscription', Auth::user()->role_id);
        if(empty($permissionsSubscription))
        {
            return redirect()->route('dashboard')->with('error', "Unauthorized!!! Access Denied");
        }

        $data['permissionsAdd']  = PermissionRole::getPermission('Add Subscription', Auth::user()->role_id);
        $data['permissionsEdit'] = PermissionRole::getPermission('Edit Subscription', Auth::user()->role_id);
        $data['permissionsDelete'] = PermissionRole::getPermission('Delete Subscription', Auth::user()->role_id);

        $subscriptions = Subscription::getRecord();
        return view('subscription.index', $data, compact('subscriptions'));
    }

    public function create()
    {
        $permissionsSubscription = PermissionRole::getPermission('Add Subscription', Auth::user()->role_id);
        if(empty($permissionsSubscription))
        {
            return redirect()->route('dashboard')->with('error', "Unauthorized!!! Access Denied");
        }

        $paymentcycle = Paymentcycle::getRecord();
        $users = User::all();
        $categories = Category::getRecord();
        return view('subscription.create', compact('paymentcycle', 'users', 'categories'));
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $permissionsSubscription = PermissionRole::getPermission('Add Subscription', Auth::user()->role_id);
        if(empty($permissionsSubscription))
        {
            return redirect()->route('dashboard')->with('error', "Unauthorized!!! Access Denied");
        }

        $subscription = $request->validated();
        // dd($subscription);

        Subscription::create([
           'name' => $subscription['name'],
           'start_date' => $subscription['start_date'],
           'user' => $subscription['user'],
           'next_payment_date' => $subscription['next_payment_date'],
           'category' => $subscription['category'],
           'payment_cycle' => $subscription['payment_cycle'],
           'description' => $subscription['description'],
           'status' => 1,
           'createdBy' => Auth::user()->id,
        ]);

        return redirect()->route('subscription.index')->with('success', "Subscription Added Successfully");


    }

    public function edit($id)
    {
        $permissionsSubscription = PermissionRole::getPermission('Edit Subscription', Auth::user()->role_id);
        if(empty($permissionsSubscription))
        {
            return redirect()->route('dashboard')->with('error', "Unauthorized!!! Access Denied");
        }

        $subscription = Subscription::getSingle($id);
        $paymentcycle = Paymentcycle::getRecord();
        $users = User::all();
        $categories = Category::getRecord();

        return view('subscription.edit', compact('subscription', 'paymentcycle', 'users', 'categories'));
    }

    public function update(UpdateSubscriptionRequest $request, $id)
    {
        $permissionsSubscription = PermissionRole::getPermission('Edit Subscription', Auth::user()->role_id);
        if(empty($permissionsSubscription))
        {
            return redirect()->route('dashboard')->with('error', "Unauthorized!!! Access Denied");
        }

        $data = $request->validated();
        $subscription = Subscription::getSingle($id);

        // dd($subscription);
        $subscription->update([
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'user' => $data['user'],
            'next_payment_date' => $data['next_payment_date'],
            'category' => $data['category'],
            'payment_cycle' => $data['payment_cycle'],
            'description' => $data['description'],
            'updatedBy' => Auth::user()->id,
        ]);

        return redirect()->route('subscription.index')->with('success', "Subscription Updated Successfully");
    }

    public function destroy($id)
    {
        $permissionsSubscription = PermissionRole::getPermission('Delete Subscription', Auth::user()->role_id);
        if(empty($permissionsSubscription))
        {
            return redirect()->route('dashboard')->with('error', "Unauthorized!!! Access Denied");
        }

        $subscription = Subscription::getSingle($id);
        $subscription->status = 0;

        $subscription->save();

        return redirect()->route('subscription.index')->with('error', "Subscription Deleted Successfully");

    }

    public function showRenewalModal()
    {
        // Fetch all subscriptions where next_payment_date has passed
        $subscriptions = Subscription::where('next_payment_date', '<', now())->get();

        // Bulk update subscriptions with expired next_payment_date to today
        Subscription::where('next_payment_date', '<', now())
            ->update(['next_payment_date' => now()]);

        return view('subscription_renewal.renewal', compact('subscriptions'));
    }

    // Method to handle the auto-renewal logic
    public function autoRenew($id)
    {
        $subscription = Subscription::findOrFail($id);
        $paymentCycle = $subscription->paymentcycles->name;
        $nextPaymentDate = Carbon::parse($subscription->next_payment_date);

        // If the next payment date is in the past, reset it to today
        if ($nextPaymentDate < Carbon::now()) {
            $nextPaymentDate = Carbon::now();
        }

        // Update the next payment date based on the payment cycle
        if ($paymentCycle == 'Monthly') {
            $nextPaymentDate->addMonth();
        } elseif ($paymentCycle == 'Quarterly') {
            $nextPaymentDate->addMonths(3);
        } elseif ($paymentCycle == 'Yearly') {
            $nextPaymentDate->addYear();
        }

        $subscription->next_payment_date = $nextPaymentDate;
        $subscription->created_at = Carbon::now();  // Update created_at to reflect the renewal
        $subscription->save();

        return redirect()->route('subscription.renew')->with('success', 'Subscription auto-renewed successfully!');
    }

    // Method to handle custom date renewal
    public function customRenew(Request $request, $id)
    {
        $request->validate([
            'custom_date' => 'required|date',
        ]);

        $subscription = Subscription::findOrFail($id);
        $customDate = Carbon::parse($request->custom_date);

        // If the custom date is in the past, set it to today's date
        if ($customDate < Carbon::now()) {
            $customDate = Carbon::now();
        }

        $subscription->next_payment_date = $customDate;
        $subscription->created_at = Carbon::now();  // Update created_at to reflect the renewal
        $subscription->save();

        return redirect()->route('subscription.renew')->with('success', 'Subscription renewed with custom date successfully!');
    }
}
