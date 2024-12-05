<div class="overflow-x-auto">
    @if (session('error'))
        <div class="fixed flex items-center justify-between p-4 space-x-4 text-white bg-red-500 rounded-md shadow-md top-5 right-5"
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
    <table class="min-w-full mt-3 bg-white border border-collapse border-gray-200 shadow-md">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-300">Projet</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-300">Date</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-300">Remboursement</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-300">Cumul Remboursement</th>
                <th class="px-4 py-2 text-left text-gray-600 border border-gray-300">Statut</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($remboursements as $remboursement)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border border-gray-300">{{ $remboursement->offre->nom_projet }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $remboursement->mois }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        {{ number_format($remboursement->remboursement_total, 0, '.', ' ') }} FCFA</td>
                    <td class="px-4 py-2 border border-gray-300">
                        {{ number_format($remboursement->cumul_remboursement, 0, '.', ' ') }} FCFA</td>
                    <td
                        class="border border-gray-300 px-4 py-2 {{ $remboursement->statut === 'Remboursé' ? 'text-green-600' : '' }}">
                        {{ $remboursement->statut }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-600">Aucune remboursement disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="px-6 my-4">
        {{ $remboursements->links() }}
    </div>
</div>
