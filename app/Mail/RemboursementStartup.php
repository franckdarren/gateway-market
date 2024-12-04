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

class RemboursementStartup extends Mailable
{
    use Queueable, SerializesModels;

    public $transactionReussi;
    public $startup;
    public $investisseur;

    /**
     * Create a new message instance.
     */
    public function __construct(Transaction $transactionReussi, CompteInvestisseur $investisseur, CompteStartup $startup)
    {
        $this->transactionReussi = $transactionReussi;
        $this->startup = $startup;
        $this->investisseur = $investisseur;
    }

    public function build()
    {
        return $this->subject("Confirmation de votre remboursement")
            ->view('emails.startup.remboursement')
            ->with([
                'montant' => $this->transactionReussi->montant,
                'transaction' => $this->transactionReussi,
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
