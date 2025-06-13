<!DOCTYPE html>
<html>
<body style="font-family:Arial,sans-serif; background:#f5f7fa; margin:0; padding:0;">
  <table width="100%" bgcolor="#f5f7fa" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" bgcolor="#fff" style="margin:40px 0; border-radius:8px; overflow:hidden;">
          <tr>
            <td bgcolor="#6f42c1" style="padding:20px; text-align:center;">
              <h2 style="color:#fff; margin:0;">DocuEase Reminder</h2>
            </td>
          </tr>
          <tr>
            <td style="padding:30px;">
              <p>Hi,</p>
              <p>
                This is a reminder that <strong>{{ $actionType }}</strong> action is still pending on the
                <strong>{{ ucfirst($entityType) }}</strong>  
                "<em>{{ $title }}</em>" which was submitted over 24 hours ago.
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
