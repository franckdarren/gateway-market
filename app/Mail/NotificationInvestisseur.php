<?php

namespace App\Mail;

use App\Models\CompteInvestisseur;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationInvestisseur extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $compteInvestisseur;


    /**
     * Create a new message instance.
     */
    public function __construct(Transaction $transaction, CompteInvestisseur $compteInvestisseur)
    {
        $this->transaction = $transaction;
        $this->compteInvestisseur = $compteInvestisseur;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification Investisseur',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    public function build()
    {
        return $this->subject('Confirmation de votre investissement')
            ->view('emails.investisseur.notification')
            ->with([
                'description' => $this->transaction->description,
                'montant' => $this->transaction->montant,
                'statut' => $this->transaction->statut,
                'compteInvestisseur' => $this->compteInvestisseur,
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
