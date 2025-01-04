<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ErrorAbonnementPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tarif;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $tarif)
    {
        $this->user = $user;
        $this->tarif = $tarif;
    }

    public function build()
    {
        return $this->subject('Erreur lors du paiement de votre abonnement')
            ->view('emails.startup.error_payment')
            ->with([
                'compteStartup' => $this->user->CompteStartup,
                'tarif' => $this->tarif,

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
