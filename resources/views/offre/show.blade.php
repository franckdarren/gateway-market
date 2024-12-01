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

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
            <div class="bg-[#CFDFEA] shadow-lg rounded-lg p-6 sm:p-8  ">
                <div class="rounded-lg w-full  p-4 sm:p-6  shadow-lg">
                    <h2 class="text-2xl font-bold mb-4 text-center">Détails du projet</h2>
                    <div class="space-y-4 bg-[#CFDFEA] ">
                        <div class="p-4 rounded-md flex justify-content-around gap-5">
                            <h3 class="font-semibold text-sm mb-1">Nom du projet :</h3>
                            <p class="text-sm font-bold">{{ $offre->nom_projet }}</p>
                        </div>
                        <div class="p-4 rounded-md">
                            <h3 class="font-semibold text-sm mb-1">Description :</h3>
                            <p class="text-sm">{{ $offre->description_projet }}</p>
                        </div>
                        <div class="p-4 rounded-md">
                            <h3 class="font-semibold text-sm mb-1">Montant :</h3>
                            <p class="text-sm font-bold">{{ number_format($offre->montant, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
        
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Détails financiers :</h3>
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full border-collapse border border-gray-200 text-left">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-600">Mois de remboursement</th>
                                        <th class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-600">Mois de grâce</th>
                                        <th class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-600">Taux d'intérêt</th>
                                        <th class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-600">VAN</th>
                                        <th class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-600">IR</th>
                                        <th class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-600">TRI</th>
                                        <th class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-semibold text-gray-600">KRL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-bold">{{ $offre->nbre_mois_remboursement }} mois</td>
                                        <td class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-bold">{{ $offre->nbre_mois_grace }} mois</td>
                                        <td class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-bold">{{ $offre->taux_interet }}%</td>
                                        <td class="border border-gray-200 px-2 py-2 sm:px-4 text-sm font-bold">{{ number_format($offre->van, 2, ',', ' ') }} FCFA</td>
                                        <td class="border border-gray-200 px-2 py-2 sm:px-4 text-sm">{{ $offre->ir }}</td>
                                        <td class="border border-gray-200 px-2 py-2 sm:px-4 text-sm">{{ $offre->tri }}</td>
                                        <td class="border border-gray-200 px-2 py-2 sm:px-4 text-sm">{{ $offre->krl }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                   
                </div>
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Documents :</h3>
                    <div class="flex flex-col sm:flex-row flex-wrap gap-4">
                        @if ($offre->url_business_plan)
                            <a href="{{ Storage::url($offre->url_business_plan) }}" target="_blank"
                                class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 text-center gap-5">Voir le Business Plan
                                <svg class="w-6 h-6 stroke-gray-200" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.668 4.16683H18.7513C19.3038 4.16683 19.8337 4.38632 20.2244 4.77702C20.6151 5.16772 20.8346 5.69763 20.8346 6.25016V20.8335C20.8346 21.386 20.6151 21.9159 20.2244 22.3066C19.8337 22.6973 19.3038 22.9168 18.7513 22.9168H6.2513C5.69877 22.9168 5.16886 22.6973 4.77816 22.3066C4.38746 21.9159 4.16797 21.386 4.16797 20.8335V6.25016C4.16797 5.69763 4.38746 5.16772 4.77816 4.77702C5.16886 4.38632 5.69877 4.16683 6.2513 4.16683H8.33464M9.3763 2.0835H15.6263C16.2016 2.0835 16.668 2.54987 16.668 3.12516V5.2085C16.668 5.78379 16.2016 6.25016 15.6263 6.25016H9.3763C8.80101 6.25016 8.33464 5.78379 8.33464 5.2085V3.12516C8.33464 2.54987 8.80101 2.0835 9.3763 2.0835Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                  

                                  
                            </a>
                        @else
                            <span class="text-gray-500 text-center">Business Plan non disponible </span>
                        @endif
    
                        @if ($offre->url_etude_risque)
                            <a href="{{ Storage::url($offre->url_etude_risque) }}" target="_blank"
                                class=" flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 text-center gap-5">Voir l'étude de risque
                                <svg class="w-5 h-5 stroke-white" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.03906 12.3178L8.53334 9.07598L11.3785 11.3109L13.8194 8.16064" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="16.6643" cy="3.50027" r="1.60183" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.4385 2.6001H6.38201C3.87247 2.6001 2.31641 4.37737 2.31641 6.8869V13.6222C2.31641 16.1318 3.84196 17.9014 6.38201 17.9014H13.5521C16.0616 17.9014 17.6177 16.1318 17.6177 13.6222V7.75647" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                  
                            </a>
                        @else
                            <span class="text-gray-500 text-center">Étude de risque non disponible</span>
                        @endif

                     @role('Investisseur')

                        @php
                            $compteInvestisseurId = auth()->user()->compteInvestisseur->id ?? null;
                        @endphp
        
                        @if ($offre->compte_investisseur_id !== $compteInvestisseurId)
                            <a href="{{ route('offre.investir', $offre->id) }}"
                                class="px-4 py-4 bg-green-500 text-white rounded-md hover:bg-green-600 text-center">
                                Investir
                            </a>
                        @endif
                    @endrole
                    </div>
                    @role('Startup')
                    <div class="mt-6 flex gap-10">
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

                </div>
            </div>
        </div>
        
                



            @role('Investisseur')
            <div class="mb-10 mt-4 p-6 bg-white rounded-lg shadow-lg max-w-6xl mx-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 my-6 text-center">
                    Simulateur de prévision de remboursement
                </h1>
                <div class="border-t-4 border-blue-500 rounded-lg p-4">
                    @livewire('prevision', [
                        'montantEmprunte' => $offre->montant,
                        'duree' => $offre->nbre_mois_remboursement,
                        'tauxInteret' => $offre->taux_interet,
                        'delaiGrace' => $offre->nbre_mois_grace,
                    ])
                </div>
            </div>
            
            @endrole



            </div>
        </div>
    </div>
</x-app-layout>