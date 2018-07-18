<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        //
        $this->contact=$contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      // dd($this->contact);
      return $this->view('mail.temp')
                  ->subject('問い合わせ確認メール')
                  ->with([
                    // dd($this->contact->$name);
                    'name' => $this->contact->name,
                    'email' => $this->contact->email,
                    'message' =>$this->contact->message
                  ]);
    }
}
