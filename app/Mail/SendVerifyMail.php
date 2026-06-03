<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerifyMail extends Mailable
{
  use Queueable, SerializesModels;

  public $mailData;
  /**
   * Create a new message instance.
   */
  public function __construct($mailData)
  {
    $this->mailData = $mailData;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      from: new Address('imsamnang.it@gmail.com', 'Samnang Tech'),
      replyTo: [
        new Address('applephagna@gmail.com', 'Samnang Tech'),
      ],
      subject: 'Send Verify Mail',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'mails.verify_email',
      with: [
        'mailmessage' => $this->mailData,
      ],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
