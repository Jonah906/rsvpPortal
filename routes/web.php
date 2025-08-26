<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentConfirmation;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PaymentCycleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Frontend\RSVPController;
use App\Http\Controllers\Frontend\TributeController;
use App\Http\Controllers\Frontend\FrontendController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('venue', [FrontendController::class, 'venue'])->name('frontend.venue');
Route::get('vehicle-services', [FrontendController::class, 'vehicle'])->name('frontend.vehicle');
Route::get('committee', [FrontendController::class, 'committee'])->name('frontend.committee');
Route::get('aso-ebi', [FrontendController::class, 'cloth'])->name('frontend.cloth');

Route::get('rsvp', [RSVPController::class, 'index'])->name('rsvp.index');
Route::post('rsvp/store', [RSVPController::class, 'store'])->name('rsvp.store');
Route::post('rsvp/get_rooms_by_hotel', [RSVPController::class, 'get_rooms_by_hotel'])->name('rsvp.get_rooms_by_hotel');
Route::get('rsvp/ref_tag', [RSVPController::class, 'ref_tag'])->name('rsvp.ref_tag');

Route::get('tribute', [TributeController::class, 'index'])->name('tribute.index');
Route::post('tribute/store', [TributeController::class, 'store'])->name('tribute.store');


Route::post('rsvp/confirm_ref_tag', [RSVPController::class, 'confirm_ref_tag'])->name('rsvp.confirm_ref_tag');
Route::get('rsvp/edit', [RSVPController::class, 'edit'])->name('rsvp.edit');
Route::post('rsvp/update', [RSVPController::class, 'update'])->name('rsvp.update');
Route::post('/send-booking-email', [RSVPController::class, 'sendBookingNotification']);

Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'useradmin'], function(){

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('total_rsvp', [DashboardController::class, 'total_rsvp'])->name('total_rsvp');
    Route::post('filter_bookings_by_admin', [DashboardController::class, 'filter_bookings_by_admin']);
    Route::get('rsvp_hotel', [DashboardController::class, 'rsvp_hotel'])->name('rsvp_hotel');
    Route::get('rsvp_flight', [DashboardController::class, 'rsvp_flight'])->name('rsvp_flight');
    Route::get('booking_details/{hotel_id}', [DashboardController::class, 'booking_details'])->name('booking_details');
    Route::post('dashboard/generate_attendance', [DashboardController::class, 'generate_attendance'])->name('generate_attendance');
    Route::post('dashboard/generate_bookings_per_hotel/{id}', [DashboardController::class, 'generate_bookings_per_hotel'])->name('generate_bookings_per_hotel');

    

    Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
    

    Route::get('userrole', [UserRoleController::class, 'index'])->name('userrole.index');
    Route::get('userrole/create', [UserRoleController::class, 'create'])->name('userrole.create');
    Route::post('userrole/store', [UserRoleController::class, 'store'])->name('userrole.store');
    Route::get('userrole/edit/{id}', [UserRoleController::class, 'edit'])->name('userrole.edit');
    Route::post('userrole/update/{id}', [UserRoleController::class, 'update'])->name('userrole.update');
    Route::get('userrole/delete/{id}', [UserRoleController::class, 'destroy'])->name('userrole.destroy');

    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('users/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
    Route::post('users/updateprofile/{id}', [UserController::class, 'updateprofile'])->name('user.updateprofile');
    Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/download_template', [BookingController::class, 'download_template'])->name('download_template'); 
    Route::post('bookings/batch_upload', [BookingController::class, 'batch_upload'])->name('batch_upload'); 
    

    Route::get('payment_confirmation', [PaymentConfirmation::class, 'index'])->name('payment_confirmation.index');
    // Route::get('payment_confirmation/create', [PaymentConfirmation::class, 'create'])->name('payment_confirmation.create');
    Route::post('payment_confirmation/store', [PaymentConfirmation::class, 'store'])->name('payment_confirmation.store');
    Route::get('payment_confirmation/edit/{id}', [PaymentConfirmation::class, 'edit'])->name('payment_confirmation.edit');
    

    Route::get('departments', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('departments/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('departments/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('departments/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('departments/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('paymentcycle', [PaymentCycleController::class, 'index'])->name('paymentcycle.index');
    Route::get('paymentcycle/create', [PaymentCycleController::class, 'create'])->name('paymentcycle.create');
    Route::post('paymentcycle/store', [PaymentCycleController::class, 'store'])->name('paymentcycle.store');
    Route::get('paymentcycle/edit/{id}', [PaymentCycleController::class, 'edit'])->name('paymentcycle.edit');
    Route::post('paymentcycle/update/{id}', [PaymentCycleController::class, 'update'])->name('paymentcycle.update');
    Route::get('paymentcycle/delete/{id}', [PaymentCycleController::class, 'destroy'])->name('paymentcycle.destroy');

    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('subscriptions/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('subscriptions/store', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('subscriptions/edit/{id}', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::post('subscriptions/update/{id}', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::get('subscriptions/delete/{id}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');

    Route::get('subscriptions/renew', [SubscriptionController::class, 'showRenewalModal'])->name('subscription.renew');
    Route::post('subscriptions/renew/auto/{id}', [SubscriptionController::class, 'autoRenew'])->name('subscription.renew.auto');
    Route::post('subscriptions/renew/custom/{id}', [SubscriptionController::class, 'customRenew'])->name('subscription.renew.custom');

    Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('reports/rsvp', [ReportsController::class, 'rsvp'])->name('reports.rsvp');
    Route::post('reports/generate_bookings', [ReportsController::class, 'generate_bookings'])->name('generate_bookings'); 
});







