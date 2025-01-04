<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CompteStartup;
use App\Mail\AbonnementPayment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Mail\ErrorAbonnementPayment;
use Illuminate\Support\Facades\Mail;

class ProcessAbonnementPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abonnement:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process monthly subscription payments for all active users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Récupérer tous les utilisateurs avec un abonnement actif et dont la date de paiement est arrivée
        $users = User::whereNotNull('next_payment_date')
            ->where('next_payment_date', '<=', Carbon::now())
            ->get();

        // Traitement des paiements pour chaque utilisateur
        foreach ($users as $user) {
            // Vérifier si l'utilisateur a un abonnement actif
            if ($user->next_payment_date && $user->next_payment_date <= Carbon::now()) {
                $this->processPayment($user);
            }
        }

        $this->info('Monthly payments processed successfully!');
    }

    /**
     * Process payment for a specific user.
     *
     * @param User $user
     * @return void
     */
    private function processPayment(User $user)
    {
        // Récupérer le tarif d'abonnement basé sur le type d'abonnement
        $tarif = $this->getSubscriptionTarif($user->type_abonnement);

        // Vérifier si l'utilisateur a un compte startup et si le solde est suffisant
        if (!$user->CompteStartup) {
            $this->error('No CompteStartup found for user: ' . $user->email);
            return;
        }

        // Vérifier si le solde est suffisant pour le paiement
        if ($user->CompteStartup->solde < $tarif) {
            $this->error('Insufficient balance for user: ' . $user->email);

            // Désactiver l'utilisateur
            $user->is_active = false;
            $user->save();

            // Envoyer l'email à la startup
            Mail::to($user->CompteStartup->email)->send(new ErrorAbonnementPayment($user, $tarif));
            return;
        }

        // Tenter de traiter le paiement (ajouter ici votre logique de paiement réel, comme Stripe)
        if ($this->paymentAbonnement($user, $tarif)) {
            // Si le paiement est effectué, mettre à jour la date du prochain paiement
            $user->next_payment_date = Carbon::now()->addMonth()->startOfDay(); // Mise à jour du prochain paiement à la même date du mois suivant
            $user->is_active = true;
            $user->save();

            // Trace écrite de la transaction chez la Startup
            $startup = $user->compteStartup;
            $startup->transactions()->create([
                'montant' => $tarif,
                'type' => "Abonnement",
                'compte_type' => "Compte Startup",
                'compte_id' => $startup->id,
                'description' => "Renouvellement de l'abonnement de {$startup->nom}",
                'statut' => "Traitée",
            ]);

            // Envoyer l'email à la startup
            Mail::to($user->CompteStartup->email)->send(new AbonnementPayment($user, $tarif));

            $this->info('Payment successfully processed for user: ' . $user->email);
        } else {
            // Si le paiement échoue, loguer ou notifier l'échec
            $this->error('Payment failed for user: ' . $user->email);
        }
    }

    /**
     * Get subscription tarif based on the user's subscription type.
     *
     * @param string $type
     * @return int
     */
    private function getSubscriptionTarif(string $type): int
    {
        // Tarif basé sur le type d'abonnement
        if ($type === 'Premium') {
            return 30000; // Tarif premium
        }

        return 20000; // Tarif normal
    }

    /**
     * Simulate the payment process.
     *
     * @param User $user
     * @param int $amount
     * @return bool
     */
    private function paymentAbonnement(User $user, int $amount): bool
    {
        // Simuler un paiement et décrémenter le solde de l'utilisateur
        try {
            // Si tout est ok, retirer l'argent du solde
            $user->CompteStartup->solde -= $amount;
            $user->CompteStartup->save();

            return true; // Retourner `true` si le paiement est réussi
        } catch (\Exception $e) {
            // Loguer l'erreur s'il y a un problème
            Log::error('Payment processing failed for user: ' . $user->email . ' with error: ' . $e->getMessage());
            return false; // Retourner `false` si le paiement échoue
        }
    }
}
