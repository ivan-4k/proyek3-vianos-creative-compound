<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Seven Coffee</title>
  <style>
    /* Reset styles untuk email client */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
      background-color: #faf7f2;
    }

    /* Container utama */
    .email-wrapper {
      width: 100%;
      background-color: #faf7f2;
      padding: 30px 0;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 20px 40px -10px rgba(58, 42, 22, 0.2);
      border: 1px solid rgba(201, 151, 90, 0.2);
    }

    /* Header dengan gradien kopi */
    .header {
      background: linear-gradient(135deg, #5a3a1f 0%, #7b4f2b 50%, #9f6e3e 100%);
      padding: 40px 30px 30px;
      text-align: center;
      border-bottom: 4px solid #cbaa7a;
    }

    .header h1 {
      margin: 0;
      font-size: 42px;
      font-weight: 700;
      color: #f0e4d0;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Badge kopi */
    .coffee-badge {
      display: inline-block;
      background-color: rgba(240, 228, 208, 0.15);
      padding: 8px 20px;
      border-radius: 50px;
      margin-top: 15px;
      border: 1px solid #cbaa7a;
    }

    .coffee-badge span {
      color: #f0e4d0;
      font-size: 14px;
      letter-spacing: 1px;
    }

    /* Content area */
    .content {
      padding: 40px 35px;
      background-color: #ffffff;
    }

    /* Greeting */
    .greeting {
      font-size: 18px;
      color: #3e2a16;
      margin-bottom: 20px;
      font-weight: 500;
    }

    .greeting strong {
      color: #7b4f2b;
      font-weight: 700;
    }

    /* Body text */
    .message {
      color: #5a3a1f;
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 25px;
    }

    /* Button reset password */
    .button-wrapper {
      text-align: center;
      margin: 35px 0;
    }

    .reset-button {
      display: inline-block;
      background: linear-gradient(135deg, #7b4f2b 0%, #9f6e3e 100%);
      color: #ffffff !important;
      font-weight: 700;
      font-size: 18px;
      padding: 16px 40px;
      text-decoration: none;
      border-radius: 50px;
      box-shadow: 0 8px 20px -5px rgba(123, 79, 43, 0.4);
      border: 1px solid #cbaa7a;
      letter-spacing: 0.5px;
    }

    /* Warning info */
    .warning-text {
      background-color: #fff3e0;
      border: 1px solid #cbaa7a;
      border-radius: 8px;
      padding: 15px;
      margin: 25px 0;
      font-size: 14px;
      color: #5a3a1f;
    }

    .warning-text i {
      color: #7b4f2b;
      margin-right: 8px;
    }

    /* Footer */
    .footer {
      background-color: #3e2a16;
      padding: 30px;
      text-align: center;
      border-top: 4px solid #cbaa7a;
    }

    .footer p {
      margin: 0;
      color: #e0c9a8;
      font-size: 13px;
      line-height: 1.6;
    }

    /* Responsive */
    @media only screen and (max-width: 600px) {
      .email-container {
        margin: 0 15px;
        border-radius: 16px;
      }

      .header {
        padding: 30px 20px;
      }

      .header h1 {
        font-size: 32px;
      }

      .content {
        padding: 30px 20px;
      }

      .reset-button {
        display: block;
        padding: 14px 20px;
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <div class="email-wrapper">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
      <tr>
        <td align="center">
          <div class="email-container">

            <!-- Header Kopi -->
            <div class="header">
              <h1>☕ SEVEN COFFEE</h1>
              <div class="coffee-badge">
                <span>✦ RESET PASSWORD ✦</span>
              </div>
            </div>

            <!-- Content -->
            <div class="content">

              <!-- Greeting dengan fallback name -->
              <div class="greeting">
                Halo <strong>
                  {{ $user->name ?? ($user->nama ?? (explode('@', $user->email)[0] ?? 'Pecinta Kopi')) }}
                </strong>,
              </div>

              <!-- Main Message -->
              <div class="message">
                <p style="margin: 0 0 15px 0;">Kami menerima permintaan reset password untuk akun <strong>Seven
                    Coffee</strong> kamu.</p>
                <p style="margin: 0;">Jangan khawatir, kami bantu buat password baru. Klik tombol di bawah ini untuk
                  melanjutkan:</p>
              </div>

              <!-- Button Reset Password -->
              <div class="button-wrapper">
                <a href="{{ $resetUrl ?? '#' }}" class="reset-button">
                  ✦ RESET PASSWORD SEKARANG ✦
                </a>
              </div>

              <!-- Warning Info -->
              <div class="warning-text">
                <i>🔒</i> <strong>Penting:</strong> Link reset password ini akan kadaluarsa dalam <strong>60
                  menit</strong>.
                Jika kamu tidak meminta reset password, abaikan email ini dan akun kamu tetap aman.
              </div>
            </div>

            <!-- Footer -->
            <div class="footer">
              <p>© {{ date('Y') }} Vianos Creative Compound, Jl. Veteran No.88, Lemahabang, Kec. Indramayu,
                Kabupaten Indramayu, Jawa Barat 45212</p>
            </div>

          </div>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>
