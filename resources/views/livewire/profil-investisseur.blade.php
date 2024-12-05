<x-form-section submit="updateCompteInformation">
    <x-slot name="title">
        {{ __('Compte Investisseur') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Détails du compte investisseur') }}
    </x-slot>

    <x-slot name="form">

        <!-- Nom -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nom" value="{{ __('Nom(s)') }}" />
            <x-input id="nom" type="text" class="block w-full mt-1" wire:model.defer="nom" disabled />
            <x-input-error for="nom" class="mt-2" />
        </div>

        <!-- Prenom -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="prenom" value="{{ __('Prénom(s)') }}" />
            <x-input id="prenom" type="text" class="block w-full mt-1" wire:model.defer="prenom" disabled />
            <x-input-error for="prenom" class="mt-2" />
        </div>

        <!-- Pays -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="pays" value="{{ __('Prénom(s)') }}" />
            <x-input id="pays" type="text" class="block w-full mt-1" wire:model.defer="pays" disabled />
            <x-input-error for="pays" class="mt-2" />
        </div>

        <!-- Province -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="etat_province" value="{{ __('Etat/Province') }}" />
            <x-input id="nom" type="text" class="block w-full mt-1" wire:model.defer="etat_province" disabled />
            <x-input-error for="etat_province" class="mt-2" />
        </div>

        <!-- Ville -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="ville" value="{{ __('Ville') }}" />
            <x-input id="ville" type="text" class="block w-full mt-1" wire:model.defer="ville" disabled />
            <x-input-error for="ville" class="mt-2" />
        </div>

        <!-- Code postal -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="code_postal" value="{{ __('Code postal') }}" />
            <x-input id="code_postal" type="text" class="block w-full mt-1" wire:model.defer="code_postal" disabled />
            <x-input-error for="code_postal" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Numéro de telephone') }}" />
            <x-input id="phone" type="text" class="block w-full mt-1" wire:model.defer="phone" disabled />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="block w-full mt-1" wire:model.defer="email" disabled />
            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Profession -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="profession" value="{{ __('Profession') }}" />
            <x-input id="profession" type="text" class="block w-full mt-1" wire:model.defer="profession" disabled />
            <x-input-error for="profession" class="mt-2" />
        </div>

    </x-slot>

</x-form-section>
