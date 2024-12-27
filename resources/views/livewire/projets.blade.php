<div class="overflow-x-auto bg-white rounded-lg">
    @if (session('error'))
        <div class="flex items-center justify-between p-4 mx-auto mb-4 space-x-4 text-white bg-red-500 rounded-md shadow-md md:fixed md:top-5 md:right-5"
            x-data="{ open: true }" x-show="open" x-transition>
            <span>{{ session('error') }}</span>
            <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
    <table class="overflow-hidden border hidden border-gray-200 shadow-md">
        <thead class="bg-gray-50">
            <tr class="">
                <th class="px-6 py-3 text-left text-sm font-medium  tracking-wider">Désignation</th>
                <th class="px-6 py-3 text-left text-sm font-medium  tracking-wider">Intérêt</th>
                <th class="px-6 py-3 text-left text-sm font-medium  tracking-wider">Montant</th>
                <th class="px-6 py-3 text-left text-sm font-medium  tracking-wider">Statut</th>

                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider w-[250px]">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($mesOffres as $offre)
                <tr class="hover:bg-blue-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $offre->nom_projet }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $offre->taux_interet }} %</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ number_format($offre->montant, 0, '.', ' ') }} FCFA
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span
                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium border bg-[#f0fdf4] text-[#16A34A] border-green-100">{{ $offre->statut }}
                        </span>
                    </td>

                    <td class=" px-2 py-2 text-center w-[250px]">
                        <a href="{{ route('offre.show', $offre->id) }}"
                            class="inline-flex items-center px-2 py-1 text-sm font-semibold border border-blue-600 rounded-md bg-blue-600 text-white hover:bg-blue-600/70">
                            Voir les détails
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-600">Aucune offre disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <div class="flex space-x-4">
        @forelse ($mesOffres as $offre)
            <div
                class="flex flex-col xl:flex-row space-y-5 justify-between w-full xl:items-center border border-gray-200 rounded-lg shadow-md p-4 bg-white hover:shadow-lg transition-shadow">
                <div class="flex"> <img src="{{ $offre->image_url ?? 'https://via.placeholder.com/150' }}"
                        alt="Image de {{ $offre->nom_projet }}" class="w-16 h-16 rounded-full object-cover mr-4">


                    <div class="flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $offre->nom_projet }}</h3>
                        <p>nom de la start up</p>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="md:flex grid grid-cols-2 items-center justify-between gap-2 lg:space-x-5">
                    <p class="text-sm text-gray-400">
                    <i class="text-sm fa-solid fa-chart-line"></i> <span class="font-medium text-blue-600">{{ $offre->taux_interet }}%</span>
                    </p>
                    <p class="text-sm text-gray-600">
                    <i class="text-sm fa-solid fa-money-bill"></i> <span class="font-medium text-green-600">{{ number_format($offre->montant, 0, '.', ' ') }}
                            FCFA</span>
                    </p>
                    <span
                        class="inline-block px-3 py-1 text-xs font-medium rounded-full border 
                               {{ $offre->statut === 'Approuvé' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                        {{ $offre->statut }}
                    </span>
                </div>

                <!-- Actions -->
                <div class="items-end justify-end flex xl:ml-4">
                    <a href="{{ route('offre.show', $offre->id) }}"
                        class="inline-block px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Voir les détails
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-1 text-center text-gray-600">
                Aucune offre disponible
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    {{-- <div class="px-6 my-4">
        {{ $mesOffres->links() }}
    </div> --}}
</div>