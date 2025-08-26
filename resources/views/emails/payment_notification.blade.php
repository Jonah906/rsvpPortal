<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Confirmation of Your Registration</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; background-color: #f4f4f7;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f7; padding: 30px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); padding: 40px;">
          <tr>
            <td align="center" style="padding-bottom: 20px;">
              <h2 style="color: #2C3E50; margin: 0;">Payment Confirmation</h2>
              <p style="color: #7f8c8d; font-size: 14px; margin: 5px 0 0;">RSVP Portal | Dr. Henry O. Akpata Burial</p>
            </td>
          </tr>
          <tr>
            <td style="font-size: 16px; line-height: 28px; color: #34495e;">
              <p>Dear <strong>{{ $recipient_name }}</strong>,</p>
              <p>Thank you for choosing to book your stay through our RSVP portal in preparation for attending the burial of our beloved father, <strong>Dr. Henry Omorogieva Akpata</strong>.</p>
              <p>We have received confirmation of your payment made directly to the hotel. The payment details have now been captured and confirmed on our portal.</p>
              <p>Please note that any modification, cancellation, or refund of your reservation is subject to the policy of the hotel you selected.</p>
              <p style="margin-top: 40px; font-weight: bold;">
                Regards,<br>
                The Planning Committee
              </p>
            </td>
          </tr>
          <tr>
            <td align="center" style="padding-top: 30px;">
              <hr style="border: none; height: 1px; background-color: #ecf0f1;">
              <p style="font-size: 12px; color: #95a5a6; margin-top: 15px;">
                © {{ date('Y') }} RSVP Portal | All rights reserved.
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
