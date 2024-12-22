<?php

use Illuminate\Mail\Mailable;

class PasswordResetMail extends Mailable
{
    public $resetData;

    public function __construct($resetData)
    {
        $this->resetData = $resetData; // Store the reset data for use in the email
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Password Reset Request',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.password-reset', // Point to the email view
        );
    }
}
