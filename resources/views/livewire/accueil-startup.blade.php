<div class="">
    @if ($hasCompteStartup)

        <div class="container flex flex-col-reverse xl:flex-row mx-auto  gap-10">


            <div class="w-full space-y-5 px-2 bg-[#F5F5F5] basis-[70%] rounded-t-2xl">
                <!-- partie A -->
                <div class="col-start-2 relative h-20">
                    <div class="flex justify-between px-2">
                        <div class="flex flex-row-reverse items-center gap-2 mr-1 px-2 py-2">
                            <h1>Offres</h1>
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="4" cy="4" r="4" fill="#5030E5" />
                            </svg>

                        </div>
                        <a href="{{ route('offre.create') }}"
                            class="inline-flex items-center justify-center px-2 py-2 mr-1 text-white font-semibold text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-200 ease-in-out float-right mb-2">
                            <span>
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.2"
                                        d="M33.7305 4.16602H16.2721C8.6888 4.16602 4.16797 8.68685 4.16797 16.2702V33.7077C4.16797 41.3119 8.6888 45.8327 16.2721 45.8327H33.7096C41.293 45.8327 45.8138 41.3119 45.8138 33.7285V16.2702C45.8346 8.68685 41.3138 4.16602 33.7305 4.16602Z"
                                        fill="#5030E5" />
                                    <path
                                        d="M33.3346 23.4368H26.5638V16.666C26.5638 15.8118 25.8555 15.1035 25.0013 15.1035C24.1471 15.1035 23.4388 15.8118 23.4388 16.666V23.4368H16.668C15.8138 23.4368 15.1055 24.1452 15.1055 24.9993C15.1055 25.8535 15.8138 26.5618 16.668 26.5618H23.4388V33.3327C23.4388 34.1868 24.1471 34.8952 25.0013 34.8952C25.8555 34.8952 26.5638 34.1868 26.5638 33.3327V26.5618H33.3346C34.1888 26.5618 34.8971 25.8535 34.8971 24.9993C34.8971 24.1452 34.1888 23.4368 33.3346 23.4368Z"
                                        fill="#5030E5" />
                                </svg>

                            </span>
                        </a>
                    </div>

                    <!--hr class="absolute bottom-0 left-0 w-full border-t-4 border-[#5030E5] "-->
                </div>

                <!-- partie B -->

                @forelse ($mesOffres as $offre)
                <div
                    class="space-x-5 flex justify-between px-2 mx-2 py-4 rounded-lg hover:bg-[#CFDFEA] bg-white mb-4  p-6 sm:gap-2">

                    <div class="flex flex-col justify-between sm:flex-row">
                        <!-- img offre -->
                        <img class="rounded-full flex lbg-cover bg-center h-[50px] w-auto" src="/asset/tune.jpg"
                            alt="">
                        <div class="flex flex-col">

                            <!-- nom et date de crea-->
                            <div class="w-1/1 px-4 py-2 font-bold break-words ">{{ $offre->nom_projet }}</div>
                            <p class="tex sm:break-normal px-4 py-2 text-justify">{{ $offre->created_at }}</p>
                        </div>
                    </div>


                    <div class="flex flex-col gap-16 sm:block">

                        <!-- ls-->
                        <div class="flex justify-between  sm:justify-content-center ">
                            <!-- status -->
                            <div
                                class="w-1/2 flex justify-center items-center break-words 
