<?php

namespace App\Mail;

use App\Models\Transaction;
use App\Models\CompteInvestisseur;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnulationInvestissement extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $compteInvestisseur;

    /**
     * Create a new message instance.
     *
     * @param Transaction $transaction
     * @param CompteInvestisseur $compteInvestisseur
     */
    public function __construct(Transaction $transaction, CompteInvestisseur $compteInvestisseur)
    {
        $this->transaction = $transaction;
        $this->compteInvestisseur = $compteInvestisseur;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Annulation de votre investissement')
            ->view('emails.investisseur.annulation_investissement')
            ->with([
                'description' => $this->transaction->description,
                'montant' => $this->transaction->montant,
                'compteInvestisseur' => $this->compteInvestisseur,
            ]);
    }
}
