<?php
// app/Notifications/EmailVerificationCode.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationCode extends Notification implements ShouldQueue
{
  use Queueable;

  public function __construct(
    private string $verificationCode
  ) {}

  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject('Email Verification Code')
      ->greeting('Hello ' . $notifiable->name . '!')
      ->line('Thank you for registering with us. Please use the verification code below to confirm your email address:')
      ->line('**Verification Code: ' . $this->verificationCode . '**')
      ->line('This code will expire in 10 minutes.')
      ->line('If you did not create an account, no further action is required.')
      ->salutation('Regards, ' . config('app.name'));
  }
}
