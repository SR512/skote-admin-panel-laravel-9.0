<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;


class UserCreateNotification extends TemplateMailable
{
    use Queueable, SerializesModels;

    public $NAME, $PRACTICE_NAME, $USER, $PASSWORD, $LOGIN, $ROLE_NAME;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->NAME = $params['user'];
        $this->USER = $params['email'];
        $this->PASSWORD = $params['password'];
        $this->LOGIN = route('login');
        $this->PRACTICE_NAME = config('constants.APP_NAME');
        $this->ROLE_NAME = $params['role_name'];
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
        $to = $this->USER;// array not accepting in to

        $email = $this->to($to)->cc($cc)->from(config('mail.from.address'));
        return $email;
    }
}
