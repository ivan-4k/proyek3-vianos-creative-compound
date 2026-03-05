<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Email - Seven Coffee</title>
  <style>
    /* Reset styles untuk email client */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
      background-color: #faf7f2;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Container utama */
    .email-wrapper {
      width: 100%;
      table-layout: fixed;
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
      letter-spacing: 2px;
      color: #f0e4d0;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .header p {
      margin: 10px 0 0;
      color: #e0c9a8;
      font-size: 16px;
      font-style: italic;
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

    .coffee-badge i {
      color: #cbaa7a;
      margin: 0 5px;
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

    /* Button verifikasi */
    .button-wrapper {
      text-align: center;
      margin: 35px 0;
    }

    .verify-button {
      display: inline-block;
      background: linear-gradient(135deg, #7b4f2b 0%, #9f6e3e 100%);
      color: #ffffff !important;
      font-weight: 700;
      font-size: 18px;
      padding: 16px 40px;
      text-decoration: none;
      border-radius: 50px;
      box-shadow: 0 8px 20px -5px rgba(123, 79, 43, 0.4);
      transition: all 0.3s ease;
      border: 1px solid #cbaa7a;
      letter-spacing: 0.5px;
    }

    .verify-button:hover {
      background: linear-gradient(135deg, #5a3a1f 0%, #7b4f2b 100%);
      box-shadow: 0 12px 25px -8px rgba(58, 42, 22, 0.5);
      transform: translateY(-2px);
    }


    /* Footer */
    .footer {
      background-color: #3e2a16;
      padding: 30px;
      text-align: center;
      border-top: 4px solid #cbaa7a;
    }

    .footer p {
      margin: 5px 0;
      color: #e0c9a8;
      font-size: 13px;
      line-height: 1.5;
    }

    .footer a {
      color: #cbaa7a;
      text-decoration: none;
      border-bottom: 1px dotted #cbaa7a;
    }

    .footer a:hover {
      color: #f0e4d0;
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

      .verify-button {
        display: block;
        padding: 14px 20px;
        font-size: 16px;
      }

      .coffee-icon {
        width: 30px;
        height: 30px;
        line-height: 30px;
        font-size: 16px;
      }
    }

    /* Fallback untuk email client lama */
    .fallback-text {
      display: none;
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
                <span>✦ VERIFIKASI EMAIL ✦</span>
              </div>
            </div>

            <!-- Content -->
            <div class="content">

              <!-- Greeting -->
              <div class="greeting">
                Halo <strong>{{ $user->name }}</strong>,
              </div>

              <!-- Main Message -->
              <div class="message">
                <p style="margin: 0 0 15px 0;">Terima kasih telah mendaftar di <strong>Seven Coffee</strong>! Kami
                  sangat senang menyambut kamu di keluarga besar pecinta kopi kami.</p>
                <p style="margin: 0;">Untuk menyelesaikan pendaftaran dan mengaktifkan akun kamu, silakan verifikasi
                  alamat email dengan mengklik tombol di bawah ini:</p>
              </div>

              <!-- Button Verifikasi -->
              <div class="button-wrapper">
                <a href="{{ $verificationUrl }}" class="verify-button">
                  ✦ VERIFIKASI EMAIL SEKARANG ✦
                </a>
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
