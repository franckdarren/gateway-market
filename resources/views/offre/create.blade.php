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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <h2 class="text-2xl font-semibold text-center mb-6 text-gray-700">Créer une offre</h2>

                    <form action="{{ route('offre.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nom du projet -->
                        <div class="mb-4">
                            <label for="nom_projet" class="block text-sm font-medium text-gray-700">Nom du
                                projet</label>
                            <input type="text" name="nom_projet" id="nom_projet"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Description du projet -->
                        <div class="mb-4">
                            <label for="description_projet" class="block text-sm font-medium text-gray-700">Description
                                du projet</label>
                            <textarea name="description_projet" id="description_projet" rows="4"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required></textarea>
                        </div>

                        <!-- Montant -->
                        <div class="mb-4">
                            <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
                            <input type="number" name="montant" id="montant"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Nombre de mois de remboursement -->
                        <div class="mb-4">
                            <label for="nbre_mois_remboursement" class="block text-sm font-medium text-gray-700">Nombre
                                de mois de remboursement</label>
                            <input type="number" name="nbre_mois_remboursement" id="nbre_mois_remboursement"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Nombre de mois de grâce -->
                        <div class="mb-4">
                            <label for="nbre_mois_grace" class="block text-sm font-medium text-gray-700">Nombre de mois
                                de grâce</label>
                            <input type="number" name="nbre_mois_grace" id="nbre_mois_grace"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Taux d'intérêt -->
                        <div class="mb-4">
                            <label for="taux_interet" class="block text-sm font-medium text-gray-700">Taux
                                d'intérêt</label>
                            <select name="taux_interet" id="taux_interet"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option>Selectionner un taux</option>
                                <option value="3">3%</option>
                                <option value="6">6%</option>
                                <option value="9">9%</option>
                                <option value="12">12%</option>
                                <option value="15">15%</option>
                                <option value="18">18%</option>
                                <option value="21">21%</option>
                            </select>
                        </div>


                        <!-- URL du Business Plan (Fichier) -->
                        <div class="mb-4">
                            <label for="url_business_plan" class="block text-sm font-medium text-gray-700">Business Plan
                                (PDF)</label>
                            <input type="file" name="url_business_plan" id="url_business_plan"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                accept=".pdf">
                        </div>

                        <!-- URL de l'étude de risque (Fichier) -->
                        <div class="mb-4">
                            <label for="url_etude_risque" class="block text-sm font-medium text-gray-700">Étude de
                                Risque (PDF)</label>
                            <input type="file" name="url_etude_risque" id="url_etude_risque"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                accept=".pdf">
                        </div>

                        <!-- VAN -->
                        <div class="mb-4">
                            <label for="van" class="block text-sm font-medium text-gray-700">VAN</label>
                            <input type="number" name="van" id="van"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- IR -->
                        <div class="mb-4">
                            <label for="ir" class="block text-sm font-medium text-gray-700">IR</label>
                            <input type="number" step="0.01" name="ir" id="ir"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- TRI -->
                        <div class="mb-4">
                            <label for="tri" class="block text-sm font-medium text-gray-700">TRI</label>
                            <input type="number" step="0.01" name="tri" id="tri"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- KRL -->
                        <div class="mb-4">
                            <label for="krl" class="block text-sm font-medium text-gray-700">KRL</label>
                            <input type="number" step="0.01" name="krl" id="krl"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Soumettre le formulaire -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 ease-in-out">
                                Créer l'Offre
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
