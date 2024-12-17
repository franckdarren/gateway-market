<div wire:poll.1m>
    @if ($hasCompteInvestisseur)
        <div class="container mx-auto">

            <div class="space-y-2">
                @forelse ($mesOffres as $offre)
                    <div class="lg:flex lg:flex-col lg:items-center lg:justify-center bg-white rounded-lg">
                        <div
                            class="flex md:grid md:grid-cols-3 lg:flex lg:flex-row items-center w-full md:items-center justify-between bg-white rounded-lg p-4 gap-2 md:gap-4">
                            <!-- Section: Nom du Projet et Propriétaire -->
                            <div class="flex flex-col lg:justify-start justify-center lg:flex-row lg:items-center flex-1 text-gray-800">
                                <h2 class="md:hidden flex font-semibold text-md md:text-lg mb-2 md:mb-0 xl:mr-6 rounded-md">
                                    <span class="font-regular"></span>
                                    {{ \Illuminate\Support\Str::limit($offre->nom_projet, 25, "...") }}
                                </h2>
                                <h2 class="hidden md:flex font-semibold text-md md:text-lg mb-2 md:mb-0 lg:mr-6 rounded-md">
                                    <span class="font-regular"></span>
                                    {{ $offre->nom_projet }}
                                </h2>

                                <!-- Section: Montant -->
                                <div class="flex flex-col md:hidden items-start lg:items-start lg:mb-0">
                                    <p class="text-md md:text-lg font-medium text-black">
                                        {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                    </p>
                                    <p class="text-sm hidden md:flex text-gray-600">Montant du projet</p>
                                </div>

                            </div>
                            <!-- Section: Montant -->
                            <div class="hidden md:flex flex-col items-start lg:items-start lg:mb-0">
                                <p class="text-md md:text-lg font-medium text-black">
                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                </p>
                                <p class="text-sm hidden md:flex text-gray-600">Montant du projet</p>
                            </div>


                            <!-- Section: Durée -->
                            <div class="hidden md:flex flex-col items-center lg:items-start mb-4 lg:mb-0 xl:mr-8">
                                <p class="text-lg font-medium text-black">{{ $offre->nbre_mois_remboursement }} mois</p>
                                <p class="text-sm  text-gray-600">Remboursement</p>
                            </div>


                            <!-- Section: Taux d'intérêt -->
                            <div class="md:flex hidden flex-col items-center lg:items-start mb-4 lg:mb-0 xl:mr-8">
                                <p class="text-md md:text-lg font-medium text-green-600 ">{{ $offre->taux_interet }}%</p>
                                <p class="text-sm hidden md:flex text-gray-600">Taux d'intérêt</p>
                            </div>




                            <div class="flex  md:hidden h-full flex-col-reverse mr-3 md:mr-0 items-end justify-center">
                                <!-- Section: Taux d'intérêt -->
                                <div class="flex flex-col items-center justify-center lg:items-start md:mb-4 lg:mb-0 lg:mr-8">
                                    <p class="text-md h-full  md:text-lg font-bold text-green-600 ">{{ $offre->taux_interet }}%
                                    </p>
                                    <p class="text-sm hidden md:flex text-gray-600">Taux d'intérêt</p>
                                </div>

                                <!-- Section: Durée -->
                                <div class=" md:hidden flex justify-center items-center space-x-2">
                                    <p class="text-md font-medium text-black">{{ $offre->nbre_mois_remboursement }}</p>
                                    <p class="text-sm text-black">Mois</p>
                                </div>

                                <!-- Section: Montant -->
                                <div class="hidden md:flex flex-col items-center lg:items-start lg:mb-0">
                                    <p class="text-md md:text-lg font-medium text-black">
                                        {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                    </p>
                                    <p class="text-sm hidden md:flex text-gray-600">Montant du projet</p>
                                </div>
                            </div>






                            <!-- Section: Bouton Voir Détails -->
                            <div class="md:mt-4 lg:mt-0">
                                <a href="{{ route('offre.show', $offre->id) }}"
                                    class="bg-blue-600 hidden md:flex md:justify-center text-[12px] md:text-center text-white py-1 px-2 rounded-lg shadow hover:bg-blue-700 transition">
                                    Voir détails
                                </a>

                                <a href="{{ route('offre.show', $offre->id) }}"
                                    class="bg-blue-600 flex md:hidden text-sm md:text-base text-white font-semibold p-2 rounded-lg shadow hover:bg-blue-700 transition">
                                    <x-heroicon-s-eye class="w-6 h-6" />
                                </a>
                            </div>
                        </div>
                        <div class="md:mt-4 hidden lg:mt-0">
                            <a href="{{ route('offre.show', $offre->id) }}"
                                class="bg-blue-600 hidden md:flex md:justify-center text-sm md:text-base md:text-center text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition">
                                Voir détails
                            </a>

                            <a href="{{ route('offre.show', $offre->id) }}"
                                class="bg-blue-600 flex md:hidden text-sm md:text-base text-white font-semibold p-2 rounded-lg shadow hover:bg-blue-700 transition">
                                <x-heroicon-s-eye class="w-6 h-6" />
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
        <div class="flex flex-col items-center justify-center h-full py-10 bg-white rounded-lg">
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