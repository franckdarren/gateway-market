<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Créer une offres') }}
        </h2>
    </x-slot> --}}

    <div class="py-2 lg:py-5">
        @if (session('success'))
            <div class="flex items-center justify-between p-4 mx-auto mb-4 space-x-4 text-white bg-green-500 rounded-md shadow-md md:fixed md:top-5 md:right-5"
                x-data="{ open: true }" x-show="open" x-transition>
                <span>{{ session('success') }}</span>
                <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="p-4 mx-10 mb-4 text-white bg-red-500 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="">
                <div class="container flex mx-auto">
                    <div class="w-full p-6 bg-white rounded-lg shadow-md">
                        <h2 class="mb-4 text-3xl font-bold text-center text-black">Modifier l'offre</h2>

                        <form action="{{ route('offre.update', $offre->id) }}" method="POST"
                            enctype="multipart/form-data" class="flex flex-col items-center justify-center w-full space-y-10 ">
                            @csrf
                            @method('PUT')
                            <div class="grid w-full grid-cols-1 gap-5 md:grid-cols-2">
                                <!-- Nom du projet -->
                                <div>
                                    <label for="nom_projet" class="block text-sm font-medium text-gray-700">Nom du
                                        projet</label>
                                    <input type="text" id="nom_projet" name="nom_projet"
                                        value="{{ old('nom_projet', $offre->nom_projet) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description_projet"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea id="description_projet" name="description_projet" rows="4"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>{{ old('description_projet', $offre->description_projet) }}</textarea>
                                </div>

                                <!-- Montant -->
                                <div>
                                    <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
                                    <input type="number" id="montant" name="montant"
                                        value="{{ old('montant', $offre->montant) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- Nombre de mois de remboursement -->
                                <div>
                                    <label for="nbre_mois_grace" class="block text-sm font-medium text-gray-700">Nombre
                                        de
                                        mois de remboursement</label>
                                    <input type="number" id="nbre_mois_remboursement" name="nbre_mois_remboursement"
                                        value="{{ old('nbre_mois_remboursement', $offre->nbre_mois_remboursement) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- Nombre de mois de grâce -->
                                <div>
                                    <label for="nbre_mois_grace" class="block text-sm font-medium text-gray-700">Nombre
                                        de
                                        mois de grâce</label>
                                    <input type="number" id="nbre_mois_grace" name="nbre_mois_grace"
                                        value="{{ old('nbre_mois_grace', $offre->nbre_mois_grace) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- Taux d'intérêt (Liste déroulante) -->
                                <div>
                                    <label for="taux_interet" class="block text-sm font-medium text-gray-700">Taux
                                        d'intérêt</label>
                                    <select id="taux_interet" name="taux_interet"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                        @foreach ([3, 6, 9, 12, 15, 18, 21] as $value)
                                            <option value="{{ $value }}" {{ old('taux_interet', $offre->taux_interet) == $value ? 'selected' : '' }}>
                                                {{ $value }}%
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- VAN -->
                                <div>
                                    <label for="van" class="block text-sm font-medium text-gray-700">Valeur Actuelle
                                        Nette (VAN)</label>
                                    <input type="number" id="van" name="van" value="{{ old('van', $offre->van) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- IR -->
                                <div>
                                    <label for="ir" class="block text-sm font-medium text-gray-700">Indice de
                                        Rentabilité (IR)</label>
                                    <input type="number" step="0.01" id="ir" name="ir"
                                        value="{{ old('ir', $offre->ir) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- TRI -->
                                <div>
                                    <label for="tri" class="block text-sm font-medium text-gray-700">Taux de Rendement
                                        Interne (TRI)</label>
                                    <input type="number" step="0.01" id="tri" name="tri"
                                        value="{{ old('tri', $offre->tri) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- KRL -->
                                <div>
                                    <label for="krl" class="block text-sm font-medium text-gray-700">KRL</label>
                                    <input type="number" step="0.01" id="krl" name="krl"
                                        value="{{ old('krl', $offre->krl) }}"
                                        class="block w-full mt-1 bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                </div>

                                <!-- Business Plan -->
                                <div>
                                    <label for="url_business_plan"
                                        class="block text-sm font-medium text-gray-700">Business
                                        Plan (PDF)</label>
                                    <input type="file" id="url_business_plan" name="url_business_plan"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    @if ($offre->url_business_plan)
                                        <p class="mt-1 text-sm text-gray-600">
                                            <a href="{{ Storage::url($offre->url_business_plan) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                Voir le fichier actuel
                                            </a>
                                        </p>
                                    @endif
                                </div>

                                <!-- Étude de Risque -->
                                <div>
                                    <label for="url_etude_risque" class="block text-sm font-medium text-gray-700">Étude
                                        de
                                        Risque (PDF)</label>
                                    <input type="file" id="url_etude_risque" name="url_etude_risque"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    @if ($offre->url_etude_risque)
                                        <p class="mt-1 text-sm text-gray-600">
                                            <a href="{{ Storage::url($offre->url_etude_risque) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                Voir le fichier actuel
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </div>


                            <!-- Bouton de soumission -->
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-blue-500 rounded-md focus:outline-none hover:bg-blue-600">
                                    Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h1 class="my-6 text-xl font-bold text-center text-gray-800">Simulateur de prévision de remboursement
            </h1>
            @livewire('prevision', [
    'montantEmprunte' => $offre->montant,
    'duree' => $offre->nbre_mois_remboursement,
    'tauxInteret' => $offre->taux_interet,
    'delaiGrace' => $offre->nbre_mois_grace,
])
        </div>
    </div>
</x-app-layout>
