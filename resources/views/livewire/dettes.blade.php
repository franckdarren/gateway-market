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
    <table class="overflow-hidden border border-gray-200 shadow-md">
        <thead class="bg-gray-50">
            <tr class="">
                <th class="px-6 py-3 text-left text-sm font-medium text-black tracking-wider">Projet</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-black tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-black tracking-wider">Remboursement</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-black tracking-wider">Cumul</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-black tracking-wider w-[250px]">Statut</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($remboursements as $remboursement)
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $remboursement->offre->nom_projet }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $remboursement->mois }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ number_format($remboursement->remboursement_total, 0, '.', ' ') }} FCFA</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ number_format($remboursement->cumul_remboursement, 0, '.', ' ') }} FCFA</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span
                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium border
                                {{ $remboursement->statut === 'Remboursé' ? 'bg-[#f0fdf4] text-[#16A34A] border-green-100' : 'bg-[#fffbeb] text-[#D97706] border-yellow-100' }}">{{ $remboursement->statut }}
                        </span>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-600">Aucun remboursement disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="px-6 my-4">
        {{ $remboursements->links() }}
    </div>
</div>
