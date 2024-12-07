<div>
    @if ($hasCompteStartup)
        <div class="container mx-auto">

            <div class="px-5 pt-2 overflow-x-auto bg-white rounded-md">
                <a href="{{ route('offre.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 mr-2 bg-[#0A52AB] text-white font-semibold text-sm rounded-lg shadow-md hover:bg-[#478bc4] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-200 ease-in-out float-right mb-3">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer une offre
                </a>

                <table class="min-w-full border-none rounded-md shadow-none">
                    <thead class="rounded-md bg-gray-50">
                        <tr class="rounded-md">
                            <th class="px-4 py-2 text-left text-gray-600 border-r border-white rounded-l-lg">
                                Désignation</th>
                            <th class="px-4 py-2 text-left text-gray-600 border-r border-white">Intérêt</th>
                            <th class="px-4 py-2 text-left text-gray-600 border-r border-white">Montant</th>
                            <th class="rounded-r-lg px-2 py-2 text-center text-gray-600 w-[250px]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mesOffres as $offre)
                            <tr class="py-2 border-b-4 border-gray-200 hover:bg-gray-100 ">
                                <td class="p-4 ">{{ $offre->nom_projet }}</td>
                                <td class="p-4 text-center text-green-500 ">{{ $offre->taux_interet }} %</td>
                                <td class="p-4 text-xs font-bold lg:text-base">
                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA</td>
                                <td
                                    class=" flex flex-col justify-center items-center md:flex-row h-full md:p-4 text-center md:w-[250px]">
                                    <!-- Bouton Voir -->
                                    <a href="{{ route('offre.show', $offre->id) }}"
                                        class="items-center hidden px-2 py-1 mt-1 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-md md:inline-flex hover:text-blue-800 hover:bg-blue-300">
                                        Voir
                                    </a>
                                    <a href="{{ route('offre.show', $offre->id) }}"
                                        class="inline-flex w-full text-blue-600 md:hidden hover:text-blue-800">
                                        <x-heroicon-s-eye class="w-6 h-6" />
                                    </a>

                                    <!-- Bouton Éditer -->
                                    <a href="{{ route('offre.edit', $offre->id) }}"
                                        class="items-center hidden px-2 py-1 mt-1 ml-2 text-sm font-semibold text-white bg-green-600 border border-green-600 rounded-md md:inline-flex hover:text-green-800 hover:bg-green-300">
                                        Éditer
                                    </a>

                                    <a href="{{ route('offre.edit', $offre->id) }}"
                                        class="inline-flex w-full text-green-600 md:hidden ">
                                        <x-heroicon-o-pencil-square class="w-6 h-6" />
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('offre.destroy', $offre->id) }}" method="POST"
                                        class="inline mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')"
                                            class="items-center hidden px-2 py-1 ml-2 text-sm font-semibold text-white bg-red-600 border border-red-600 rounded-md md:inline-flex hover:text-red-800 hover:bg-red-300">
                                            Supprimer
                                        </button>
                                        <button type="submit"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')"
                                            class="inline-flex text-red-600 md:hidden">
                                            <x-heroicon-s-trash class="w-6 h-6" />
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
</div>

</div>
