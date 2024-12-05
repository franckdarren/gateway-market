<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Détails de l'offre") }}
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
        @if (session('error'))
            <div class="flex items-center justify-between p-4 mx-auto mb-4 space-x-4 text-white bg-red-500 rounded-md shadow-md md:fixed md:top-5 md:right-5"
                x-data="{ open: true }" x-show="open" x-transition>
                <span>{{ session('error') }}</span>
                <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow-lg sm:p-8">
                <div class="w-full p-4 text-white bg-blue-500 rounded-lg shadow-lg sm:p-6">
                    <h2 class="mb-4 text-3xl font-bold text-center">Détails du projet</h2>
                    <div class="space-y-4">
                        <div class="flex gap-5 p-4 text-blue-900 bg-blue-100 rounded-md">
                            <h3 class="text-sm font-bold">Nom du projet :</h3>
                            <p class="text-sm ">{{ $offre->nom_projet }}</p>
                        </div>
                        <div class="p-4 text-blue-900 bg-blue-100 rounded-md">
                            <h3 class="text-sm font-bold">Description :</h3>
                            <p class="text-sm">{{ $offre->description_projet }}</p>
                        </div>
                        <div class="p-4 text-black bg-white rounded-md">
                            <h3 class="text-sm font-semibold">Montant :</h3>
                            <p class="text-sm font-bold">{{ number_format($offre->montant, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="mb-4 text-lg font-bold text-gray-800">Détails financiers :</h3>
                    <div class="space-y-6 overflow-x-auto">

                        <div class="hidden lg:flex">
                            <table class="w-full text-left border border-collapse border-gray-300 table-auto">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                            Mois de remboursement</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                            Mois de grâce</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                            Taux d'intérêt</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                            VAN</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                            IR</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                            TRI</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                            KRL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                            {{ $offre->nbre_mois_remboursement }} mois</td>
                                        <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                            {{ $offre->nbre_mois_grace }} mois</td>
                                        <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                            {{ $offre->taux_interet }}%</td>
                                        <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                            {{ number_format($offre->van, 2, ',', ' ') }} FCFA</td>
                                        <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">
                                            {{ $offre->ir }}</td>
                                        <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">
                                            {{ $offre->tri }}</td>
                                        <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">
                                            {{ $offre->krl }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table
                            class="block w-full text-left border border-collapse border-gray-300 table-auto lg:hidden">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                        Mois de remboursement</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                        Mois de grâce</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                        Taux d'intérêt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                        {{ $offre->nbre_mois_remboursement }} mois</td>
                                    <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                        {{ $offre->nbre_mois_grace }} mois</td>
                                    <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                        {{ $offre->taux_interet }}%</td>
                                </tr>
                            </tbody>
                        </table>
                        <table
                            class="block w-full text-left border border-collapse border-gray-300 table-auto lg:hidden">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                        VAN</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                        IR</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                        TRI</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-gray-700 border border-gray-300 sm:px-4">
                                        KRL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="px-2 py-2 text-sm font-bold border border-gray-300 sm:px-4">
                                        {{ number_format($offre->van, 2, ',', ' ') }} FCFA</td>
                                    <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">{{ $offre->ir }}
                                    </td>
                                    <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">{{ $offre->tri }}
                                    </td>
                                    <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">{{ $offre->krl }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">Documents :</h3>
                    <div class="flex flex-col flex-wrap gap-4 sm:flex-row">
                        @if ($offre->url_business_plan)
                            <a href="{{ Storage::url($offre->url_business_plan) }}" target="_blank"
                                class="flex items-center justify-center gap-5 px-4 py-2 text-center text-white bg-green-500 rounded-md shadow hover:bg-green-600">
                                Voir le Business Plan
                            </a>
                        @else
                            <span class="text-center text-gray-500">Business Plan non disponible </span>
                        @endif

                        @if ($offre->url_etude_risque)
                            <a href="{{ Storage::url($offre->url_etude_risque) }}" target="_blank"
                                class="flex items-center justify-center gap-5 px-4 py-2 text-center text-white bg-green-500 rounded-md shadow hover:bg-green-600">
                                Voir l'étude de risque
                            </a>
                        @else
                            <span class="text-center text-gray-500">Étude de risque non disponible</span>
                        @endif
                    </div>
                </div>
                <div class="mt-6">
                    @role('Investisseur')

                        @php
                            $compteInvestisseurId = auth()->user()->compteInvestisseur->id ?? null;
                        @endphp

                        @if ($offre->compte_investisseur_id !== $compteInvestisseurId)
                            <div x-data="{ showModal: false }">
                                <!-- Bouton d'ouverture de la modale -->
                                <a href="javascript:void(0)" @click="showModal = true"
                                    class="px-4 py-4 bg-[#18181b] text-white rounded-md hover:bg-blue-700 text-center">
                                    Investir
                                </a>

                                <!-- Modale -->
                                <div x-show="showModal" x-cloak
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                    <div class="p-6 mx-3 bg-white rounded-lg shadow-lg lg:w-1/3 ">
                                        <h2 class="mb-4 text-3xl text-center font-2bold">Confirmation</h2>
                                        <p class="mb-4">Êtes-vous sûr de vouloir investir sur ce projet ?</p>

                                        <!-- Récapitulatif -->
                                        <ul class="mb-4">
                                            <li><strong>Offre :</strong> {{ $offre->nom_projet }}</li>
                                            <li><strong>Montant à investir :</strong>
                                                {{ number_format($offre->montant, 0, '.', ' ') }} FCFA</li>
                                            <li><strong>Frais de transaction :</strong>
                                                {{ number_format(($offre->montant * 2) / 100, 0, '.', ' ') }} FCFA</li>

                                        </ul>

                                        <!-- Boutons -->
                                        <div class="flex justify-end space-x-4">
                                            <!-- Bouton pour fermer -->
                                            <button @click="showModal = false"
                                                class="px-4 py-2 text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                                Annuler
                                            </button>
                                            <!-- Bouton de confirmation -->
                                            <a href="{{ route('offre.investir', $offre->id) }}"
                                                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                                                Confirmer
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endrole
                    @role('Startup')
                        <div class="flex gap-10 mt-6">
                            <div x-data="{ showDeleteModal: false }">
                                <!-- Bouton pour ouvrir la modale de suppression -->
                                <button @click="showDeleteModal = true"
                                    class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                    Supprimer
                                </button>

                                <!-- Modale -->
                                <div x-show="showDeleteModal" x-cloak
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                    <div class="p-6 mx-3 bg-white rounded-lg shadow-lg lg:w-1/3">
                                        <h2 class="mb-4 text-3xl font-bold text-center text-red-600">Confirmation de
                                            suppression</h2>
                                        <p class="mb-4 text-gray-700">Êtes-vous sûr de vouloir supprimer cette offre ?
                                            Cette action est irréversible.</p>

                                        <!-- Récapitulatif -->
                                        <ul class="mb-4 text-gray-600">
                                            <li><strong>Offre :</strong> {{ $offre->nom_projet }}</li>
                                            <li><strong>Montant :</strong>
                                                {{ number_format($offre->montant, 0, '.', ' ') }} FCFA</li>
                                        </ul>

                                        <!-- Boutons -->
                                        <div class="flex justify-end space-x-4">
                                            <!-- Bouton pour fermer la modale -->
                                            <button @click="showDeleteModal = false"
                                                class="px-4 py-2 text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                                Annuler
                                            </button>
                                            <!-- Bouton pour confirmer la suppression -->
                                            <form action="{{ route('offre.destroy', $offre->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                                                    Confirmer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endrole
                </div>

            </div>

        </div>

    </div>

    <h1 class="my-6 text-xl font-bold text-center text-gray-800">Simulateur de prévision de remboursement
    </h1>
    @livewire('prevision', [
        'montantEmprunte' => $offre->montant,
        'duree' => $offre->nbre_mois_remboursement,
        'tauxInteret' => $offre->taux_interet,
        'delaiGrace' => $offre->nbre_mois_grace,
    ])
    </div>
</x-app-layout>
