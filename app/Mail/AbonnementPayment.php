<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbonnementPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment de l\'abonnement',
        );
    }

    public function build()
    {
        return $this->subject('Paiement de votre abonnement')
            ->view('emails.startup.abonnement')
            ->with([
                'compteStartup' => $this->user->CompteStartup,
                'amount' => $this->amount,

            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
