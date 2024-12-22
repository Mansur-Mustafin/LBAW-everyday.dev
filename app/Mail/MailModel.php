<?php

namespace App\Mail;

use App\Enums\MailTypeEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailModel extends Mailable
{
    use Queueable, SerializesModels;

    public array $mailData;
    public MailTypeEnum $type;

    public function __construct($mailData, $type)
    {
        $this->mailData = $mailData;
        $this->type = $type;
    }

    public function envelope(): Envelope
    {
        switch ($this->type) {
            case MailTypeEnum::RECOVER:
                return new Envelope(
                    from: new Address(env('MAIL_FROM_ADDRESS', 'support@everyday.dev.com'), env('MAIL_FROM_NAME', 'everyday.dev')),
                    subject: 'Recover Password',
                );
                break;

            case MailTypeEnum::PROFILE_UPDATE:
                return new Envelope(
                    from: new Address(env('MAIL_FROM_ADDRESS', 'support@everyday.dev.com'), env('MAIL_FROM_NAME', 'everyday.dev')),
                    subject: 'Update Your Profile',
                );
                break;

            default:
                break;
        }
    }

    public function content(): Content
    {
        switch ($this->type) {
            case MailTypeEnum::RECOVER:
                return new Content(view: 'emails.recover-password',);
                break;

            case MailTypeEnum::PROFILE_UPDATE:
                return new Content(view: 'emails.update-user',);
                break;

            default:
                break;
        }
    }

    public function attachments(): array
    {
        return [];
    }
}
