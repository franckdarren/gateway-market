<x-form-section submit="updateCompteInformation">
    <x-slot name="title">
        {{ __('Compte Startup') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Formulaire de modification du compte') }}
    </x-slot>

    <x-slot name="form">
        @if (session('success'))
            <div class="flex items-center justify-between p-4 mx-auto mb-4 space-x-4 text-white bg-green-500 rounded-md shadow-md md:fixed md:top-5 md:right-5"
                x-data="{ open: true }" x-show="open" x-transition>
                <span>{{ session('success') }}</span>
                <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Nom -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nom" value="{{ __('Nom') }}" />
            <x-input id="nom" type="text" class="block w-full mt-1" wire:model.defer="nom" disabled />
            <x-input-error for="nom" class="mt-2" />
        </div>

        <!-- Activité principale -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="activite_principale" value="{{ __('Activité principale') }}" />
            <x-input id="activite_principale" type="text" class="block w-full mt-1"
                wire:model.defer="activite_principale" />
            <x-input-error for="activite_principale" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="block w-full mt-1" wire:model.defer="email" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Numéro de téléphone') }}" />
            <x-input id="phone" type="text" class="block w-full mt-1" wire:model.defer="phone" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Date de création -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="date_creation" value="{{ __('Date de création') }}" />
            <x-input id="date_creation" type="text" class="block w-full mt-1" wire:model.defer="date_creation"
                disabled />
            <x-input-error for="date_creation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </x-slot>

</x-form-section>
