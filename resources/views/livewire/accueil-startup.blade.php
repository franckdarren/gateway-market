<div>
    @if ($hasCompteStartup)
        <div class="container mx-auto p-4">

            <div class="overflow-x-auto">
                <a href="{{ route('offre.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 ease-in-out float-right mb-3">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer une offre
                </a>

                <table class="min-w-full border-collapse border border-gray-200 bg-white shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Désignation</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Intérêt</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Montant</th>
                            <th class="border border-gray-300 px-2 py-2 text-center text-gray-600 w-[200px]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mesOffres as $offre)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $offre->nom_projet }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $offre->taux_interet }} %</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $offre->montant }} FCFA</td>
                                <td class="border border-gray-300 px-2 py-2 text-center w-[200px]">
                                    <button
                                        class="inline-flex items-center px-2 py-1 text-sm text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 9V5.25a2.25 2.25 0 00-2.25-2.25h-3a2.25 2.25 0 00-2.25 2.25V9m-3.75 0h15m-15 0v9.75A2.25 2.25 0 005.25 21h13.5a2.25 2.25 0 002.25-2.25V9m-15 0v-.75A1.5 1.5 0 016.75 6.75h10.5A1.5 1.5 0 0118.75 9V9m-9 3h3m-3 3h3" />
                                        </svg>
                                    </button>
                                    <button
                                        class="inline-flex items-center px-2 py-1 text-sm text-green-600 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487c.253-.253.596-.39.941-.39.345 0 .688.137.941.39l1.829 1.829c.253.253.39.596.39.941 0 .345-.137.688-.39.941l-1.829 1.829-3.712-3.712 1.83-1.83zm-.97.97L4.5 16.85V19.5h2.65l11.391-11.391-3.712-3.712z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="inline-flex items-center px-2 py-1 text-sm text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
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
