<div>
    @if ($hasCompteStartup)
        <div class="container mx-auto p-4">

            <div class="overflow-x-auto">
                <a href="{{ route('offre.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[#18181b] text-white font-semibold text-sm rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-200 ease-in-out float-right mb-3">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer une offre
                </a>

                <table class="min-w-full border-collapse border border-gray-200 bg-white shadow-md">
                    <thead class="bg-gray-50 rounded-md">
                        <tr class="rounded-md">
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Désignation</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Intérêt</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Montant</th>
                            <th class="border border-gray-300 px-2 py-2 text-center text-gray-600 w-[250px]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mesOffres as $offre)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $offre->nom_projet }}</td>
                                <td class="border border-gray-300 text-center text-green-500 px-4 py-2">{{ $offre->taux_interet }} %</td>
                                <td class="border border-gray-300 text-xs lg:text-base font-bold px-2 py-2">
                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA</td>
                                <td class="border border-gray-300 px-2 py-2 text-center w-[250px]">
                                    <!-- Bouton Voir -->
                                    <a href="{{ route('offre.show', $offre->id) }}"
                                        class="inline-flex items-center px-2 py-1 text-sm font-semibold text-blue-600 hover:text-blue-800 border border-blue-600 rounded-md hover:bg-blue-100">
                                        Voir
                                    </a>

                                    <!-- Bouton Éditer -->
                                    <a href="{{ route('offre.edit', $offre->id) }}"
                                        class="inline-flex items-center mt-1 px-2 py-1 text-sm font-semibold text-green-600 hover:text-green-800 border border-green-600 rounded-md hover:bg-green-100 ml-2">
                                        Éditer
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('offre.destroy', $offre->id) }}" method="POST"
                                        class="inline mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')"
                                            class="inline-flex items-center px-2 py-1 text-sm font-semibold text-red-600 hover:text-red-800 border border-red-600 rounded-md hover:bg-red-100 ml-2">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>


                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="flex flex-col items-center justify-center h-full py-10 bg-gray-100">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Aucun compte Startup trouvé</h1>
                    <p class="text-gray-600 text-center mb-6">
                        Vous n'avez pas encore de compte Startup. Créez-en un pour commencer.
                    </p>
                    <a href="{{ route('compte_startup.create') }}"
                        class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition">
                        Créer un compte Startup
                    </a>
                </div>

    @endif
</div>
</div>

</div>
