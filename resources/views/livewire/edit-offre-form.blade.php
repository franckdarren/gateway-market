<div>
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
    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="">
        @csrf
        <div class="grid gap-5 md:grid-cols-2">
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
                <input type="number" name="montant" id="montant" wire:model.live.debounce.250ms="montant"
                    wire:change="calculatePrevisions"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <!-- Nombre de mois de remboursement -->
            <div class="mb-4">
                <label for="nbre_mois_remboursement" class="block text-sm font-medium text-gray-700">Nombre
                    de mois de remboursement</label>
                <input type="number" name="nbre_mois_remboursement" id="nbre_mois_remboursement"
                    wire:model.live.debounce.250ms="nbre_mois_remboursement" wire:change="calculatePrevisions"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <!-- Nombre de mois de grâce -->
            <div class="mb-4">
                <label for="nbre_mois_grace" class="block text-sm font-medium text-gray-700">Nombre de mois
                    de grâce</label>
                <input type="number" name="nbre_mois_grace" id="nbre_mois_grace"
                    wire:model.live.debounce.250ms="delaiGrace" wire:change="calculatePrevisions"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <!-- Taux d'intérêt -->
            <div class="mb-4">
                <label for="taux_interet" class="block text-sm font-medium text-gray-700">Taux
                    d'intérêt</label>
                <select name="taux_interet" id="taux_interet" wire:model.live.debounce.250ms="tauxInteret"
                    wire:change="calculatePrevisions"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
                    <option class="text-[10px]">Selectionner un taux</option>
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
                <div wire:loading wire:target="url_business_plan">Chargement...</div>
                @error('url_business_plan')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                @if ($current_business_plan)
                    <p class="mt-1 text-sm text-gray-600">
                        <a href="{{ Storage::url($current_business_plan) }}" target="_blank"
                            class="text-blue-600 hover:underline">
                            Voir le fichier actuel
                        </a>
                    </p>
                @endif
            </div>

            <!-- URL de l'étude de risque (Fichier) -->
            <div class="mb-4">
                <label for="url_etude_risque" class="block text-sm font-medium text-gray-700">Étude de Risque
                    (PDF)</label>
                <input type="file" name="url_etude_risque" id="url_etude_risque" wire:model="url_etude_risque"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    accept=".pdf">
                <div wire:loading wire:target="url_etude_risque">Chargement...</div>
                @error('url_etude_risque')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                @if ($current_etude_risque)
                    <p class="mt-1 text-sm text-gray-600">
                        <a href="{{ Storage::url($current_etude_risque) }}" target="_blank"
                            class="text-blue-600 hover:underline">
                            Voir le fichier actuel
                        </a>
                    </p>
                @endif
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
        </div>
        <!-- Simulateur -->
        <div>
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
                                            {{ number_format($remboursement['capital_restant'], 0, '', '.') }} FCFA
                                        </td>
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
        </div>


        <!-- Bouton de soumission -->
        <div class="flex justify-center mt-3">
            <button type="submit"
                class="px-4 py-2 text-white bg-blue-500 rounded-md focus:outline-none hover:bg-blue-600">
                Enregistrer
            </button>
        </div>
    </form>
</div>
