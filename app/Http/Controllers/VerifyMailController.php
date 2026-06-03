<?php

namespace App\Http\Controllers;

use App\Mail\SendVerifyMail;
use Illuminate\Support\Facades\Mail;

class VerifyMailController extends Controller
{
  public function index()
  {
    $mailData = [
      'title' => 'Mail from imsamnang.it@gmail.com',
      'body' => 'This is for testing email using smtp.'
    ];
    Mail::to('learningai514@gmail.com')->send(new SendVerifyMail($mailData));
    dd("Email is sent successfully.");
  }
}
