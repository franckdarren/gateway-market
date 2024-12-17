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
                <div class="text-black">
                    <h2 class="mb-4 text-3xl font-bold text-center">Détails du projet</h2>
                    <div class="space-y-4">
                        <div class="flex gap-5 p-4 text-black bg-[#cfdfea] rounded-md">
                            <h3 class="text-sm font-bold">Nom du projet :</h3>
                            <p class="text-sm ">{{ $offre->nom_projet }}</p>
                        </div>
                        <div class="p-4 text-black bg-[#cfdfea] rounded-md">
                            <h3 class="text-sm font-bold">Description :</h3>
                            <p class="text-sm text-black">{{ $offre->description_projet }}</p>
                        </div>
                        <div class="flex gap-5 p-4 text-black bg-[#cfdfea] rounded-md">
                            <h3 class="text-sm font-semibold">Montant :</h3>
                            <p class="text-sm font-bold">{{ number_format($offre->montant, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="flex gap-5 p-4 text-black bg-[#cfdfea] rounded-md">
                            <h3 class="text-sm font-semibold">Statut :</h3>
                            <p class="text-sm">{{ $offre->statut }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="mb-4 text-lg font-bold text-gray-800">Détails financiers :</h3>
                    <div class="space-y-6">

                        <div class="hidden lg:flex">
                            <table class="w-full text-left rounded-md table-auto">
                                <thead>
                                    <tr class="bg-gray-100 rounded-md">
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                            Mois de remboursement</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                            Mois de grâce</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                            Taux d'intérêt</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                            VAN</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                            IR</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                            TRI</th>
                                        <th
                                            class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                            KRL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">
                                            {{ $offre->nbre_mois_remboursement }} mois</td>
                                        <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">
                                            {{ $offre->nbre_mois_grace }} mois</td>
                                        <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">
                                            {{ $offre->taux_interet }}%</td>
                                        <td class="px-2 py-2 text-sm border border-gray-300 sm:px-4">
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
                        <table class="w-full text-left border border-collapse border-gray-300 table-auto  lg:hidden">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                        Mois de remboursement</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                        Mois de grâce</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
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
                        <table class="w-full text-left border border-collapse border-gray-300 table-auto  lg:hidden">
                            <thead class="w-full">
                                <tr class="bg-gray-200">
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                        VAN</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                        IR</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
                                        TRI</th>
                                    <th
                                        class="px-2 py-2 text-sm font-semibold text-black border border-gray-300 sm:px-4">
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
                                class="flex items-center justify-center gap-2 px-4 py-2 text-center text-white bg-green-500 rounded-md shadow hover:bg-green-600">
                                <svg width="20" height="20" viewBox="0 0 19 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.668 3.16683H15.7513C16.3038 3.16683 16.8337 3.38632 17.2244 3.77702C17.6151 4.16772 17.8346 4.69763 17.8346 5.25016V19.8335C17.8346 20.386 17.6151 20.9159 17.2244 21.3066C16.8337 21.6973 16.3038 21.9168 15.7513 21.9168H3.2513C2.69877 21.9168 2.16886 21.6973 1.77816 21.3066C1.38746 20.9159 1.16797 20.386 1.16797 19.8335V5.25016C1.16797 4.69763 1.38746 4.16772 1.77816 3.77702C2.16886 3.38632 2.69877 3.16683 3.2513 3.16683H5.33464M6.3763 1.0835H12.6263C13.2016 1.0835 13.668 1.54987 13.668 2.12516V4.2085C13.668 4.78379 13.2016 5.25016 12.6263 5.25016H6.3763C5.80101 5.25016 5.33464 4.78379 5.33464 4.2085V2.12516C5.33464 1.54987 5.80101 1.0835 6.3763 1.0835Z"
                                        stroke="#F5F5F5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>


                                Voir le Business Plan
                            </a>
                        @else
                            <span class="text-center text-gray-500">Business Plan non disponible </span>
                        @endif

                        @if ($offre->url_etude_risque)
                            <a href="{{ Storage::url($offre->url_etude_risque) }}" target="_blank"
                                class="flex items-center justify-center gap-2 px-4 py-2 text-center text-white bg-green-500 rounded-md shadow hover:bg-green-600">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.03906 12.3178L8.53334 9.07598L11.3785 11.3109L13.8194 8.16064"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <circle cx="16.6643" cy="3.50027" r="1.60183" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M12.4385 2.6001H6.38201C3.87247 2.6001 2.31641 4.37737 2.31641 6.8869V13.6222C2.31641 16.1318 3.84196 17.9014 6.38201 17.9014H13.5521C16.0616 17.9014 17.6177 16.1318 17.6177 13.6222V7.75647"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

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
                                    class="px-5 py-2.5 bg-[#0A52AB] hover:bg-[#478bc4] text-white rounded-md text-center">
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
                                        <p class="mb-4 text-black">Êtes-vous sûr de vouloir supprimer cette offre ?
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

    <div class="sm:px-6 lg:px-8">
        @livewire('prevision', [
            'montantEmprunte' => $offre->montant,
            'duree' => $offre->nbre_mois_remboursement,
            'tauxInteret' => $offre->taux_interet,
            'delaiGrace' => $offre->nbre_mois_grace,
        ])

    </div>
    </div>
</x-app-layout>
