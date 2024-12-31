<div class="">

    @if ($hasCompteStartup)

        <div class="container flex flex-col-reverse xl:flex-row mx-auto gap-10">

            <div class="w-full flex flex-col space-y-5 px-2 bg-[#F5F5F5] basis-[70%] rounded-t-2xl gap-0">
                <!-- partie A -->
                <div class="col-start-2 relative h-12">

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

                    <!--hr class="absolute bottom-0 left-0 w-full border-t-4 border-[#5030E5] "-->
                </div>

                <!-- partie B -->

                @forelse ($mesOffres as $offre)
                    <div
                        class="container flex flex-col sm:flex-row justify-between bg-white rounded-lg shadow-md hover:shadow-xl p-4 gap-6 transition-shadow duration-300 ease-in-out">
                        <!-- Section Image et Informations -->
                        <div class="w-full flex flex-row items-center gap-4 sm:w-1/3">
                            <!-- Image -->
                            <div class="w-[50px] h-[50px] ">
                                <img class="rounded-full object-cover w-full h-full hover:scale-105 transition-transform duration-300"
                                    src="{{ $offre->url_image }}" alt="Image Offre">
                            </div>
                            <!-- Informations -->
                            <div class="flex flex-col justify-content-center w-1/2">
                                <h3
                                    class="text-[#0D062D] break-normal font-semibold text-[18px] hover:text-[#8D6CFF] transition-colors duration-300 truncate">
                                    {{ $offre->nom_projet }}
                                </h3>
                                <p class="text-sm text-gray-500 break-normal">{{ $offre->created_at }}</p>
                            </div>
                        </div>

                        <!-- Section Statut et Montant -->
                        <div
                            class="flex flex-row items-center py-2 justify-between gap-4 sm:flex-col sm:items-end sm:w-1/2">
                            <!-- Statut -->
                            <span
                                class="px-3 py-1 text-sm font-medium rounded-lg

                                @php
                                    $statusClasses = match ($offre->statut) {
                                        'En attente de validation' => 'bg-orange-100 text-orange-500',
                                        'Rejeter' => 'bg-red-100 text-red-500',
                                        'Disponible' => 'bg-green-100 text-green-500',
                                        default => 'bg-gray-100 text-gray-500',
                                    };
                                @endphp
                                {{ $statusClasses }}">
          {{ $offre->statut }}
                            </span>

                            <!-- Montant -->
                            <div class="flex items-center space-x-2">
                                <i class="ftext-[#808080] fa-solid fa-money-bill-1-wave"></i>
                                <p class="text-[#8D6CFF] font-medium text-sm">
                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                                </p>
                            </div>
                        </div>

                        <!-- Section Boutons et Taux d'intérêt -->
                        <div class="flex flex-row items-center justify-between gap-4 sm:flex-col sm:items-end p-2">
                            <!-- Boutons d'Action -->
                            <div class="flex flex-row lg:gap-3 gap-6">

                                <!-- Bouton Supprimer -->

                                <div x-data="{ showDeleteModal: false }">
                                    @if ($offre->statut !== 'En cours')
                                        <!-- Bouton pour ouvrir la modale de suppression -->
                                        <button @click="showDeleteModal = true"
                                            class="flex rounded-lg hover:bg-red-200 transition-colors duration-300">
                                            <i class="fa-solid fa-trash "></i>

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
                                    @endif

                                </div>
                                <!-- Bouton Modifier -->
                                @if ($offre->statut !== 'En cours')
                                    <a href="{{ route('offre.edit', $offre->id) }}"
                                        class="flex rounded-lg hover:bg-yellow-200 transition-colors duration-300">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                @endif
                                <!-- Bouton Voir -->
                                <a href="{{ route('offre.show', $offre->id) }}"
                                    class="flex md:justify-center text-[18px] md:text-center text-black hover:text-[#8D6CFF] transition-colors duration-300">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>

                            </div>
                            <!-- Taux d'intérêt -->
                            <div class="flex items-center sm:justify-start sm:w-full gap-2">
                                <i class="fa-solid fa-chart-line text-[#808080]"></i>
                                <p class="text-green-600 font-medium text-sm">{{ $offre->taux_interet }}%</p>
                            </div>
                        </div>
                    </div>

                @empty
                @endforelse
            </div>

            <!-- section investisseur -->

            <div class="w-full flex flex-col xl:max-w-[500px] basis-[30%] bg-[#F5F5F5] rounded-2xl container mx-auto ">
                <div class="">
                    <div class="flex border-b-4 border-[#8BC48A] mt-4 items-center space-x-5 mx-5">
                        <i class="fa-solid fa-circle text-[#8BC48A] text-[8px]"></i>
                        <h2 class="text-[21px] font-medium text-[#0D062D]">
                            Investisseurs
                        </h2>
                    </div>
                </div>
                <!-- Section: pour voir les investisseurs qui ont place de l'argent sur une des mes offres -->

                <div
                    class="w-full overflow-x-auto flex gap-5 xl:px-2 xl:py-5 border-b-4 lg:border-none border-[#8BC48A] flex-row lg:flex-col">
                    <div class="flex-none flex flex-col bg-white lg:w-full rounded-lg shadow-md">
                        <div class="flex flex-col items-center py-4">
                            <div class="flex w-full px-4 justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <div class="w-[50px] h-[50px]">
                                        <!-- ici c'est l'image de profil de l'investisseur -->
                                        <img class="rounded-full bg-cover bg-center h-full w-full"
                                            src="{{ $offre->url_image }}" alt="">
                                    </div>
                                    <h2
                                        class="text-[#0D062D] font-semibold text-[18px] hover:text-[#8D6CFF] transition-colors duration-300 truncate">
                                        Jack Meek
                                    </h2>
                                </div>
                                <div class="flex flex-col items-end space-y-2">
                                    <h1 class="text-[14px] md:text-[16px] font-bold text-[#03314B]">180 000 000 FCFA
                                    </h1>
                                    <h1 class="text-[16px] font-bold text-[#1D82CC]">18%</h1>
                                </div>
                            </div>
                            <div class="font-bold text-[18px] text-[#03314B] text-center mt-4">
                                <h1>Projet X</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Répète ce bloc pour d'autres cartes -->


                </div>
              

            </div>

        </div>
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

