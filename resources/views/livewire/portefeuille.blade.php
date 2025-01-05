<div>
    @if (auth()->user()->compteInvestisseur)
        <div x-data="{ showModal: false }" class="relative">
            <!-- Bouton pour ouvrir la modale -->
            <a href="javascript:void(0)" @click="showModal = true"
                class="fixed bottom-[30px] right-[20px] md:bottom-[50px] md:right-[60px] hover:scale-110 transition-all duration-300 ease-in-out transform bg-[#9d83fd]/80 text-[#673DF9] p-3 rounded-full shadow-2xl hover:bg-[#9d83fd] hover:border-[#673DF9] hover:border-4">
                <span class="iconify text-4xl" data-icon="solar:wallet-money-bold-duotone" data-inline="false"></span>
            </a>

            <!-- Modale -->
            <div x-show="showModal" x-transition x-cloak
                class="fixed inset-x-0 lg:left-64 bottom-0 z-50 bg-white shadow-lg border ">
                <!-- En-tête de la modale -->
                <div class="flex items-center justify-between xl:px-10 md:px-8 px-2 py-3 border-b">
                    <h2 class="text-lg xl:text-[21px] font-semibold">Mon portefeuille</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Contenu de la modale -->
                <div class="px-2 md:px-8 xl:px-10 flex w-full items-center justify-between  py-4">
                    <div>
                        <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total remboursé</p>
                        <p class="text-[14px] text-blue-900 md:text-[16px] xl:text-2xl">
                            {{ number_format($totalRemboursements, 0, '.', ' ') }} FCFA</p>
                    </div>
                    <span class="iconify  text-gray-800  text-md md:text-2xl xl:text-4xl" data-icon="ic:round-minus"
                        data-inline="false"></span>
                    <div>
                        <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total investis</p>
                        <p class="text-[14px] md:text-[16px] xl:text-2xl">
                            {{ number_format($totalInvestissement, 0, '.', ' ') }} FCFA</p>
                    </div>
                    <span class="iconify text-gray-800 text-md md:text-2xl xl:text-4xl"
                        data-icon="material-symbols:equal-rounded" data-inline="false"></span>
                    <div>
                        <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total bénéfice gain/perte</p>
                        <p
                            class="{{ $benefice_perte >= 0 ? 'text-green-500' : 'text-red-500 ' }} text-[14px] font-bold md:text-[16px] xl:text-2xl">
                            {{ number_format($benefice_perte, 0, '.', ' ') }} FCFA</p>
                    </div>

                </div>
            </div>
        </div>
    @elseif (auth()->user()->compteStartup)
        <div x-data="{ showModal: false }" class="relative">
            <!-- Bouton pour ouvrir la modale -->
            <a href="javascript:void(0)" @click="showModal = true"
                class="fixed bottom-[30px] right-[20px] md:bottom-[50px] md:right-[60px] hover:scale-110 transition-all duration-300 ease-in-out transform bg-[#9d83fd]/80 text-[#673DF9] p-3 rounded-full shadow-2xl hover:bg-[#9d83fd] hover:border-[#673DF9] hover:border-4">
                <span class="iconify text-4xl" data-icon="solar:wallet-money-bold-duotone" data-inline="false"></span>
            </a>

            <!-- Modale -->
            <div x-show="showModal" x-transition x-cloak
                class="fixed inset-x-0 lg:left-64 bottom-0 z-50 bg-white shadow-lg border ">
                <!-- En-tête de la modale -->
                <div class="flex items-center justify-between xl:px-10 md:px-8 px-2 py-3 border-b">
                    <h2 class="text-lg xl:text-[21px] font-semibold">Mon portefeuille</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Contenu de la modale -->
                <div class="px-2 md:px-8 xl:px-10 flex w-full items-center justify-between  py-4">
                    <div>
                        <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total dette</p>
                        <p class="text-[14px] text-blue-900 md:text-[16px] xl:text-2xl">
                            {{ number_format($totalDette, 0, '.', ' ') }} FCFA</p>
                    </div>
                    <span class="iconify  text-gray-800  text-md md:text-2xl xl:text-4xl" data-icon="ic:round-minus"
                        data-inline="false"></span>
                    <div>
                        <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total remboursé</p>
                        <p class="text-[14px] md:text-[16px] xl:text-2xl">
                            {{ number_format($totalRembourse, 0, '.', ' ') }} FCFA</p>
                    </div>
                    <span class="iconify text-gray-800 text-md md:text-2xl xl:text-4xl"
                        data-icon="material-symbols:equal-rounded" data-inline="false"></span>
                    <div>
                        <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Somme restante à rembourser</p>
                        <p
                            class="{{ $detteRestante <= 0 ? 'text-green-500' : 'text-red-500 ' }} text-[14px] font-bold md:text-[16px] xl:text-2xl">
                            {{ number_format($detteRestante, 0, '.', ' ') }} FCFA</p>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
