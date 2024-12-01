<div wire:poll.1m>
    @if ($hasCompteInvestisseur)
        <div class="container mx-auto p-4">
            
            <div class="space-y-4">
                @forelse ($mesOffres as $offre)
                <div class="flex flex-col lg:flex-row items-center justify-between bg-[#C1D1FF] border border-blue-200 rounded-lg shadow-md p-4 gap-x-10">
                    <!-- Section nom du Projet et son proprio -->
                    <div class="flex flex-col lg:flex-row lg:items-center flex-1 text-gray-800">
                        <h2 class="font-semibold text-lg mb-2 lg:mb-0 lg:mr-6 bg-[#FDF1F0] p-4 rounded-md">
                            <span class="font-regular">Par :</span> {{ $offre->nom_projet }}
                        </h2>
                    </div>
                
                    <!-- Section Taux d'intérêt -->
                    <div class="flex flex-col items-center lg:items-start mb-4 lg:mb-0 lg:mr-8">
                        <p class="text-2xl font-bold text-black">{{ $offre->taux_interet }}%</p>
                        <p class="text-sm text-gray-600">Taux d'intérêt</p>
                    </div>
                
                    <!-- Section Durée -->
                    <div class="flex flex-col items-center lg:items-start mb-4 lg:mb-0 lg:mr-8">
                        <p class="text-2xl font-bold text-black">{{ $offre->nbre_mois_remboursement }}</p>
                        <p class="text-sm text-gray-600">Mois de remboursement</p>
                    </div>
                
                    <!-- Section Montant -->
                    <div class="flex flex-col items-center lg:items-start mb-4 lg:mb-0">
                        <p class="text-2xl font-bold text-black">
                            {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                        </p>
                        <p class="text-sm text-gray-600">Montant du projet</p>
                    </div>
                
                    <!-- Bouton pour voir les détails du projet -->
                    <div class="mt-4 lg:mt-0">
                        <a href="{{ route('offre.show', $offre->id) }}"
                            class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition">
                            Voir détails
                        </a>
                    </div>
                </div>
                
                @empty
                    <div class="text-center text-gray-600 py-4">
                        Aucune offre disponible pour le moment.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="my-6">
                {{ $mesOffres->links() }}
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center h-full py-10 bg-gray-100">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Aucun compte Investisseur trouvé</h1>
            <p class="text-gray-600 text-center mb-6">
                Vous n'avez pas encore de compte Investisseur. Créez-en un pour commencer.
            </p>
            <a href="{{ route('compte_investisseur.create') }}"
                class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition">
                Créer un compte Investisseur
            </a>
        </div>
    @endif
</div>