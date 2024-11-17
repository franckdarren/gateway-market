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
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Désignation</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Intérêt</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Montant</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Statut</th>

                <th class="border border-gray-300 px-2 py-2 text-center text-gray-600 w-[250px]">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mesOffres as $offre)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $offre->nom_projet }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $offre->taux_interet }} %</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ number_format($offre->montant, 0, '.', ' ') }} FCFA</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $offre->statut }}</td>

                    <td class="border border-gray-300 px-2 py-2 text-center w-[250px]">
                        <a href="{{ route('offre.show', $offre->id) }}"
                            class="inline-flex items-center px-2 py-1 text-sm font-semibold text-blue-600 hover:text-blue-800 border border-blue-600 rounded-md hover:bg-blue-100">
                            Voir les détails
                        </a>
                        <!-- Bouton Annuler -->
                        {{-- <a href="{{ route('offre.investir', $offre->id) }}"
                            class="px-4 py-4 bg-green-500 text-white rounded-md hover:bg-green-600">
                            Investir
                        </a> --}}
                        <form action="{{ route('offre.annuler', $offre->id) }}" method="POST" class="inline">
                            @csrf
                            @method('GET')
                            <button type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette offre ?')"
                                class="inline-flex items-center px-2 py-1 text-sm font-semibold text-red-600 hover:text-red-800 border border-red-600 rounded-md hover:bg-red-100 ml-2">
                                Annuler
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-600 py-4">Aucune offre disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="my-4 px-6">
        {{ $mesOffres->links() }}
    </div>
</div>
