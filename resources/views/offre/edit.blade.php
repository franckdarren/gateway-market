<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une offres') }}
        </h2>
    </x-slot>

    <div class="py-2 lg:py-5">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md shadow-md mb-4 mx-10">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4 mx-10">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class="container mx-auto mt-10">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4">Modifier l'offre</h2>

                        <form action="{{ route('offre.update', $offre->id) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Nom du projet -->
                            <div>
                                <label for="nom_projet" class="block text-sm font-medium text-gray-700">Nom du
                                    projet</label>
                                <input type="text" id="nom_projet" name="nom_projet"
                                    value="{{ old('nom_projet', $offre->nom_projet) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description_projet"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description_projet" name="description_projet" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>{{ old('description_projet', $offre->description_projet) }}</textarea>
                            </div>

                            <!-- Montant -->
                            <div>
                                <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
                                <input type="number" id="montant" name="montant"
                                    value="{{ old('montant', $offre->montant) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- Nombre de mois de remboursement -->
                            <div>
                                <label for="nbre_mois_grace" class="block text-sm font-medium text-gray-700">Nombre de
                                    mois de remboursement</label>
                                <input type="number" id="nbre_mois_remboursement" name="nbre_mois_remboursement"
                                    value="{{ old('nbre_mois_remboursement', $offre->nbre_mois_remboursement) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- Nombre de mois de grâce -->
                            <div>
                                <label for="nbre_mois_grace" class="block text-sm font-medium text-gray-700">Nombre de
                                    mois de grâce</label>
                                <input type="number" id="nbre_mois_grace" name="nbre_mois_grace"
                                    value="{{ old('nbre_mois_grace', $offre->nbre_mois_grace) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- Taux d'intérêt (Liste déroulante) -->
                            <div>
                                <label for="taux_interet" class="block text-sm font-medium text-gray-700">Taux
                                    d'intérêt</label>
                                <select id="taux_interet" name="taux_interet"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                                    @foreach ([3, 6, 9, 12, 15, 18, 21] as $value)
                                        <option value="{{ $value }}"
                                            {{ old('taux_interet', $offre->taux_interet) == $value ? 'selected' : '' }}>
                                            {{ $value }}%
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- VAN -->
                            <div>
                                <label for="van" class="block text-sm font-medium text-gray-700">Valeur Actuelle
                                    Nette (VAN)</label>
                                <input type="number" id="van" name="van"
                                    value="{{ old('van', $offre->van) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- IR -->
                            <div>
                                <label for="ir" class="block text-sm font-medium text-gray-700">Indice de
                                    Rentabilité (IR)</label>
                                <input type="number" step="0.01" id="ir" name="ir"
                                    value="{{ old('ir', $offre->ir) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- TRI -->
                            <div>
                                <label for="tri" class="block text-sm font-medium text-gray-700">Taux de Rendement
                                    Interne (TRI)</label>
                                <input type="number" step="0.01" id="tri" name="tri"
                                    value="{{ old('tri', $offre->tri) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- KRL -->
                            <div>
                                <label for="krl" class="block text-sm font-medium text-gray-700">KRL</label>
                                <input type="number" step="0.01" id="krl" name="krl"
                                    value="{{ old('krl', $offre->krl) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <!-- Business Plan -->
                            <div>
                                <label for="url_business_plan" class="block text-sm font-medium text-gray-700">Business
                                    Plan (PDF)</label>
                                <input type="file" id="url_business_plan" name="url_business_plan"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @if ($offre->url_business_plan)
                                    <p class="text-sm text-gray-600 mt-1">
                                        <a href="{{ Storage::url($offre->url_business_plan) }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            Voir le fichier actuel
                                        </a>
                                    </p>
                                @endif
                            </div>

                            <!-- Étude de Risque -->
                            <div>
                                <label for="url_etude_risque" class="block text-sm font-medium text-gray-700">Étude de
                                    Risque (PDF)</label>
                                <input type="file" id="url_etude_risque" name="url_etude_risque"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @if ($offre->url_etude_risque)
                                    <p class="text-sm text-gray-600 mt-1">
                                        <a href="{{ Storage::url($offre->url_etude_risque) }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            Voir le fichier actuel
                                        </a>
                                    </p>
                                @endif
                            </div>

                            <!-- Bouton de soumission -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h1 class="text-xl font-bold text-gray-800 my-6 text-center">Simulateur de prévision de remboursement
            </h1>
            @livewire('prevision')
        </div>
    </div>
</x-app-layout>
