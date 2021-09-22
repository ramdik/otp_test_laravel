<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $hashOTP)
    {
        $this->name = $name;
        $this->otp = $hashOTP;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('udinjogres22@gmail.com')
            ->view('mail.email')
            ->with(
            [
                'name' => $this->name,
                'otp' => $this->otp,
            ]);
    }
} 