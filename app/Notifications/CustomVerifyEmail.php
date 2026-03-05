<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmailBase
{
  public function toMail($notifiable)
  {
    $verificationUrl = $this->verificationUrl($notifiable);

    return (new MailMessage)
      ->subject('Selamat Datang di Seven Coffee!')
      ->view('emails.custom-verify', [
        'user' => $notifiable,
        'verificationUrl' => $verificationUrl
      ]);
  }

  protected function verificationUrl($notifiable)
  {
    return URL::temporarySignedRoute(
      'verification.verify',
      Carbon::now()->addMinutes(60),
      ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
    );
  }
}