@if ($offre->statut === 'En attente de validation') text-orange-500
@elseif($offre->statut === 'rejeter') text-red-500
@elseif($offre->statut === 'Disponible') text-green-500
@else text-gray-500 @endif">
                                {{ $offre->statut }}
                            </div>

                            <!-- les Boutons -->
                            <div class="w-1/2 md:max-w-2xl px-2 py-2 flex items-center gap-4 ">

                                <!-- Bouton Supprimer -->
                                <div x-data="{ showDeleteModal: false }">
                                    <!-- Bouton pour ouvrir la modale de suppression -->
                                    <button @click="showDeleteModal = true" class="hidden sm:block ">
                                        <span>
                                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.33203 4.05136H14.6654M5.4987 1.4043H10.4987M6.33203 12.8749V7.58077M9.66536 12.8749V7.58077M10.9154 16.4043H5.08203C4.16156 16.4043 3.41536 15.6142 3.41536 14.6396L3.03487 4.97044C3.01514 4.46915 3.39363 4.05136 3.86748 4.05136H12.1299C12.6038 4.05136 12.9823 4.46915 12.9625 4.97044L12.582 14.6396C12.582 15.6142 11.8358 16.4043 10.9154 16.4043Z"
                                                    stroke="black" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                        </span>

                                    </button>


                                    <!-- Modale -->
                                    <div x-show="showDeleteModal" x-cloak
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                        <div class="p-6 mx-3 bg-white rounded-lg shadow-lg lg:w-1/3">
                                            <h2 class="mb-4 text-3xl font-bold text-center text-red-600">
                                                Confirmation de suppression</h2>
                                            <p class="mb-4 text-gray-700">Êtes-vous sûr de vouloir supprimer
                                                cette offre ?
                                                Cette action est irréversible.</p>

                                            <!-- Récapitulatif -->
                                            <ul class="mb-4 text-gray-600">
                                                <li><strong>Offre :</strong> {{ $offre->nom_projet }}</li>
                                                <li><strong>Montant :</strong>
                                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                                </li>
                                            </ul>

                                            <!-- Boutons -->
                                            <div class="flex justify-end space-x-4">
                                                <!-- Bouton pour fermer la modale -->
                                                <button @click="showDeleteModal = false"
                                                    class="px-4 py-2 text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                                                    Annuler
                                                </button>
                                                <!-- Bouton pour confirmer la suppression -->
                                                <form action="{{ route('offre.destroy', $offre->id) }}"
                                                    method="POST" class="inline">
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

                                <!-- Bouton Éditer -->
                                <a href="{{ route('offre.edit', $offre->id) }} " class="hidden sm:block">
                                    <span>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.49995 13.1973H13.5M0.5 13.1973L4.13832 12.4642C4.33147 12.4253 4.50882 12.3302 4.6481 12.1908L12.7928 4.04164C13.1833 3.65093 13.1831 3.0176 12.7922 2.62722L11.0669 0.903821C10.6762 0.513599 10.0432 0.513864 9.65288 0.904415L1.5073 9.05446C1.36829 9.19355 1.27337 9.37053 1.23442 9.56328L0.5 13.1973Z"
                                                stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                    </span>

                                </a>

                                <!-- Bouton Voir -->
                                <a href="{{ route('offre.show', $offre->id) }}" class="hidden sm:block">
                                    <span>
                                        <svg width="15" height="3" viewBox="0 0 15 3" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.44318 2.99485C2.03409 2.99485 1.68371 2.85091 1.39205 2.56303C1.10417 2.27515 0.962121 1.92667 0.965909 1.51758C0.962121 1.11606 1.10417 0.77326 1.39205 0.489169C1.68371 0.20129 2.03409 0.0573509 2.44318 0.0573509C2.82955 0.0573509 3.17045 0.20129 3.46591 0.489169C3.76515 0.77326 3.91667 1.11606 3.92045 1.51758C3.91667 1.79031 3.8447 2.03841 3.70455 2.2619C3.56818 2.48538 3.38826 2.66341 3.16477 2.79599C2.94508 2.92856 2.70455 2.99485 2.44318 2.99485ZM7.78131 2.99485C7.37222 2.99485 7.02184 2.85091 6.73017 2.56303C6.44229 2.27515 6.30025 1.92667 6.30403 1.51758C6.30025 1.11606 6.44229 0.77326 6.73017 0.489169C7.02184 0.20129 7.37222 0.0573509 7.78131 0.0573509C8.16767 0.0573509 8.50858 0.20129 8.80403 0.489169C9.10328 0.77326 9.25479 1.11606 9.25858 1.51758C9.25479 1.79031 9.18282 2.03841 9.04267 2.2619C8.90631 2.48538 8.72638 2.66341 8.5029 2.79599C8.2832 2.92856 8.04267 2.99485 7.78131 2.99485ZM13.1194 2.99485C12.7103 2.99485 12.36 2.85091 12.0683 2.56303C11.7804 2.27515 11.6384 1.92667 11.6422 1.51758C11.6384 1.11606 11.7804 0.77326 12.0683 0.489169C12.36 0.20129 12.7103 0.0573509 13.1194 0.0573509C13.5058 0.0573509 13.8467 0.20129 14.1422 0.489169C14.4414 0.77326 14.5929 1.11606 14.5967 1.51758C14.5929 1.79031 14.5209 2.03841 14.3808 2.2619C14.2444 2.48538 14.0645 2.66341 13.841 2.79599C13.6213 2.92856 13.3808 2.99485 13.1194 2.99485Z"
                                                fill="#0D062D" />
                                        </svg>

                                    </span>

                                </a>

                                <div class="sm:block">
                                    <button @click="showDeleteModal = true"
                                        class="inline-flex w-full text-red-600 md:hidden mt-1 mb-2">
                                        <x-heroicon-o-trash class="w-6 h-6" />
                                    </button>
                                    <a href="{{ route('offre.edit', $offre->id) }}"
                                        class="inline-flex w-full text-green-600 md:hidden mb-2">
                                        <x-heroicon-o-pencil-square class="w-6 h-6" />
                                    </a>
                                    <a href="{{ route('offre.show', $offre->id) }}"
                                        class="inline-flex w-full text-blue-600 md:hidden hover:text-blue-800 mb-2">
                                        <x-heroicon-s-eye class="w-6 h-6" />
                                    </a>

                                </div>

                            </div>
                        </div>
                        <!-- important -->
                        <div class="flex justify-between mt-4 sm:justify-content-center ">

                            <div class="flex flex-row-reverse gap-2 text-center items-center">

                                <p class="text-[14px] font-medium text-[#8D6CFF] sm:break-all">
                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                </p>
                                <i class="text-[#808080] fa-solid fa-money-bill-1-wave"></i>
                            </div>
                            <div class="flex flex-row-reverse gap-1 text-center items-center ">

                                <p class="text-[14px] font-medium text-green-600 ">
                                    {{ $offre->taux_interet }}%</p>
                                <i class="text-[#808080] fa-solid fa-chart-line"></i>
                            </div>
                            <!-- Section: Taux d'intérêt respo-->

                        </div>
                    </div>

                </div>



                @empty
                @endforelse
            @else
                <div class="flex flex-col items-center justify-center h-full py-10 bg-white rounded-lg">
                    <h1 class="mb-4 text-2xl font-bold text-gray-800">Aucun compte Startup trouvé</h1>
                    <p class="mb-6 text-center text-gray-600">
                        Vous n'avez pas encore de compte Startup. Créez-en un pour commencer.
                    </p>
                    <a href="{{ route('compte_startup.create') }}"
                        class="inline-block px-4 py-2 font-semibold text-white transition bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                        Créer un compte Startup
                    </a>
                </div>

    @endif
