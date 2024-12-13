<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-medium text-gray-700">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @role('Startup')
                <div>
                    <div class="mt-10 sm:mt-0">
                        @php
                            $startup = auth()->user()->compteStartup; // Supposons que la relation est définie dans User
                        @endphp

                        @if ($startup)
                            @livewire('profil-startup', ['startup' => $startup])
                        @else
                            <div
                                class="flex items-center justify-center p-4 bg-yellow-100 border border-yellow-300 rounded-md shadow-sm">
                                <svg class="w-6 h-6 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m0-4h.01M12 18.5a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                                </svg>
                                <span class="font-medium text-yellow-800">
                                    {{ __('Aucun compte startup associé.') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <x-section-border />
                </div>
            @endrole

            @role('Investisseur')
                <div>
                    <div class="mt-10 sm:mt-0">
                        @php
                            $investisseur = auth()->user()->compteInvestisseur; // Supposons que la relation est définie dans User
                        @endphp

                        @if ($investisseur)
                            @livewire('profil-investisseur', ['investisseur' => $investisseur])
                        @else
                            <div
                                class="flex items-center justify-center p-4 bg-yellow-100 border border-yellow-300 rounded-md shadow-sm">
                                <svg class="w-6 h-6 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m0-4h.01M12 18.5a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                                </svg>
                                <span class="font-medium text-yellow-800">
                                    {{ __('Aucun compte investisseur associé.') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <x-section-border />
                </div>
            @endrole


            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
