<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use App\Models\RoomType;
use App\Models\EmailSettings;
use App\Models\EmailLog;
use App\Mail\BookingNotificationMail;
use Illuminate\Support\Facades\Mail;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\File;


class RSVPController extends Controller
{
    private array $contactReps = [
        [
            'name' => 'Uju Nwanna',
            'phone' => '2347036288841',
            'email' => 'uju.nwanna@henryoakpata.com',
        ],
        [
            'name' => 'Jennifer Etsu',
            'phone' => '2348176139312',
            'email' => 'jennifer.etsu@henryoakpata.com',
        ],
        [
            'name' => 'Ufumwen Charles',
            'phone' => '2348033392667',
            'email' => 'ufumwen.charles@henryoakpata.com',
        ],
        [
            'name' => 'Vanessa Oma',
            'phone' => '2348182995500',
            'email' => 'vanessa.oma@henryoakpata.com',
        ],
        [
            'name' => 'Obuks Okeremeta',
            'phone' => '2347033510333',
            'email' => 'obuks.okeremeta@henryoakpata.com',
        ],
        [
            'name' => 'Daniel Eromosele',
            'phone' => '2349027441219',
            'email' => 'daniel.eromosele@henryoakpata.com',
        ],
        [
            'name' => 'David Edoziem',
            'phone' => '2347050821545',
            'email' => 'david.edoziem@henryoakpata.com',
        ],
    ];

    public function index()
    {
        $data['hotels'] = Hotel::getRecord();
        return view('frontend.rsvp.index', $data);
    }

