<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nom') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="role" value="{{ __('Rôle') }}" />
                <select id="role" name="role"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    required>
                    <option value="Startup" {{ old('role') == 'Startup' ? 'selected' : '' }}>{{ __('Startup') }}
                    </option>
                    <option value="Investisseur" {{ old('role') == 'Investisseur' ? 'selected' : '' }}>
                        {{ __('Investisseur') }}</option>
                </select>
            </div>

            <div id="type-abonnement-field" class="mt-4" style="display: none;">
                <x-label for="type_abonnement" value="{{ __('Type Abonnement') }}" />
                <select id="type_abonnement" name="type_abonnement"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    required>
                    <option value="Simple" {{ old('type_abonnement') == 'Simple' ? 'selected' : '' }}>
                        {{ __('Simple') }}</option>
                    <option value="Premium" {{ old('type_abonnement') == 'Premium' ? 'selected' : '' }}>
                        {{ __('Premium') }}</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Mot de passe') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Avez-vous déjà un compte?') }}
                </a>

                {{-- <x-button class="ms-4 bg-blue-800 hover:bg-blue-900">
                    {{ __('Register') }}
                </x-button> --}}
                <button type="submit"
                    class="ms-4 px-6 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md
           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                    Créer un compte
                </button>
            </div>
        </form>
    </x-authentication-card>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleField = document.getElementById('role');
            const typeAbonnementField = document.getElementById('type-abonnement-field');

            function toggleTypeAbonnementField() {
                if (roleField.value === 'Startup') {
                    typeAbonnementField.style.display = 'block';
                } else {
                    typeAbonnementField.style.display = 'none';
                }
            }

            // Initial check
            toggleTypeAbonnementField();

            // Listen for changes
            roleField.addEventListener('change', toggleTypeAbonnementField);
        });
    </script>
</x-guest-layout>
