<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
      public function sendMail(){
        $data=[];
        dd("a");
        Mail::send(['text' => 'mail.temp'], $data, function($message){ $message->to("xxx@xxxxxx.com")->subject("テスト送信"); })
        return view('mail.complete');
      }
}
