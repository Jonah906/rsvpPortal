<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Booking;

use Illuminate\Http\Request;
use App\Exports\ExportBooking;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function index()
    {
        $data['admin_list'] = User::getAdminList();
		$data['doc_list'] = User::getAttendanceList();
        $data['meta_title'] = 'Reports';

		
		return view('backend.report.index', $data);
    }

    public function rsvp()
    {
        $data['doc_list'] = Hotel::getHotelList();
		$data['meta_title'] = 'RSVP Reports';

		return view('backend.report.rsvp', $data);
    }

    public function generate_bookings(Request $request)
    {
        $bookings = Booking::getBookings();
        return Excel::download(
            new ExportBooking($bookings),
            'BOOKINGS-' . date('Y-m-d') . '.xlsx'
        );

    }
}
