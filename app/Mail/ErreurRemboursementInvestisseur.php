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

class ErreurRemboursementInvestisseur extends Mailable
{
    use Queueable, SerializesModels;

    public $transactionErreur;
    public $startup;
    public $investisseur;

    /**
     * Create a new message instance.
     */
    public function __construct(Transaction $transactionErreur, CompteInvestisseur $investisseur, CompteStartup $startup)
    {
        $this->transactionErreur = $transactionErreur;
        $this->startup = $startup;
        $this->investisseur = $investisseur;
    }

    public function build()
    {
        return $this->subject("Erreur lors de la procédure de remboursement")
            ->view('emails.investisseur.erreur_remboursement')
            ->with([
                'montant' => $this->transactionErreur->montant,
                'transaction' => $this->transactionErreur,
                'startup' => $this->startup,
                'investisseur' => $this->investisseur,

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
