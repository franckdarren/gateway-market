<div>
    @if ($hasCompteInvestisseur)
        <div class="container flex flex-col-reverse xl:flex-row mx-auto">
            <div class="space-y-5 w-full px-2">
                @forelse ($mesOffresSimples as $offre)
                    <div
                        class="flex space-y-3 flex-col lg:flex-row justify-between py-2 px-4 bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 ease-in-out">
                        <div class="flex justify-between lg:justify-center items-start lg:items-center space-x-3">
                            <div class="flex space-x-3"><img
                                    class="rounded-full bg-cover bg-center h-[50px] w-auto transition-transform duration-300 ease-in-out transform hover:scale-105"
                                    src="{{ $offre->compteStartup->url_logo }}" alt="">
                                <div class="flex space-x-3">
                                    <div>
                                        <h2
                                            class="flex text-[#0D062D] font-semibold text-[18px] mb-2 md:mb-0 transition-colors duration-300 ease-in-out hover:text-[#8D6CFF]">
                                            <span class="font-regular"></span>
                                            {{ $offre->compteStartup->nom }}
                                        </h2>
                                        <p class="flex md:hidden">{{ $offre->nom_projet }}</p>
                                        <p class="hidden md:flex text-[#787486] text-[14px] mb-2 md:mb-0">
                                            <span class="font-regular"></span>
                                            {{ \Illuminate\Support\Str::limit($offre->nom_projet, 20, '...') }}
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
                                    <livewire:favorite-toggle :offre="$offre" :key="$offre->id" />
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
                                <div class="flex items-center space-x-2">
                                    <i class="text-[#808080] fa-solid fa-chart-line"></i>
                                    <p class="text-[12px] font-medium text-green-600">{{ $offre->taux_interet }}%</p>
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
                    <div class=" flex flex-col mb-10   bg-[#F5F5F5] rounded-2xl container mx-auto">
                        <header class="">
                            <div class="flex border-b-4 border-[#8BC48A] py-5 items-center space-x-5 mx-5">
                                <i class="fa-solid fa-circle text-[#8BC48A] text-[8px]"></i>
                                <h2 class="text-[21px] font-medium text-[#0D062D]">
                                    Startup(s) Premium(s)
                                </h2>
                            </div>
                        </header>

                        <div class="py-5 sm:p-5 mx-5 mb-5 xl:mb-0 xl:mx-0 ">

                            <div
                                class="flex xl:overflow-y-auto overflow-x-auto max-w-screen-md xl:max-h-screen h-full  space-x-3 xl:space-x-0 space-y-3 xl:flex-col xl:justify-between p-2 bg-white rounded-lg">


                                {{-- Liste des Offres premiums --}}
                                @foreach ($mesOffresPremiums as $offrePremium)
                                    <div
                                        class="flex min-w-[300px] py-2 justify-start items-center lg:justify-between lg:space-y-4 flex-col shadow-lg ">

                                        <div class="w-full items-center px-2 flex justify-between space-x-5 ">


                                            <div class=" space-x-2 flex text-base  font-semibold items-center ">
                                                <img class="rounded-full bg-cover bg-center h-[50px] w-auto"
                                                    src={{ $offrePremium->compteStartup->url_logo }} alt="">

                                                <div>
                                                    <h2
                                                        class="flex text-[#0D062D] font-semibold text-[18px] rounded-md">
                                                        <span class="font-regular"></span>
                                                        {{ $offrePremium->compteStartup->nom }}
                                                    </h2>
                                                    <p class="text-[#787486]  text-[14px]">
                                                        {{ $offrePremium->nom_projet }}</p>
                                                </div>


                                            </div>

                                            <a href="{{ route('offre.show', $offrePremium->id) }}"
                                                class="flex md:justify-start text-[18px] md:text-center text-black">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                        </div>

                                        <div class="p-2 h-full flex justify-between flex-col w-full">

                                            <div class="relative overflow-hidden rounded-md h-[100px] w-full">
                                                <img class="transition-transform duration-300 ease-in-out transform hover:scale-125 object-cover h-full w-full"
                                                    src="{{ $offrePremium->url_image }}" alt="">
                                            </div>

                                            <p class=" text-[#787486]  text-[14px] my-4">
                                                <span class="font-regular"></span>
                                                {{ $offrePremium->description_projet }}
                                            </p>
                                            <div
                                                class="flex flex-col lg:flex-row items-start w-full xl:items-center lg:justify-between bg-white rounded-lg gap-2 md:gap-4">

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
