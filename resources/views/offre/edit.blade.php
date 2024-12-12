<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Créer une offres') }}
        </h2>
    </x-slot> --}}

    <div class="py-2 lg:py-5">
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
        @if ($errors->any())
            <div class="p-4 mx-10 mb-4 text-white bg-red-500 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="">
                <div class="container flex mx-auto">
                    <div class="w-full p-6 bg-white rounded-lg shadow-md">
                        <h2 class="mb-4 text-3xl font-bold text-center text-black">Modifier l'offre</h2>
                        <livewire:edit-offre-form :offre="$offre" />
                    </div>
                </div>
            </div>
            {{-- @livewire('prevision', [
                'montantEmprunte' => $offre->montant,
                'duree' => $offre->nbre_mois_remboursement,
                'tauxInteret' => $offre->taux_interet,
                'delaiGrace' => $offre->nbre_mois_grace,
            ]) --}}
        </div>
    </div>
</x-app-layout>
