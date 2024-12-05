<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Détails de l'offre") }}
        </h2>
    </x-slot> --}}

    <div class="py-2 lg:py-5">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md shadow-md mb-4 mx-10">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-10" role="alert">
                <strong class="font-bold">Erreur : </strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove();">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.935 2.935a1 1 0 01-1.414-1.414l2.935-2.935L5.651 7.515a1 1 0 011.414-1.414L10 8.586l2.935-2.935a1 1 0 011.414 1.414L11.414 10l2.935 2.935a1 1 0 010 1.414z" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8">
                <div class="rounded-lg w-full p-4 sm:p-6 bg-blue-500 shadow-lg text-white">
                    <h2 class="text-3xl font-bold mb-4 text-center">Détails du projet</h2>
                    <div class="space-y-4">
                        <div class="p-4 rounded-md bg-blue-100 text-blue-900 flex  gap-5">
                            <h3 class="font-bold text-sm">Nom du projet :</h3>
                            <p class="text-sm ">{{ $offre->nom_projet }}</p>
                        </div>
                        <div class="p-4 rounded-md bg-blue-100 text-blue-900">
                            <h3 class="font-bold text-sm">Description :</h3>
                            <p class="text-sm">{{ $offre->description_projet }}</p>
                        </div>
                        <div class="p-4 rounded-md bg-white text-black">
                            <h3 class="font-semibold text-sm">Montant :</h3>
                            <p class="text-sm font-bold">{{ number_format($offre->montant, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Détails financiers :</h3>
                    <div class="overflow-x-auto space-y-6">

                        <div class="hidden lg:flex">
                            <table class="table-auto w-full border-collapse border border-gray-300 text-left">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th
                                            class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                            Mois de remboursement</th>
                                        <th
                                            class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                            Mois de grâce</th>
                                        <th
                                            class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                            Taux d'intérêt</th>
                                        <th
                                            class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                            VAN</th>
                                        <th
                                            class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                            IR</th>
                                        <th
                                            class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                            TRI</th>
                                        <th
                                            class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                            KRL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                            {{ $offre->nbre_mois_remboursement }} mois</td>
                                        <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                            {{ $offre->nbre_mois_grace }} mois</td>
                                        <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                            {{ $offre->taux_interet }}%</td>
                                        <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                            {{ number_format($offre->van, 2, ',', ' ') }} FCFA</td>
                                        <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm">
                                            {{ $offre->ir }}</td>
                                        <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm">
                                            {{ $offre->tri }}</td>
                                        <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm">
                                            {{ $offre->krl }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table
                            class="table-auto block lg:hidden w-full border-collapse border border-gray-300 text-left">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th
                                        class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                        Mois de remboursement</th>
                                    <th
                                        class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                        Mois de grâce</th>
                                    <th
                                        class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                        Taux d'intérêt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                        {{ $offre->nbre_mois_remboursement }} mois</td>
                                    <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                        {{ $offre->nbre_mois_grace }} mois</td>
                                    <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                        {{ $offre->taux_interet }}%</td>
                                </tr>
                            </tbody>
                        </table>
                        <table
                            class="table-auto block lg:hidden w-full border-collapse border border-gray-300 text-left">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th
                                        class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                        VAN</th>
                                    <th
                                        class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                        IR</th>
                                    <th
                                        class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                        TRI</th>
                                    <th
                                        class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-700">
                                        KRL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm font-bold">
                                        {{ number_format($offre->van, 2, ',', ' ') }} FCFA</td>
                                    <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm">{{ $offre->ir }}
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm">{{ $offre->tri }}
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2 sm:px-4 text-sm">{{ $offre->krl }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Documents :</h3>
                    <div class="flex flex-col sm:flex-row flex-wrap gap-4">
                        @if ($offre->url_business_plan)
                            <a href="{{ Storage::url($offre->url_business_plan) }}" target="_blank"
                                class="flex items-center justify-center px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600 text-center gap-5">
                                Voir le Business Plan
                            </a>
                        @else
                            <span class="text-gray-500 text-center">Business Plan non disponible </span>
                        @endif

                        @if ($offre->url_etude_risque)
                            <a href="{{ Storage::url($offre->url_etude_risque) }}" target="_blank"
                                class="flex items-center justify-center px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600 text-center gap-5">
                                Voir l'étude de risque
                            </a>
                        @else
                            <span class="text-gray-500 text-center">Étude de risque non disponible</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-xl font-bold text-gray-800 my-6 text-center">Simulateur de prévision de remboursement
        </h1>
        @livewire('prevision', [
            'montantEmprunte' => $offre->montant,
            'duree' => $offre->nbre_mois_remboursement,
            'tauxInteret' => $offre->taux_interet,
            'delaiGrace' => $offre->nbre_mois_grace,
        ])
    </div>
</x-app-layout>
