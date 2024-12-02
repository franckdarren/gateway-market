<div>
    <form wire:submit.prevent="submit">
        @csrf

        <!-- Nom du projet -->
        <div class="mb-4">
            <label for="nom_projet" class="block text-sm font-medium text-gray-700">Nom du
                projet</label>
            <input type="text" name="nom_projet" id="nom_projet" wire:model="nom_projet"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- Description du projet -->
        <div class="mb-4">
            <label for="description_projet" class="block text-sm font-medium text-gray-700">Description
                du projet</label>
            <textarea name="description_projet" id="description_projet" rows="4" wire:model="description_projet"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required></textarea>
        </div>

        <!-- Montant -->
        <div class="mb-4">
            <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
            <input type="number" name="montant" id="montant" wire:model="montant"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- Nombre de mois de remboursement -->
        <div class="mb-4">
            <label for="nbre_mois_remboursement" class="block text-sm font-medium text-gray-700">Nombre
                de mois de remboursement</label>
            <input type="number" name="nbre_mois_remboursement" id="nbre_mois_remboursement"
                wire:model="nbre_mois_remboursement"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- Nombre de mois de grâce -->
        <div class="mb-4">
            <label for="nbre_mois_grace" class="block text-sm font-medium text-gray-700">Nombre de mois
                de grâce</label>
            <input type="number" name="nbre_mois_grace" id="nbre_mois_grace" wire:model="delaiGrace"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- Taux d'intérêt -->
        <div class="mb-4">
            <label for="taux_interet" class="block text-sm font-medium text-gray-700">Taux
                d'intérêt</label>
            <select name="taux_interet" id="taux_interet" wire:model="tauxInteret"
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
            <input type="file" name="url_business_plan" id="url_business_plan" wire:model="url_business_plan"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                accept=".pdf">
        </div>

        <!-- URL de l'étude de risque (Fichier) -->
        <div class="mb-4">
            <label for="url_etude_risque" class="block text-sm font-medium text-gray-700">Étude de
                Risque (PDF)</label>
            <input type="file" name="url_etude_risque" id="url_etude_risque" wire:model="url_etude_risque"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                accept=".pdf">
        </div>

        <!-- VAN -->
        <div class="mb-4">
            <label for="van" class="block text-sm font-medium text-gray-700">VAN</label>
            <input type="number" name="van" id="van" wire:model="van"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- IR -->
        <div class="mb-4">
            <label for="ir" class="block text-sm font-medium text-gray-700">IR</label>
            <input type="number" step="0.01" name="ir" id="ir" wire:model="ir"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- TRI -->
        <div class="mb-4">
            <label for="tri" class="block text-sm font-medium text-gray-700">TRI</label>
            <input type="number" step="0.01" name="tri" id="tri" wire:model="tri"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- KRL -->
        <div class="mb-4">
            <label for="krl" class="block text-sm font-medium text-gray-700">KRL</label>
            <input type="number" step="0.01" name="krl" id="krl" wire:model="krl"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- Simulateur -->
        <button type="button" wire:click="calculatePrevisions"
            class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Calculer la prévision de remboursement
        </button>
        @if ($remboursements)
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Tableau des prévisions de remboursement</h2>
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Mois</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Capital restant
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Intérêt dû</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Remboursement
                                    capital</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Remboursement
                                    intérêt</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Remboursement
                                    total</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Cumul
                                    remboursement</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($remboursements as $remboursement)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-700">
                                        {{ $remboursement['mois'] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ number_format($remboursement['capital_restant'], 0, '', '.') }} FCFA</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ number_format($remboursement['interet_du'], 0, '', '.') }} FCFA</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ number_format($remboursement['remboursement_capital'], 0, '', '.') }}
                                        FCFA</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ number_format($remboursement['remboursement_interet'], 0, '', '.') }}
                                        FCFA</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ number_format($remboursement['remboursement_total'], 0, '', '.') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ number_format($remboursement['cumul_remboursement'], 0, '', '.') }} FCFA
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @endif

        <!-- Soumettre le formulaire -->
        <div class="flex justify-end">
            <button type="submit"
                class="mt-3 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 ease-in-out">
                Créer l'Offre
            </button>
        </div>
    </form>
</div>
