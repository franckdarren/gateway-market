<div>
    @if ($hasCompteStartup)
        <div class="container mx-auto md:p-4">

            <div class="overflow-x-auto bg-white rounded-md px-5 pt-2">
                <a href="{{ route('offre.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 mr-2 bg-[#18181b] text-white font-semibold text-sm rounded-lg shadow-md hover:bg-[#0A52AB] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-200 ease-in-out float-right mb-3">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer une offre
                </a>

                <table class="min-w-full border-none shadow-none rounded-md">
                    <thead class="bg-gray-50 rounded-md">
                        <tr class="rounded-md">
                            <th class="border-r border-white rounded-l-lg  px-4 py-2 text-left text-gray-600">Désignation</th>
                            <th class="border-r border-white px-4 py-2 text-left text-gray-600">Intérêt</th>
                            <th class="border-r border-white px-4 py-2 text-left text-gray-600">Montant</th>
                            <th class="rounded-r-lg px-2 py-2 text-center text-gray-600 w-[250px]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mesOffres as $offre)
                            <tr class="hover:bg-gray-100 border-b py-2 border-gray-400 ">
                                <td class=" p-4">{{ $offre->nom_projet }}</td>
                                <td class=" text-center text-green-500 p-4">{{ $offre->taux_interet }} %</td>
                                <td class=" text-xs lg:text-base font-bold p-4">
                                    {{ number_format($offre->montant, 0, '.', ' ') }} FCFA</td>
                                <td class=" flex flex-col justify-center items-center md:flex-row h-full md:p-4 text-center md:w-[250px]">
                                    <!-- Bouton Voir -->
                                    <a href="{{ route('offre.show', $offre->id) }}"
                                        class="hidden md:inline-flex items-center px-2 py-1 text-sm font-semibold text-blue-600 hover:text-blue-800 border border-blue-600 rounded-md hover:bg-blue-100">
                                        Voir
                                    </a>
                                    <a href="{{ route('offre.show', $offre->id) }}"
                                        class="inline-flex w-full md:hidden text-blue-600 hover:text-blue-800">
                                        <x-heroicon-s-eye class="w-6 h-6" />
                                    </a>

                                    <!-- Bouton Éditer -->
                                    <a href="{{ route('offre.edit', $offre->id) }}"
                                        class="hidden md:inline-flex items-center mt-1 px-2 py-1 text-sm font-semibold text-green-600 hover:text-green-800 border border-green-600 rounded-md hover:bg-green-100 ml-2">
                                        Éditer
                                    </a>

                                    <a href="{{ route('offre.edit', $offre->id) }}"
                                        class="inline-flex md:hidden w-full text-green-600 ">
                                        <x-heroicon-o-pencil-square class="w-6 h-6" />
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('offre.destroy', $offre->id) }}" method="POST"
                                        class="inline mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')"
                                            class="hidden md:inline-flex items-center px-2 py-1 text-sm font-semibold text-red-600 hover:text-red-800 border border-red-600 rounded-md hover:bg-red-100 ml-2">
                                            Supprimer
                                        </button>
                                        <button type="submit"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')"
                                            class="inline-flex md:hidden text-red-600">
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