</div>
<div class="w-full flex flex-col xl:max-w-[500px] basis-[30%] bg-[#F5F5F5] rounded-2xl container mx-auto md:py-8">
    <div class="">
        <div class="flex border-b-4 border-[#8BC48A] pb-5 items-center space-x-5 mx-5">
            <i class="fa-solid fa-circle text-[#8BC48A] text-[8px]"></i>
            <h2 class="text-[16px] font-medium text-[#0D062D]">
                investisseurs
            </h2>
        </div>
    </div>
    <!-- Section: pour voir les investisseurs qui ont place de l'argent sur une des mes offres -->

    <div class="p-5 border-b-4 xl:border-none mx-5 xl:mx-0 border-[#8BC48A]">
        <div class="flex flex-col lg:flex-row bg-white rounded-lg">



            <div class="w-full items-center flex space-x-5 ">

                <div class=" space-x-5 flex text-base font-semibold ">
                    <img class="rounded-full bg-cover bg-center h-[50px] w-auto" src="/asset/tune.jpg"
                        alt="">

                </div>

                <h2 class="flex text-[#0D062D] font-semibold text-[18px] mb-2 rounded-md">

                    Jack Meek
                </h2>




            </div>
            <div class="flex flex-col">
                <div class="flex justify-between p-2 ">
                    <span></span>
                    <a href="#" class="flex md:justify-content-end text-[18px] md:text-center text-black">

                        <i class="fa-solid fa-ellipsis"></i>
                    </a>
                </div>

                <div class="p-2 flex flex-col w-full">

                    <div
                        class="flex items-center w-full md:items-center justify-between bg-white rounded-lg gap-2 md:gap-4">

                        <!-- Section: Montant qu'il doit -->
                        <div class="flex items-center space-x-2">
                            <i class="text-[#808080] fa-solid fa-money-bill-1-wave"></i>
                            <p class="text-[12px] font-medium text-[#8D6CFF]">
                                {{ $offre->montant }}
                            </p>
                        </div>

                        <!-- Section: nombre de mois restant -->
                        <div class="flex items-center space-x-2">

                            <i class="text-[#808080] fa-regular fa-calendar"></i>
                            <p class="text-[12px] font-medium text-black">
                                {{ $offre->nbre_mois_remboursement }}</p>
                        </div>

                        <!-- Section: Taux d'intérêt -->
                        <div class="flex items-center space-x-2 ">
                            <i class="text-[#808080] fa-solid fa-chart-line"></i>
                            <p class="text-[12px] font-medium text-green-600 ">
                                {{ $offre->taux_interet }}</p>

                        </div>

                    </div>
                </div>
            </div>



        </div>

    </div>

</div>
