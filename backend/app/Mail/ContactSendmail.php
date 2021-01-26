<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        //
        $this->name = $input['name'];
        $this->email = $input['email'];
        $this->contact  = $input['contact'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('kkohei0325@gmail.com')
            ->subject('お問い合わせを受け付けました')
            ->view('contact.mail')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'contact'  => $this->contact,
            ]);
    }
}
