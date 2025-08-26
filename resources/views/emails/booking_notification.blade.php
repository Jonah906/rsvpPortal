<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation of Your Registration</title>
</head>
<body>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td>
                <table width="600" cellspacing="0" cellpadding="0" border="0" align="center">
                    <tr>
                        <td align="center">
                            <h1 style="font-size: 30px; margin-bottom: 20px; margin-top:40px; color: #63000F;">
                                THE FUNERAL SERVICE OF DR. HENRY OMOROGIEVA AKPATA<br/>RSVP PORTAL
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <p style="font-size: 16px; line-height:20px; margin-top:40px; color: #1E2331;">
                                Dear {{ $rsvp_name }},
                            </p>
                            <p style="font-size: 16px; line-height:20px; margin-top:20px; color: #1E2331;">
                                Thank you for registering your interest in attending the burial of our beloved Father DR. HENRY OMOROGIEVA AKPATA.
                                <br/>We appreciate your desire to honor his memory and be part of this solemn occasion.
                            </p>
                            <p style="font-size: 16px; line-height:20px; margin-top:20px; color: #1E2331;">
                                {{-- Your Reference Number is: <strong>htmlspecialchars({{ $ref_tag }})</strong> --}}
                                Your Reference Number is: <strong><?= htmlspecialchars($ref_tag) ?></strong>
                            </p>

                            <?php if (!empty($hotel_info) && !empty($room_info)) : ?>
                                <p style="font-size: 16px; line-height:20px; margin-top:40px; color: #1E2331;">
                                    You indicated interest in making a hotel reservation. Below are the details of your booking:
                                </p>

                                <table>
                                    <tr><td><strong>Hotel Name:</strong></td><td>{{ $hotel_info->name }}</td></tr>
                                    <tr><td><strong>Address:</strong></td><td>{{ $hotel_info->address }}</td></tr>
                                    <tr><td><strong>Room Type:</strong></td><td>{{ $room_info->type_of_rooms }}</td></tr>
                                    <tr><td><strong>Cost per Night:</strong></td><td>&#8358; {{ number_format($room_info->rates, 2) }}</td></tr>
                                    <tr><td><strong>Check-in Date:</strong></td><td>{{ \Carbon\Carbon::parse($check_in_date)->format('jS F, Y') }}</td></tr>
                                    <tr><td><strong>Check-out Date:</strong></td><td>{{ \Carbon\Carbon::parse($check_out_date)->format('jS F, Y') }}</td></tr>
                                    <tr><td><strong>Number of Nights:</strong></td><td>{{ $number_of_nights }}</td></tr>
                                    <tr><td><strong>Total Amount:</strong></td><td>&#8358; {{ number_format($total_amount, 2) }}</td></tr>
                                </table>

                                <p style="font-size: 16px; line-height:20px; margin-top:30px; color: #1E2331;">
                                    Kindly make payment to secure your reservation on or before <?= date("jS F, Y", strtotime("+4 days")) ?>:
                                </p>

                                <?php if ((int)$hotel_id === 0) : ?>
                                    <p style="font-size: 14px; line-height:20px; margin-top:30px; color: #1E2331;">
                                        For payment details, kindly reach out to the contact below:
                                    </p>
                                    <table width="600" cellspacing="1" cellpadding="2" border="0" align="center" style="background-color:#EAE8E7">
                                        <tr><td><strong>Contact Name:</strong></td><td><?= htmlspecialchars($hotel_info->contact_name) ?></td></tr>
                                        <tr><td><strong>Phone Number:</strong></td><td><?= htmlspecialchars($hotel_info->contact_phone) ?></td></tr>
                                    </table>
                                <?php else: ?>
                                    <table width="600" cellspacing="1" cellpadding="2" border="0" align="center" style="background-color:#EAE8E7">
                                        <tr><td><strong>Bank Name:</strong></td><td><?= htmlspecialchars($hotel_info->bank_name) ?></td></tr>
                                        <tr><td><strong>Account Name:</strong></td><td><?= htmlspecialchars($hotel_info->account_name) ?></td></tr>
                                        <tr><td><strong>Account Number:</strong></td><td><?= htmlspecialchars($hotel_info->account_number) ?></td></tr>
                                        <tr>
                                            <td colspan="2" align="center" style="font-size: 16px; color: #E30613;">
                                                Please send your proof of payment to <b><?= htmlspecialchars($contact_rep_phone) ?></b> / <b><?= htmlspecialchars($contact_rep_email) ?></b> for confirmation.
                                            </td>
                                        </tr>
                                    </table>
                                <?php endif; ?>
                            <?php endif; ?>

                            <p>Scan the QR code below for your booking reference:</p>
                            <img src="{{ asset("qrcodes/$ref_tag.png") }}" alt="QR Code" width="200">

                            <p style="font-size: 16px; line-height:20px; margin-top:40px; color: #1E2331;">
                                Kindly click on <a href="{{ route('rsvp.ref_tag') }}">Edit Reservation</a> to modify your RSVP details.
                            </p>

                            <p style="font-size: 16px; line-height:20px; margin-top:20px; color: #1E2331;">
                                Thank you and God bless.
                            </p>

                            <p style="font-size: 16px; line-height:20px; color: #1E2331;">
                                Regards,<br/>RSVP Committee
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
