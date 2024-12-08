<div wire:poll.1m>
    @if ($hasCompteInvestisseur)
        <div class="container mx-auto">

            <div class="space-y-2">
                @forelse ($mesOffres as $offre)
                    <div class="lg:flex lg:flex-col lg:items-center lg:justify-center bg-white lg:pb-4 rounded-lg">
                        <div
                            class="flex md:grid md:grid-cols-3 lg:grid-cols-4 xl:flex xl:flex-row items-center w-full md:items-center justify-between bg-white rounded-lg p-4 gap-2 md:gap-5">
                            <!-- Section: Nom du Projet et Propriétaire -->
                            <div class="flex flex-col justify-center lg:flex-row lg:items-center flex-1 text-gray-800">
                                <h2 class="font-semibold text-md md:text-lg mb-2 lg:mb-0 lg:mr-6 rounded-md">
                                    <span class="font-regular"></span> {{ $offre->nom_projet }}
                                </h2>
                                <!-- Section: Durée -->
                                <div class=" md:hidden flex justify-center items-center mt-4 space-x-2">
                                    <p class="text-md font-medium text-black">{{ $offre->nbre_mois_remboursement }}</p>
                                    <p class="text-sm text-black">Mois</p>
                                </div>
                            </div>


                            <!-- Section: Durée -->
                            <div class="hidden md:flex flex-col items-center lg:items-start mb-4 lg:mb-0 lg:mr-8">
                                <p class="text-lg font-medium text-black">{{ $offre->nbre_mois_remboursement }}</p>
                                <p class="text-sm  text-gray-600">Mois de remboursement</p>
                            </div>


                            <!-- Section: Taux d'intérêt -->
                            <div class="md:flex hidden flex-col items-center lg:items-start mb-4 lg:mb-0 xl:mr-8">
                                <p class="text-md md:text-lg font-medium text-green-600 ">{{ $offre->taux_interet }}%</p>
                                <p class="text-sm hidden md:flex text-gray-600">Taux d'intérêt</p>
                            </div>

                            <!-- Section: Montant -->
                            <div class="md:flex flex-col hidden items-center lg:items-start mb-4 lg:mb-0">
                                <p class="text-md md:text-lg font-medium text-black">
                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                </p>
                                <p class="text-sm hidden md:flex text-gray-600">Montant du projet</p>
                            </div>

                            <div class="flex md:hidden h-full flex-col-reverse mr-3 md:mr-0 items-end">
                                <!-- Section: Taux d'intérêt -->
                                <div class="flex flex-col items-center justify-center lg:items-start md:mb-4 lg:mb-0 lg:mr-8">
                                    <p class="text-md h-full  md:text-lg font-bold text-green-600 ">{{ $offre->taux_interet }}%
                                    </p>
                                    <p class="text-sm hidden md:flex text-gray-600">Taux d'intérêt</p>
                                </div>

                                <!-- Section: Montant -->
                                <div class="flex flex-col items-center lg:items-start mb-4 lg:mb-0">
                                    <p class="text-md md:text-lg font-medium text-black">
                                        {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                    </p>
                                    <p class="text-sm hidden md:flex text-gray-600">Montant du projet</p>
                                </div>
                            </div>






                            <!-- Section: Bouton Voir Détails -->
                            <div class="md:mt-4 lg:hidden xl:flex lg:mt-0">
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
                        <div class="md:mt-4 hidden xl:hidden lg:flex lg:mt-0">
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