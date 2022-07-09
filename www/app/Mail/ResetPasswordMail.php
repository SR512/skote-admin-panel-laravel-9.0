<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;

class ResetPasswordMail extends TemplateMailable
{
    use Queueable, SerializesModels;
    public $PRACTICE_NAME,$RESET,$TO;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->PRACTICE_NAME = config('constants.APP_NAME');
        $this->RESET = url('password/reset',$params['token']);
        $this->TO = $params['email'];
    }
    public function getHtmlLayout(): string
    {
        return view('email.email_layout')->render();
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cc = $bcc = [];
        $to = $this->TO;// array not accepting in to

        $email = $this->to($to)->cc($cc)->from(config('mail.from.address'));
        return $email;
    }
}
