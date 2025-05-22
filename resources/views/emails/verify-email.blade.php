<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Verifikasi Email</title>
</head>
<body style="
  margin: 0; 
  padding: 0; 
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-image: url('https://res.cloudinary.com/dkh9gzs7y/image/upload/v1747903795/backgroundLogin_jb1skh.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
">
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: transparent;">
    <tr>
      <td align="center" style="padding: 40px 16px;">
        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px; background-color: #f4eefd; border-radius: 12px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); overflow: hidden; ">
          <tr>
            <td align="center" style="padding: 30px 30px 0;">
              <img src="https://res.cloudinary.com/dkh9gzs7y/image/upload/v1747902652/Kominasi_h9bjad.png" alt="Sudut Lain" width="162" style="display: block; margin-bottom: 10px;" />
            </td>
          </tr>
          <tr>  
            <td style="padding: 0 30px 20px;">
              <h1 style="font-size: 22px; font-weight: 700; margin: 0 0 15px; color: #5b188f; text-align: center;">Selamat Datang di Sudut Lain!</h1>
              <p style="font-size: 15px; color: #374151; line-height: 1.6; margin: 0;">
                Hai <strong>{{ $user->username }}</strong>,<br />
                Terima kasih telah bergabung untuk menjelajahi tempat-tempat tersembunyi yang luar biasa bersama kami!
              </p>  
            </td>
          </tr>
          <tr>
            <td align="center" style="padding: 30px 30px;">
              <a href="{{ $url }}" style="background-color: #3b82f6; color: #ffffff; padding: 14px 28px; font-size: 15px; font-weight: 600; text-decoration: none; border-radius: 8px; display: inline-block;">
                Verifikasi Email Sekarang
              </a>
            </td>
          </tr>
          <tr>
            <td style="padding: 0 30px;">
              <p style="font-size: 14px; color: #6b7280; line-height: 1.6; border-top: 1px solid #e5e7eb; padding-top: 20px; margin: 0;">
                Dengan memverifikasi email ini, kamu bisa mulai menyimpan dan membagikan <strong>Sudut Lain</strong> favoritmu.<br/>
                Jika kamu tidak merasa mendaftar, silakan abaikan email ini.<br/><br/>
                Salam hangat,<br/>
                <strong style="color: #8146af;">Tim Sudut Lain</strong>
              </p>
            </td>
          </tr>
          <tr>
            <td style="padding: 20px 30px 30px;">
              <p style="font-size: 12px; color: #9ca3af; line-height: 1.5; margin: 0; word-break: break-word;">
                Jika tombol di atas tidak berfungsi, salin dan tempelkan link berikut ke browser kamu:<br/>
                <a href="{{ $url }}" style="color: #3b82f6;">{{ $url }}</a>
              </p>
            </td>
          </tr>
        </table>
        <p style="font-size: 11px; color: #9ca3af; margin-top: 20px;">&copy; {{ date('Y') }} Sudut Lain. All rights reserved.</p>
      </td>
    </tr>
  </table>
</body>
</html>
