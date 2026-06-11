<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public string $inviteUrl)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation to Join URL Shortener'
        );
    }

    public function content(): Content
    {
     
        return new Content(
            view: 'mail.invite',
            with: [
                'user' => $this->user,
                'acceptUrl' => $this->inviteUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}