    public function get_rooms_by_hotel(Request $request)
	{
        $hotel_id = $request->hotel_id;

		if (!$hotel_id) {
			echo json_encode(["error" => "Invalid Hotel Selection"]);
			return;
		}

		$rooms = Hotel::get_rooms_by_hotel($hotel_id);

		if (!$rooms) {
			echo json_encode([]);
		} else {
			echo json_encode($rooms);
		}
	}

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->input('formData'), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'oname' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:bookings,email',
            'arrival_date' => 'nullable|date',
            'arrival_airline_name' => 'nullable|string',
            'arrival_flight_time' => 'nullable|string',
            'arrival_airport' => 'nullable|string',
            'departure_date' => 'nullable|date',
            'departure_airline_name' => 'nullable|string',
            'departure_flight_time' => 'nullable|string',
            'departure_airport' => 'nullable|string',
            'hotel_id' => 'nullable|integer',
            'rooms' => 'nullable|numeric',
            'date_in' => 'nullable|date',
            'date_out' => 'nullable|date|after:date_in',
            'room_id' => 'nullable|integer',
        ], [
            'email.unique' => 'This email is already registered.',
        ]);

        // Step 2: Sanitize and extract values
        $data = $validator->validated();
        $name = trim(($data['fname'] ?? '') . ' ' . ($data['lname'] ?? '') . ' ' . ($data['oname'] ?? ''));

        $hotel = $room = null;
        $room_rate = 0;
        $total_amount = 0;
        $no_of_days = 0;

        if (!empty($data['hotel_id'])) {
            $hotel = Hotel::find($data['hotel_id']);
            if (!$hotel) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Hotel ID']);
            }

            $room = RoomType::getRoomInfo($data['room_id'], $data['hotel_id']);

            if (!$room) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Hotel Assets ID']);
            }

            if ($hotel->id == 1) {
                return response()->json(['status' => 'error', 'message' => 'This Hotel is not available on the selected date.']);
            }

            // Step 3: Calculate no of days and total amount
            $checkIn = new \Carbon\Carbon($data['date_in']);
            $checkOut = new \Carbon\Carbon($data['date_out']);
            $no_of_days = $checkIn->diffInDays($checkOut);
            $room_rate = $room->rates * ($data['rooms'] ?? 1);
            $total_amount = $no_of_days * $room_rate;
        }

        // Step 4: Generate ref tag
        $ref_tag = 'INVALID/' . rand();
        if ($name && $data['email'] && $data['phone']) {
            if (!empty($data['hotel_id']) && !empty($data['arrival_airline_name']) && !empty($data['arrival_flight_time'])) {
                $ref_tag = 'RSVP/HFL/' . rand();
            } elseif (!empty($data['hotel_id'])) {
                $ref_tag = 'RSVP/HTL/' . rand();
            } elseif (!empty($data['arrival_airline_name']) && !empty($data['arrival_flight_time'])) {
                $ref_tag = 'RSVP/FLT/' . rand();
            } else {
                $ref_tag = 'RSVP/NOR/' . rand();
            }
        }

        // Step 5: Create the booking record
        try {
            DB::beginTransaction();

            $booking = Booking::create([
                'name' => $name,
                'email' => $data['email'],
                'phone' => $data['phone'],
                'arrival_date' => $data['arrival_date'] ?? null,
                'arrival_airline_name' => $data['arrival_airline_name'] ?? null,
                'arrival_flight_time' => $data['arrival_flight_time'] ?? null,
                'arrival_airport' => $data['arrival_airport'] ?? null,
                'departure_date' => $data['departure_date'] ?? null,
                'departure_airline_name' => $data['departure_airline_name'] ?? null,
                'departure_flight_time' => $data['departure_flight_time'] ?? null,
                'departure_airport' => $data['departure_airport'] ?? null,
                'hotel_id' => $data['hotel_id'] ?? null,
                'no_of_rooms' => $data['rooms'] ?? null,
                'room_type' => $data['room_id'] ?? null,
                'check_in_date' => $data['date_in'] ?? null,
                'check_out_date' => $data['date_out'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
                'ref_tag' => $ref_tag,
                'total_amount' => $total_amount
            ]);

            if (!$booking) {
                throw new \Exception("Failed to create booking.");
            }

            $getEmailCount = EmailSettings::getEmailCounts();

            $emailCount = (int) $getEmailCount->email_count;
            $cycleCount = (int) $getEmailCount->cycle_count;

            $totalReps = count($this->contactReps);

            $cycleSize = $totalReps * 10;

            if ($emailCount >= $cycleSize) {
                $emailCount = 0;
                $cycleCount++;
            }

            $currentIndex = floor($emailCount / 10);

            $rep = $this->contactReps[$currentIndex];
            $contactRepName  = $rep['name'];
            $contactRepEmail = $rep['email'];
            $contactRepPhone = $rep['phone'];

            $emailCount++;

            EmailSettings::query()->update([
                'email_count' => $emailCount,
                'cycle_count' => $cycleCount,
            ]);

            EmailLog::create([
                'contact_email' => $contactRepEmail,
                'booking_id' => $booking->id,
            ]);

            // Ensure the directory exists
            $qrDir = public_path("qrcodes/" . dirname($ref_tag));
            if (!File::exists($qrDir)) {
                File::makeDirectory($qrDir, 0755, true); 
            }

            // $qrPath = public_path("qrcodes/{$ref_tag}.png");

            // $qrCode = Builder::create()->data($ref_tag)->size(300)->margin(10)->build();

            // $qrCode->saveToFile($qrPath);

            $verifyUrl = route('rsvp.ref_tag', ['ref_tag' => $ref_tag]);

            $qrData = "Reference: {$ref_tag}\nVerify here: {$verifyUrl}";

            $qrPath = public_path("qrcodes/{$ref_tag}.png");

            $qrCode = Builder::create()->data($qrData)->size(300)->margin(10)->build();

            $qrCode->saveToFile($qrPath);

            Mail::to($data['email'])->send(new BookingNotificationMail(
                $name,
                $data['hotel_id'],
                $hotel,
                $room,
                $data['date_in'],
                $data['date_out'],
                $ref_tag,
                $contactRepName,
                $contactRepEmail,
                $contactRepPhone,
                $qrPath  
            ));

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Booking created successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function ref_tag()
    {
        return view('frontend.rsvp.confirm_ref_tag');
    }

    public function confirm_ref_tag(Request $request)
    {
        $ref_id = $request->input('formData.ref_tag');

        $booking = Booking::where('ref_tag', $ref_id)->first();

        if ($booking && $booking->ref_tag) {
            return response()->json([
                'status' => 'success',
                'ref_tag' => $booking->ref_tag,
                'message' => 'Ref Tag Confirmation Successful'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $ref_tag = $request->query('ref_tag'); 

        $booking = Booking::getByRefTag($ref_tag);
        $hotel_list = Hotel::getRecord(); 

        if ($booking) {
            $full_name = $booking->name;
            $name_parts = explode(' ', $full_name);
            $booking->fname = $name_parts[0] ?? '';
            $booking->lname = $name_parts[1] ?? '';
            $booking->oname = $name_parts[2] ?? '';
            $booking->ref_tag = $ref_tag;
        }

        return view('frontend.rsvp.edit', [
            'bookings' => $booking,
            'hotel_list' => $hotel_list,
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->input('formData'), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'oname' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'arrival_date' => 'nullable|date',
            'arrival_airline_name' => 'nullable|string',
            'arrival_flight_time' => 'nullable|string',
            'arrival_airport' => 'nullable|string',
            'departure_date' => 'nullable|date',
            'departure_airline_name' => 'nullable|string',
            'departure_flight_time' => 'nullable|string',
            'departure_airport' => 'nullable|string',
            'hotel_id' => 'nullable|integer',
            'rooms' => 'nullable|numeric',
            'date_in' => 'nullable|date',
            'date_out' => 'nullable|date',
            'room_id' => 'nullable|string',
            'payment_status' => 'nullable|integer',
            'ref_tag' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        $data = $validator->validated();

        $fname = $data['fname'];
        $lname = $data['lname'];
        $oname = $data['oname'] ?? '';
        $name = trim("$fname $lname $oname");
        $ref_tag = $data['ref_tag'];
        $payment_status = $data['payment_status'] ?? 0;
        $hotel = $room = null;
        $room_rate = 0;
        $total_amount = 0;
        $no_of_days = 0;

        if (empty($ref_tag)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid Reference Tag']);
        }

        if ($payment_status == 1) {
            return response()->json(['status' => 'error', 'message' => 'Your payment has already been confirmed']);
        }

        if (isset($data['hotel_id']) && $data['hotel_id'] == 1) {
            return response()->json(['status' => 'error', 'message' => 'This Hotel is not available on the selected date.']);
        }
        
        if (!empty($data['hotel_id'])) {
            $hotel = Hotel::find($data['hotel_id']);
            if (!$hotel) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Hotel ID']);
            }

            $room = RoomType::getRoomInfo($data['room_id'], $data['hotel_id']);

            if (!$room) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Hotel Assets ID']);
            }

            if ($hotel->id == 1) {
                return response()->json(['status' => 'error', 'message' => 'This Hotel is not available on the selected date.']);
            }

            // Step 3: Calculate no of days and total amount
            $checkIn = new \Carbon\Carbon($data['date_in']);
            $checkOut = new \Carbon\Carbon($data['date_out']);
            $no_of_days = $checkIn->diffInDays($checkOut);
            $room_rate = $room->rates * ($data['rooms'] ?? 1);
            $total_amount = $no_of_days * $room_rate;
        }
        

        try {
            DB::beginTransaction();

           $booking = Booking::where('ref_tag', $ref_tag)->first();

            if (!$booking) {
                throw new \Exception("Booking not found.");
            }

            $booking->update([
                'name' => $name,
                'email' => $data['email'],
                'phone' => $data['phone'],
                'arrival_date' => $data['arrival_date'] ?? null,
                'arrival_airline_name' => $data['arrival_airline_name'] ?? null,
                'arrival_flight_time' => $data['arrival_flight_time'] ?? null,
                'arrival_airport' => $data['arrival_airport'] ?? null,
                'departure_date' => $data['departure_date'] ?? null,
                'departure_airline_name' => $data['departure_airline_name'] ?? null,
                'departure_flight_time' => $data['departure_flight_time'] ?? null,
                'departure_airport' => $data['departure_airport'] ?? null,
                'hotel_id' => $data['hotel_id'] ?? null,
                'no_of_rooms' => $data['rooms'] ?? null,
                'room_type' => $data['room_id'] ?? null,
                'check_in_date' => $data['date_in'] ?? null,
                'check_out_date' => $data['date_out'] ?? null,
                'updated_at' => now(),
                'total_amount' => $total_amount ?? 0  // make sure $total_amount is defined above
            ]);

            // Check if a contact rep was already assigned
            $existingRepEmail = EmailLog::where('booking_id', $booking->id)->value('contact_email');

            if ($existingRepEmail) {
                $index = collect($this->contactReps)->search(fn($rep) => $rep['email'] === $existingRepEmail);

                $contactRepName  = $this->contactReps[$index]['name'];
                $contactRepEmail = $existingRepEmail;
                $contactRepPhone = $this->contactReps[$index]['phone'];
            } else {
                $emailCounts = EmailSettings::getEmailCounts();
                $emailCount = (int)$emailCounts->email_count;
                $cycleCount = (int)$emailCounts->cycle_count;

                $totalReps = count($this->contactReps);
                $cycleSize = $totalReps * 10;

                if ($emailCount >= $cycleSize) {
                    $emailCount = 0;
                    $cycleCount++;
                }

                $currentIndex = floor($emailCount / 10);
                $rep = $this->contactReps[$currentIndex];

                $contactRepName  = $rep['name'];
                $contactRepEmail = $rep['email'];
                $contactRepPhone = $rep['phone'];

                $emailCount++;

                EmailSettings::query()->update([
                    'email_count' => $emailCount,
                    'cycle_count' => $cycleCount,
                ]);

                EmailLog::create([
                    'contact_email' => $contactRepEmail,
                    'booking_id' => $booking->id,
                ]);
            }

            // Get hotel and room info
            $hotel = Hotel::findOrFail($booking->hotel_id);
            $room = RoomType::findOrFail($booking->room_type);

            // Generate QR Code
            $qrDir = public_path("qrcodes/" . dirname($ref_tag));
            if (!File::exists($qrDir)) {
                File::makeDirectory($qrDir, 0755, true);
            }

            $verifyUrl = route('rsvp.ref_tag', ['ref_tag' => $ref_tag]);
            $qrData = "Reference: {$ref_tag}\nVerify here: {$verifyUrl}";
            $qrPath = public_path("qrcodes/{$ref_tag}.png");

            $qrCode = Builder::create()->data($qrData)->size(300)->margin(10)->build();
            $qrCode->saveToFile($qrPath);

            // Send mail to user
            Mail::to($booking->email)->send(new BookingNotificationMail(
                $booking->name,
                $booking->hotel_id,
                $hotel,
                $room,
                $booking->check_in_date,
                $booking->check_out_date,
                $ref_tag,
                $contactRepName,
                $contactRepEmail,
                $contactRepPhone,
                $qrPath
            ));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Booking updated successfully!',
                'booking_id' => $booking->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
