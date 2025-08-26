<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Booking;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $data['hotels'] = Hotel::getRecord();
		$data['meta_title'] = 'BATCH UPLOAD';
        return view('backend.bookings.index', $data);
    }

    public function download_template()
    {
        $fileName = 'booking_template.xlsx';
        $filePath = public_path('templates/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName);
        } else {
            return redirect()->back()->with('error', 'Template file not found.');
        }
    }

    private function convertExcelDate($value)
    {
        if (is_numeric($value)) {
            return \Carbon\Carbon::instance(
                \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
            )->format('Y-m-d');
        }

        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }


    public function batch_upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|exists:hotels,id',
            'excel'    => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $hotelId = $request->input('hotel_id');
        $file    = $request->file('excel');
        $data    = Excel::toArray([], $file);
        $rows    = $data[0] ?? [];

        if (!empty($rows) && count($rows) > 1) {
            foreach ($rows as $index => $row) {
                if ($index === 0) continue;

                $name    = $row[1] ?? null;
                $email   = $row[2] ?? null;
                $phone   = $row[3] ?? null;
                $roomType = trim($row[5] ?? '');

                $roomId = null;
                $checkInDate = null;
                $checkOutDate = null;
                $totalAmount = 0;

                if ($roomType) {
                    $room = RoomType::where('hotel_id', $hotelId)
                            ->where('type_of_rooms', 'like', $roomType)
                            ->first();

                    if ($room) {
                        $roomId = $room->id;

                        $noOfRooms      = (int)($row[6] ?? 1);
                        $checkInRaw     = $row[7] ?? null;
                        $checkOutRaw    = $row[8] ?? null;

                        if ($checkInRaw && $checkOutRaw) {
                            try {
                                $checkInDate  = $this->convertExcelDate($checkInRaw);
                                $checkOutDate = $this->convertExcelDate($checkOutRaw);

                                $days = \Carbon\Carbon::parse($checkInDate)
                                        ->diffInDays(\Carbon\Carbon::parse($checkOutDate));

                                $roomRatePerDay = $room->rates ?? 0;
                                $totalAmount = $days * $roomRatePerDay * $noOfRooms;
                            } catch (\Exception $e) {
                                $totalAmount = 0;
                            }
                        }
                    }
                }

                $arrivalAirline  = $row[10] ?? null;
                $arrivalTime     = $row[12] ?? null;

                // Generate ref_tag
                $refTag = 'INVALID/' . rand(1000, 9999);
                if ($name && $email && $phone) {
                    if (!empty($hotelId) && $arrivalAirline && $arrivalTime) {
                        $refTag = 'RSVP/HFL/' . rand(1000, 9999);
                    } elseif (!empty($hotelId)) {
                        $refTag = 'RSVP/HTL/' . rand(1000, 9999);
                    } elseif ($arrivalAirline && $arrivalTime) {
                        $refTag = 'RSVP/FLT/' . rand(1000, 9999);
                    } else {
                        $refTag = 'RSVP/NOR/' . rand(1000, 9999);
                    }
                }

                $hotel = Hotel::find($hotelId);
                $hotel_name = $hotel->name ?? '';

                if (trim($row[4]) === trim($hotel_name)) 
                {
                    Booking::create([
                        'name'                   => $name,
                        'phone'                  => $phone,
                        'email'                  => $email,
                        'hotel_id'               => $hotelId,
                        'arrival_date'           => $row[11] ?? null,
                        'arrival_airline_name'   => $arrivalAirline,
                        'arrival_flight_time'    => $arrivalTime,
                        'arrival_airport'        => $row[9] ?? null,
                        'departure_date'         => $row[15] ?? null,
                        'departure_airline_name' => $row[14] ?? null,
                        'departure_flight_time'  => $row[13] ?? null,
                        'departure_airport'      => $row[16] ?? null,
                        'room_type'              => $roomId,
                        'no_of_rooms'            => $noOfRooms ?? 1,
                        'ref_tag'                => $refTag,
                        'check_in_date'          => $checkInDate,
                        'check_out_date'         => $checkOutDate,
                        'total_amount'           => $totalAmount,
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Hotel name does not match the selected hotel.'
                    ], 422);
                }

           
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Bookings uploaded successfully.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No data found in the uploaded file.'
        ], 400);
    }



}
