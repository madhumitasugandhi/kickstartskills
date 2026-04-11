<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailSubject;
    public $viewPath;
    public $mailData;

    public function __construct($subject, $viewPath, $data = [])
    {
        $this->mailSubject = $subject;
        $this->viewPath = $viewPath;
        $this->mailData = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: $this->viewPath,
            with: $this->mailData,
        );
    }
}
