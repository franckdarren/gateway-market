<div wire:poll.1m>
    <table class="min-w-full border-collapse border border-gray-200 bg-white shadow-md">
        <thead class="bg-gray-50">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Désignation</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Intérêt</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Mois de remboursement</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Mois de grace</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Montant</th>
                <th class="border border-gray-300 px-2 py-2 text-center text-gray-600 w-[250px]">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mesOffres as $offre)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $offre->nom_projet }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $offre->taux_interet }} %</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $offre->nbre_mois_remboursement }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $offre->nbre_mois_grace }}</td>

                    <td class="border border-gray-300 px-4 py-2">{{ $offre->montant }} FCFA</td>
                    <td class="border border-gray-300 px-2 py-2 text-center w-[250px]">
                        <!-- Bouton Voir -->
                        <a href="{{ route('offre.show', $offre->id) }}"
                            class="inline-flex items-center px-2 py-1 text-sm font-semibold text-blue-600 hover:text-blue-800 border border-blue-600 rounded-md hover:bg-blue-100">
                            Voir les détails
                        </a>
                    </td>


                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="my-4 px-6">
        {{ $mesOffres->links() }}
    </div>
</div>
