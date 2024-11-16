<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une offres') }}
        </h2>
    </x-slot>

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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class="container mx-auto mt-10">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4">Détails de l'offre</h2>

                        <table class="table-auto w-full border border-gray-300 mb-5">
                            <tbody>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 w-1/3 bg-gray-100">Nom du projet :</th>
                                    <td class="px-4 py-2">{{ $offre->nom_projet }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Description :</th>
                                    <td class="px-4 py-2">{{ $offre->description_projet }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Montant :</th>
                                    <td class="px-4 py-2">{{ number_format($offre->montant, 0, ',', ' ') }} FCFA</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Montant à rembourser:</th>
                                    <td class="px-4 py-2">{{ number_format($offre->montant_dette, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Nombre de mois de grâce :</th>
                                    <td class="px-4 py-2">{{ $offre->nbre_mois_grace }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Taux d'intérêt :</th>
                                    <td class="px-4 py-2">{{ $offre->taux_interet }}%</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Valeur Actuelle Nette (VAN) :</th>
                                    <td class="px-4 py-2">{{ number_format($offre->van, 2, ',', ' ') }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Indice de Rentabilité (IR) :</th>
                                    <td class="px-4 py-2">{{ $offre->ir }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Taux de Rendement Interne (TRI) :</th>
                                    <td class="px-4 py-2">{{ $offre->tri }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">KRL :</th>
                                    <td class="px-4 py-2">{{ $offre->krl }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Business Plan :</th>
                                    <td class="px-4 py-2">
                                        @if ($offre->url_business_plan)
                                            <a href="{{ Storage::url($offre->url_business_plan) }}" target="_blank"
                                                class="text-blue-600 hover:underline">Télécharger</a>
                                        @else
                                            Non disponible
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th class="text-left px-4 py-2 bg-gray-100">Étude de risque :</th>
                                    <td class="px-4 py-2">
                                        @if ($offre->url_etude_risque)
                                            <a href="{{ Storage::url($offre->url_etude_risque) }}" target="_blank"
                                                class="text-blue-600 hover:underline">Télécharger</a>
                                        @else
                                            Non disponible
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 bg-gray-100">Créé le :</th>
                                    <td class="px-4 py-2">{{ $offre->created_at->format('d/m/Y à H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        @role('Startup')
                            <div class="mt-6 flex">
                                <a href="{{ route('offre.edit', $offre->id) }}"
                                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Éditer</a>
                                <form action="{{ route('offre.destroy', $offre->id) }}" method="POST" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endrole

                        @role('Investisseur')
                            <div class="mb-10">
                                <h1 class="text-xl font-bold text-gray-800 my-6 text-center">Simulateur de prévision de
                                    remboursement
                                </h1>
                                @livewire('prevision', [
                                    'montantEmprunte' => $offre->montant,
                                    'duree' => $offre->nbre_mois_remboursement,
                                    'tauxInteret' => $offre->taux_interet,
                                    'delaiGrace' => $offre->nbre_mois_grace,
                                ])
                            </div>
                        @endrole

                        @role('Investisseur')
                            <a href="{{ route('offre.investir', $offre->id) }}"
                                class="px-4 py-4 bg-green-500 text-white rounded-md hover:bg-green-600">
                                Investir
                            </a>
                        @endrole

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
