<div class="space-y-5 w-full px-2">
    @forelse ($favorites as $offre)
        <div
            class="flex space-y-3 flex-col lg:flex-row justify-between py-2 px-4 bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 ease-in-out">
            <div class="flex justify-between lg:justify-center items-start lg:items-center space-x-3">
                <div class="flex space-x-3 items-center">
                    <img
                        class="rounded-full bg-cover bg-center h-[50px] w-auto transition-transform duration-300 ease-in-out transform hover:scale-105"
                        src={{ $offre->compteStartup->url_logo }} alt="">
                    <div class="flex space-x-3">
                        <div>
                            <h2
                                class="flex text-[#0D062D] font-semibold text-[18px] mb-2 md:mb-0 transition-colors duration-300 ease-in-out hover:text-[#8D6CFF]">
                                <span class="font-regular"></span>
                                {{ $offre->compteStartup->nom }}
                            </h2>
                            <p class="flex"> {{ $offre->nom_projet }} </p>
                            <p class="hidden md:flex text-[#787486] text-[14px] mb-2 md:mb-0">
                                <span class="font-regular"></span>
                                {{ \Illuminate\Support\Str::limit($offre->description_projet, 50, '...') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="items-center flex lg:hidden space-x-5">
                    <div class="text-base font-semibold">
                        <livewire:favorite-toggle :offre="$offre" :key="$offre->id" />
                    </div>
                    <a href="{{ route('offre.show', $offre->id) }}"
                        class="flex md:justify-center text-[18px] md:text-center text-black hover:text-[#8D6CFF] transition-colors duration-300">
                        <i class="fa-solid fa-ellipsis"></i>
                    </a>
                </div>
            </div>

            <!-- Section: Bouton Voir Détails -->
            <div class="flex justify-start items-end lg:justify-between lg:space-y-4 flex-col">
                <div class="items-center hidden lg:flex space-x-5">
                    <div class="text-base font-semibold">
                        <livewire:favorite-toggle :offre="$offre" :key="$offre->id"/>
                    </div>
                    <a href="{{ route('offre.show', $offre->id) }}"
                        class="flex md:justify-center text-[18px] md:text-center text-black hover:text-[#8D6CFF] transition-colors duration-300">
                        <i class="fa-solid fa-ellipsis"></i>
                    </a>
                </div>

                <div class="flex items-center w-full md:justify-end justify-between xl:py-4 gap-2 md:gap-4">

                    <!-- Section: Montant -->
                    <div class="flex items-center space-x-2">
                        <i class="text-[#808080] fa-solid fa-money-bill-1-wave"></i>
                        <p class="text-[12px] font-medium text-[#8D6CFF]">
                            {{ number_format($offre->montant, 0, '.', ' ') }}  FCFA
                        </p>
                    </div>

                    <!-- Section: Durée -->
                    <div class="flex items-center space-x-2 md:mx-2">
                        <i class="text-[#808080] fa-regular fa-calendar"></i>
                        <p class="text-[12px] font-medium text-black">{{ $offre->nbre_mois_remboursement }}
                            mois</p>
                    </div>

                    <!-- Section: Taux d'intérêt -->
                    <div class="flex items-center space-x-2">
                        <i class="text-[#808080] fa-solid fa-chart-line"></i>
                        <p class="text-[12px] font-medium text-green-600"> {{ $offre->taux_interet }}%</p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="py-4 text-center text-gray-600">Aucun favoris disponible</p>
    @endforelse


</div>
