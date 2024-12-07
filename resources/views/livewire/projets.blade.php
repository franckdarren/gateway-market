<div class="overflow-x-auto">
    @if (session('error'))
            <div class="flex items-center justify-between p-4 mx-auto mb-4 space-x-4 text-white bg-red-500 rounded-md shadow-md md:fixed md:top-5 md:right-5"
                x-data="{ open: true }" x-show="open" x-transition>
                <span>{{ session('error') }}</span>
                <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
    <table class="min-w-full border-none rounded-md shadow-none">
        <thead class="rounded-md bg-gray-50">
            <tr class="rounded-md">
                <th class="px-4 py-2 text-left text-gray-600 border-r border-white rounded-l-lg">Désignation</th>
                <th class="px-4 py-2 text-left text-gray-600 border-r border-white">Intérêt</th>
                <th class="px-4 py-2 text-left text-gray-600 border-r border-white">Montant</th>
                <th class="rounded-r-lg px-2 py-2 text-center text-gray-600 w-[250px]">Statut</th>

                <th class="border border-gray-300 px-2 py-2 text-center text-gray-600 w-[250px]">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mesOffres as $offre)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border border-gray-300">{{ $offre->nom_projet }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $offre->taux_interet }} %</td>
                    <td class="px-4 py-2 border border-gray-300">
                        {{ number_format($offre->montant, 0, '.', ' ') }} FCFA</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $offre->statut }}</td>

                    <td class="border border-gray-300 px-2 py-2 text-center w-[250px]">
                        <a href="{{ route('offre.show', $offre->id) }}"
                            class="inline-flex items-center px-2 py-1 text-sm font-semibold text-blue-600 border border-blue-600 rounded-md hover:text-blue-800 hover:bg-blue-100">
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

    <!-- Pagination -->
    <div class="px-6 my-4">
        {{ $mesOffres->links() }}
    </div>
</div>
