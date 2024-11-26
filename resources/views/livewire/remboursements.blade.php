<div class="overflow-x-auto">
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-10" role="alert">
            <strong class="font-bold">Erreur : </strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove();">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.935 2.935a1 1 0 01-1.414-1.414l2.935-2.935L5.651 7.515a1 1 0 011.414-1.414L10 8.586l2.935-2.935a1 1 0 011.414 1.414L11.414 10l2.935 2.935a1 1 0 010 1.414z" />
                </svg>
            </button>
        </div>
    @endif
    <table class="min-w-full border-collapse border border-gray-200 bg-white shadow-md mt-3">
        <thead class="bg-gray-50">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Projet</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Date</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Remboursement</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Cumul Remboursement</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Statut</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($remboursements as $remboursement)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $remboursement->offre->nom_projet }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $remboursement->mois }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ number_format($remboursement->remboursement_total, 0, '.', ' ') }} FCFA</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ number_format($remboursement->cumul_remboursement, 0, '.', ' ') }} FCFA</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $remboursement->statut }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-600 py-4">Aucune remboursement disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="my-4 px-6">
        {{ $remboursements->links() }}
    </div>
</div>
