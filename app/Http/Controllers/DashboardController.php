<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Exports\ExportTotalRsvp;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportBookingPerHotel;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['total_bookings'] = Booking::getTotalRecord();
		$data['hotel_per_bookings'] = Booking::getBookingsPerHotel();
        // dd($data['hotel_per_bookings']);
		$data['total_bookings_rsvp'] = Booking::getRsvpBookings();
		$data['total_bookings_flight'] = Booking::getFlightBookings();

		$data['percentate_total_bookings'] = $data['total_bookings'] / 100;
		$data['percentate_total_bookings_rsvp'] = $data['total_bookings_rsvp'] / 100;
		$data['percentate_total_bookings_flight'] = $data['total_bookings_flight'] / 100;


        $data['meta_title'] = 'Dashboard';
        return view('dashboard', $data);
    }

    public function total_rsvp()
    {
        $data['admin_list'] = User::getAdminList();
		$data['doc_list']  =  Booking::getAttendanceList();


        $data['meta_title'] = 'Total RSVP Bookings';
        return view('backend.dashboard.total_rsvp', $data);
    }

    public function filter_bookings_by_admin(Request $request)
    {
        $admin_id = $request->admin_id;
	
		if (!empty($admin_id)) {
			$doc_list = Booking::getBookingsByAdmin($admin_id);
		} else {
			$doc_list = Booking::getAttendanceList();
		}
	
		if (!empty($doc_list)) {
			$i = 1;
			foreach ($doc_list as $doc) {
				echo 
                '<tr>
					<td class="text-center">' . $i++ . '</td>
					<td>' . strtoupper($doc->name) . '</td>
					<td>' . date('Y-m-d', strtotime($doc->created_at)) . '</td>
					<td>' . $doc->phone . '</td>
					<td>' . strtoupper($doc->email) . '</td>
					<td>' . $doc->ref_tag . '</td>
				</tr>';
			}
		} else {
			echo
            '<tr>
				<td colspan="6" class="text-center text-danger fw-bold">NO BOOKINGS AVAILABLE</td>
			</tr>';
		}
    }

    public function rsvp_hotel()
    {
        $data['doc_list'] = Booking::getHotelRsvpList();
        // dd($data['doc_list']);

        $data['meta_title'] = 'Total RSVP + Hotel Bookings';
        return view('backend.dashboard.rsvp_hotel', $data);
    }

    public function rsvp_flight()
    {
        $data['doc_list'] = Booking::getFlightRsvpList();
        // dd($data['doc_list']);

        $data['meta_title'] = 'Total RSVP + Flight';
        return view('backend.dashboard.rsvp_flight', $data);
    }

    public function booking_details($hotel_id)
    {
        $data['doc_list'] = Booking::getBookingPerHotel($hotel_id);
		$data['hotel_id'] = $hotel_id;

        $data['meta_title'] = 'Booking Details Per Hotel';
        return view('backend.dashboard.booking_details', $data);
    }

    public function settings()
    {
        $data['settings'] = Subscription::where('user', Auth::user()->id)->get();
        return view('settings', $data);

    }

    public function generate_attendance(Request $request)
    {
        $user = Auth::user();
        $admin_email = $user->email ?? null;

        $attendance = !empty($admin_email)
            ? Booking::getAdminAttendanceList($admin_email)
            : Booking::getAttendanceList();

        return Excel::download(
            new ExportTotalRsvp($attendance),
            'TOTAL-RSVP-' . date('Y-m-d') . '.xlsx'
        );
    }

    public function generate_bookings_per_hotel($hotel_id, Request $request)
    {
        $booking_per_hotel = Booking::getBookingPerHotelExport($hotel_id);
        return Excel::download(
            new ExportBookingPerHotel($booking_per_hotel),
            'BOOKING-PER-HOTEL-' . date('Y-m-d') . '.xlsx'
        );

    }
}
