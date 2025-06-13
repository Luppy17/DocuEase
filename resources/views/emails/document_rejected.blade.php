<!DOCTYPE html>
<html>
<body style="font-family:Arial,sans-serif; background:#f5f7fa; margin:0; padding:0;">
  <table width="100%" bgcolor="#f5f7fa" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" bgcolor="#ffffff" style="margin:40px 0; border-radius:8px; overflow:hidden;">
          <tr>
            <td bgcolor="#e74a3b" style="padding:20px; text-align:center;">
              <h2 style="color:#fff; margin:0;">DocuEase</h2>
            </td>
          </tr>
          <tr>
            <td style="padding:30px;">
              <p>Hi {{ $document->creator->name }},</p>
              <p>
                Your document "<strong>{{ $title }}</strong>" has been <span style="color:#e74a3b;">rejected</span> by {{ $rejectedBy }} on {{ \Carbon\Carbon::parse($rejectedAt)->format('M d, Y H:i') }}.
              </p>
              <p>Thank you,<br>DocuEase Team</p>
            </td>
          </tr>
          <tr>
            <td bgcolor="#f5f7fa" style="padding:15px; text-align:center; font-size:12px; color:#999;">
              &copy; {{ date('Y') }} DocuEase. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
