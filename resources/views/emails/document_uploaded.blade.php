<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>DocuEase Notification</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f7fa; font-family:Arial, sans-serif;">
  <table width="100%" bgcolor="#f5f7fa" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" bgcolor="#ffffff" style="margin:40px 0; border-radius:8px; overflow:hidden; border:1px solid #e0e0e0;">


          <tr>
            <td bgcolor="#4e73df" style="padding:20px; text-align:center;">
              <h1 style="color:#ffffff; font-size:24px; margin:0;">DocuEase</h1>
            </td>
          </tr>


          <tr>
            <td style="padding:30px;">
              <p style="font-size:16px; color:#333333; margin:0 0 15px;">Hi,</p>

              <p style="font-size:16px; color:#333333; margin:0 0 20px;">
                <strong style="color:#4e73df;">{{ $uploadedBy }}</strong> has uploaded a new document.
              </p>

              <p style="font-size:18px; color:#555555; margin:0 0 25px;">
                "<em>{{ $title }}</em>"  
                <br>
                <small style="color:#888888;">Uploaded on {{ $uploadedAt }}</small>
              </p>

              <p style="font-size:16px; color:#333333; margin:0 0 25px;">
                <strong style="color:#e74a3b;">This document is pending your approval.</strong>
              </p>

              <p style="font-size:14px; color:#777777; margin:0 0 30px;">
                If you have any questions, please reach out to your team lead or IT support.
              </p>

              <p style="font-size:16px; color:#333333; margin:0;">
                Thank you,<br>
                <strong>DocuEase Team</strong>
              </p>
            </td>
          </tr>


          <tr>
            <td bgcolor="#f5f7fa" style="padding:15px; text-align:center; font-size:12px; color:#999999;">
              &copy; {{ date('Y') }} DocuEase. All rights reserved.
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
```