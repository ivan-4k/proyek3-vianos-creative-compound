<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
  use Queueable;

  public $resetUrl;
  public $user;

  public function __construct($resetUrl, $user)
  {
    $this->resetUrl = $resetUrl;
    $this->user = $user;
  }

  public function via($notifiable)
  {
    return ['mail'];
  }

  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->subject('Reset Password Seven Coffee')
      ->view('emails.custom-reset-password', [
        'user' => $this->user,
        'resetUrl' => $this->resetUrl,
      ]);
  }
}
