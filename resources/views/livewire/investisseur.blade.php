<div wire:poll.1m>
    @if ($hasCompteInvestisseur)
        <div class="container flex flex-col-reverse xl:flex-row mx-auto">
            <div class="space-y-5 w-full px-2">
                @forelse ($mesOffresSimples as $offre)
                    <div class="flex space-y-3 flex-col lg:flex-row justify-between p-2 bg-white rounded-lg">
                        <div class="flex justify-between lg:justify-center items-start md:items-center space-x-3">
                            <img class="rounded-full hidden lg:flex bg-cover bg-center h-[50px] w-auto"
                                src={{ $offre->compteStartup->url_logo }} alt="">
                            <div class="flex space-x-3">
                                <div>
                                    <h2 class="flex text-[#0D062D] font-semibold text-[18px] mb-2 md:mb-0">
                                        <span class="font-regular"></span>
                                        {{ $offre->compteStartup->nom }}
                                    </h2>
                                    <p class="flex md:hidden">{{ $offre->nom_projet }}</p>
                                    <p class="hidden md:flex text-[#787486]  text-[14px] mb-2 md:mb-0 ">
                                        <span class="font-regular"></span>
                                        {{ \Illuminate\Support\Str::limit($offre->nom_projet, 20, '...') }}
                                    </p>
                                </div>
                            </div>
                            <div class="items-center flex lg:hidden space-x-5 ">
                                <div class=" text-base  font-semibold ">
                                    <x-heroicon-s-star class="w-6 h-6" />
                                </div>
                                <a href="{{ route('offre.show', $offre->id) }}"
                                    class="flex md:justify-center text-[18px] md:text-center text-black">
                                    <i class="fa-solid fa-ellipsis"></i> </a>
                            </div>
                        </div>
                        <!-- Section: Bouton Voir Détails -->
                        <div class="flex justify-start items-end lg:justify-between lg:space-y-4 flex-col">
                            <div class="items-center hidden lg:flex space-x-5 ">
                                <div class=" text-base  font-semibold ">
                                    <x-heroicon-s-star class="w-6 h-6" />
                                </div>
                                <a href="{{ route('offre.show', $offre->id) }}"
                                    class="flex md:justify-center text-[18px] md:text-center text-black">
                                    <i class="fa-solid fa-ellipsis"></i> </a>
                            </div>
                            <div
                                class="flex items-center w-full md:justify-end justify-between bg-white rounded-lg px-2 xl:p-4 gap-2 md:gap-4">
                                <!-- Section: Montant -->
                                <div class="flex items-center space-x-2">
                                    <i class="text-[#808080] fa-solid fa-money-bill-1-wave"></i>
                                    <p class="text-[12px] font-medium text-[#8D6CFF]">
                                        {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                    </p>
                                </div>

                                <!-- Section: Durée -->
                                <div class="flex items-center space-x-2 md:mx-2">
                                    <i class="text-[#808080] fa-regular fa-calendar"></i>
                                    <p class="text-[12px] font-medium text-black">{{ $offre->nbre_mois_remboursement }}
                                        mois</p>
                                </div>

                                <!-- Section: Taux d'intérêt -->
                                <div class="flex items-center space-x-2 ">
                                    <i class="text-[#808080] fa-solid fa-chart-line"></i>
                                    <p class="text-[12px] font-medium text-green-600 ">{{ $offre->taux_interet }}%</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="text-center text-gray-600 py-4">
                        Aucune offre disponible pour le moment.
                    </div>
                @endforelse
            </div>

            @if (auth()->user()->hasRole('Investisseur'))
                <div class="w-full xl:max-w-[400px]">
                    <div class=" flex flex-col  bg-[#F5F5F5] rounded-t-2xl container mx-auto">
                        <header class="">
                            <div class="flex border-b-4 border-[#8BC48A] pb-5 items-center space-x-5 mx-5">
                                <i class="fa-solid fa-circle text-[#8BC48A] text-[8px]"></i>
                                <h2 class="text-[16px] font-medium text-[#0D062D]">
                                    Startup(s) Premium(s)
                                </h2>
                            </div>
                        </header>

                        <div class="py-5 sm:p-5 border-b-4 xl:border-none mx-5 mb-10 xl:mb-0 xl:mx-0 border-[#8BC48A]">
                            <div class="flex xl:overflow-y-auto overflow-x-auto max-w-screen-md xl:max-h-screen  space-x-3 space-y-3 xl:flex-col justify-between p-2 bg-white rounded-lg">

                                {{-- Liste des Offres premiums --}}
                                @foreach ($mesOffresPremiums as $offrePremium)
                                    <div
                                        class="flex min-w-[300px] py-4 justify-start items-center lg:justify-between lg:space-y-4 flex-col shadow-lg ">
                                        <div class="w-full items-center p-2 flex justify-between space-x-5">

                                            <div class=" space-x-2 flex text-base  font-semibold items-center ">
                                                <img class="rounded-full bg-cover bg-center h-[50px] w-auto"
                                                    src={{ $offrePremium->compteStartup->url_logo }} alt="">
                                                    <div class="flex flex-col"><h2
                                                    class="flex text-[#0D062D] font-semibold text-[18px] mb-2 rounded-md">
                                                    <span class="font-regular"></span>
                                                    {{ $offrePremium->compteStartup->nom }}
                                                </h2><p>{{ $offrePremium->nom_projet }}</p></div>

                                            </div>

                                            <a href="#"
                                                class="flex md:justify-start text-[18px] md:text-center text-black">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                        </div>


                                        <div class="p-2 flex flex-col w-full">
                                            <img class="rounded-md h-[100px] w-full object-cover"
                                            src={{ $offrePremium->url_image }} alt="">
                                            <p class=" text-[#787486]  text-[14px] mb-4">
                                                <span class="font-regular"></span>
                                                {{ $offrePremium->description_projet }}
                                            </p>
                                            <div
                                                class="flex flex-col lg:flex-row items-start w-full md:items-center lg:justify-between bg-white rounded-lg gap-2 md:gap-4">

                                                <!-- Section: Montant -->
                                                <div class="flex items-center space-x-2">
                                                    <i class="text-[#808080] fa-solid fa-money-bill-1-wave"></i>
                                                    <p class="text-[12px] font-medium text-[#8D6CFF]">
                                                        {{ number_format($offrePremium->montant, 0, '.', ' ') }} FCFA
                                                    </p>
                                                </div>

                                                <!-- Section: Durée -->
                                                <div class="flex items-center space-x-2">
                                                    <i class="text-[#808080] fa-regular fa-calendar"></i>
                                                    <p class="text-[12px] font-medium text-black">
                                                        {{ $offrePremium->nbre_mois_remboursement }} mois</p>
                                                </div>

                                                <!-- Section: Taux d'intérêt -->
                                                <div class="flex items-center space-x-2 ">
                                                    <i class="text-[#808080] fa-solid fa-chart-line"></i>
                                                    <p class="text-[12px] font-medium text-green-600 ">
                                                        {{ $offrePremium->taux_interet }} %</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
        <!-- Pagination -->
        <div class="my-6">
            {{ $mesOffresSimples->links() }}
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
