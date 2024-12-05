<div class=" p-6">

    <!-- Formulaire -->
    <form wire:submit.prevent="calculatePrevisions" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col">
                <label for="montantEmprunte" class="block text-sm font-medium text-gray-700 mb-2">Montant emprunté
                    :</label>
                <input type="number" id="montantEmprunte" wire:model="montantEmprunte" required disabled
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
            </div>

            <div class="flex flex-col">
                <label for="duree" class="block text-sm font-medium text-gray-700 mb-2">Durée (en mois) :</label>
                <input type="number" id="duree" wire:model="duree" required disabled
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col">
                <label for="tauxInteret" class="block text-sm font-medium text-gray-700 mb-2">Taux d'intérêt (%)
                    :</label>
                <input type="number" id="tauxInteret" wire:model="tauxInteret" required disabled
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
            </div>

            <div class="flex flex-col">
                <label for="delaiGrace" class="block text-sm font-medium text-gray-700 mb-2">Délai de grâce (en mois)
                    :</label>
                <input type="number" id="delaiGrace" wire:model="delaiGrace" required disabled
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
            </div>
        </div>

        <div class="flex justify-center">
            <button type="submit"
                class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Calculer
            </button>
        </div>
    </form>

    <!-- Tableau des prévisions -->
    @if ($remboursements)
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tableau des prévisions de remboursement</h2>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Mois</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Capital restant</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Intérêt dû</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Remboursement capital</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Remboursement intérêt</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Remboursement total</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Cumul remboursement</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($remboursements as $remboursement)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $remboursement['mois'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ number_format($remboursement['capital_restant'], 0, '', '.') }} FCFA</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ number_format($remboursement['interet_du'], 0, '', '.') }} FCFA</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ number_format($remboursement['remboursement_capital'], 0, '', '.') }} FCFA</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ number_format($remboursement['remboursement_interet'], 0, '', '.') }} FCFA</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ number_format($remboursement['remboursement_total'], 0, '', '.') }} FCFA</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ number_format($remboursement['cumul_remboursement'], 0, '', '.') }} FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endif

</div>
