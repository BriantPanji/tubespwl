<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Verifikasi Email</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f9fafb; margin:0; padding:0;">
  <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center" style="padding: 40px 10px;">
        <table width="400" cellpadding="0" cellspacing="0" role="presentation" style="background: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
          <tr>
            <td style="text-align:center; padding-bottom: 20px;">
              <img src="{{ asset('img/logo/sudutlain_icon.png') }}" alt="Local Hidden Gem" width="60" />
            </td>
          </tr>
          <tr>
            <td>
              <h1 style="font-size: 24px; font-weight: 700; margin: 0 0 20px;">🎉 Selamat Datang di Local Hidden Gem!</h1>
              <p style="font-size: 16px; color: #333; line-height: 1.5;">
                Halo <strong>{{ $user->username }}</strong>,<br />
                Terima kasih telah bergabung bersama kami dalam menjelajahi tempat-tempat tersembunyi yang luar biasa!
              </p>
              <p style="text-align: center; margin: 30px 0;">
                <a href="{{ $url }}" style="background-color: #3b82f6; color: white; padding: 12px 25px; text-decoration: none; font-weight: 600; border-radius: 6px; display: inline-block;">
                  🔐 Verifikasi Email Sekarang
                </a>
              </p>
              <p style="font-size: 14px; color: #666; line-height: 1.4; border-top: 1px solid #eee; padding-top: 20px;">
                Dengan memverifikasi email ini, kamu bisa mulai membagikan dan menyimpan hidden gem favoritmu!<br/>
                Jika kamu tidak mendaftarkan akun ini, kamu bisa abaikan email ini.<br/><br/>
                Terima kasih,<br/>
                <strong>Tim Local Hidden Gem 🌟</strong>
              </p>
              <p style="font-size: 12px; color: #999; margin-top: 25px; word-break: break-all;">
                Jika tombol di atas tidak berfungsi, salin dan tempelkan URL berikut di browser kamu:<br/>
                <a href="{{ $url }}" style="color: #3b82f6;">{{ $url }}</a>
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
