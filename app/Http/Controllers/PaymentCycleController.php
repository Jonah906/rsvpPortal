<?php

namespace App\Http\Controllers;

use App\Models\Paymentcycle;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePaymentcycleRequest;
use App\Http\Requests\UpdatePaymentcycleRequest;

class PaymentCycleController extends Controller
{
    public function index()
    {
        $permissionsPaymentCycle = PermissionRole::getPermission('Payment Cycle', Auth::user()->role_id);
        if(empty($permissionsPaymentCycle))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }
        
        $data['permissionsAdd']  = PermissionRole::getPermission('Add Payment Cycle', Auth::user()->role_id);
        $data['permissionsEdit'] = PermissionRole::getPermission('Edit Payment Cycle', Auth::user()->role_id);
        $data['permissionsDelete'] = PermissionRole::getPermission('Delete Payment Cycle', Auth::user()->role_id);

        $paymentcycles = Paymentcycle::getRecord();
        return view('paymentcycle.index',$data, compact('paymentcycles'));
    }

    public function create()
    {
        $permissionsPaymentCycle = PermissionRole::getPermission('Add Payment Cycle', Auth::user()->role_id);
        if(empty($permissionsPaymentCycle))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        return view('paymentcycle.create');
    }

    public function store(StorePaymentcycleRequest $request)
    {
        $permissionsPaymentCycle = PermissionRole::getPermission('Add Payment Cycle', Auth::user()->role_id);
        if(empty($permissionsPaymentCycle))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $paymentcycle = $request->validated();

        Paymentcycle::create([
            'name' => $paymentcycle['name'],
            'first_reminder_period' => $paymentcycle['first_reminder_period'],
            'second_reminder_period' => $paymentcycle['second_reminder_period'],
            'createdBy' => Auth::user()->id,
        ]);

        $notification = array(
            'message' => 'Payment Cycle  Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('paymentcycle.index')->with($notification);

    }

    public function edit($id)
    {
        $permissionsPaymentCycle = PermissionRole::getPermission('Edit Payment Cycle', Auth::user()->role_id);
        if(empty($permissionsPaymentCycle))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $paymentcycle = Paymentcycle::getSingle($id);
        return view('paymentcycle.edit', compact('paymentcycle'));
    }

    public function update(UpdatePaymentcycleRequest $request, $id)
    {
        $permissionsPaymentCycle = PermissionRole::getPermission('Edit Payment Cycle', Auth::user()->role_id);
        if(empty($permissionsPaymentCycle))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $data = $request->validated();
        $paymentcycle = Paymentcycle::getSingle($id);

        $paymentcycle->update([
            'name' => $data['name'],
            'first_reminder_period' => $data['first_reminder_period'],
            'second_reminder_period' => $data['second_reminder_period'],
            'UpdatedBy' => 1
        ]);

        $notification = array(
            'message' => 'Payment Cycle Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('paymentcycle.index')->with($notification);
    }

    public function destroy($id)
    {
        $permissionsPaymentCycle = PermissionRole::getPermission('Delete Payment Cycle', Auth::user()->role_id);
        if(empty($permissionsPaymentCycle))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $paymentcyle = Paymentcycle::getSingle($id);
        $paymentcyle->delete();

        $notification = array(
            'message' => 'Payment Cycle Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('paymentcycle.index')->with($notification);

    }
}
