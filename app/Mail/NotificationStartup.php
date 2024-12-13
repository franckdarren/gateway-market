<?php

namespace App\Mail;

use App\Models\Transaction;
use App\Models\CompteStartup;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\CompteInvestisseur;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationStartup extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $compteInvestisseur;
    public $compteStartup;

    /**
     * Create a new message instance.
     */
    public function __construct(Transaction $transaction, CompteInvestisseur $compteInvestisseur, CompteStartup $compteStartup)
    {
        $this->transaction = $transaction;
        $this->compteInvestisseur = $compteInvestisseur;
        $this->compteStartup = $compteStartup;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification Startup',
        );
    }

    public function build()
    {
        return $this->subject('Confirmation de votre investissement')
            ->view('emails.startup.notification')
            ->with([
                'description' => $this->transaction->description,
                'montant' => $this->transaction->montant,
                'statut' => $this->transaction->statut,
                'compteInvestisseur' => $this->compteInvestisseur,
                'compteStartup' => $this->compteStartup,

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
