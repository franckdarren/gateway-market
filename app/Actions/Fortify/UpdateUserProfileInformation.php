<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Gestion du changement de type d'abonnement
        if ($input['type_abonnement'] !== $user->type_abonnement) {
            $this->handleSubscriptionChange($user, $input['type_abonnement']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'type_abonnement' => $input['type_abonnement'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'type_abonnement' => $input['type_abonnement'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * Handle subscription type changes.
     */
    protected function handleSubscriptionChange(User $user, string $newSubscriptionType): void
    {
        if ($newSubscriptionType === 'Premium') {
            $user->upgradeToPremium();
        } elseif ($newSubscriptionType === 'Normal') {
            $user->downgradeToNormal();
        }
    }
}
