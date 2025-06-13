<!DOCTYPE html>
<html>
<body style="font-family:Arial,sans-serif; background:#f5f7fa; margin:0; padding:0;">
  <table width="100%" bgcolor="#f5f7fa" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" bgcolor="#fff" style="margin:40px 0; border-radius:8px; overflow:hidden; border:1px solid #e0e0e0;">
          <tr>
            <td bgcolor="#4e73df" style="padding:20px; text-align:center;">
              <h1 style="color:#fff; margin:0;">DocuEase</h1>
            </td>
          </tr>
          <tr>
            <td style="padding:30px;">
              <p>Hi,</p>
              <p>
                <strong>{{ $requestedBy }}</strong> has requested view access to
                "<em>{{ $title }}</em>" on {{ $requestedAt }}.
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
