<div class="">
    <!-- Tableau des prévisions -->
    @if ($remboursements)
        <div class="mt-8">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Tableau des prévisions de remboursement</h2>
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-left text-white">Mois</th>
                            <th class="px-4 py-3 text-sm font-medium text-left text-white">Placement restant</th>
                            <th class="px-6 py-3 text-sm font-medium text-left text-white">Intérêt dû</th>
                            <!-- <th class="px-4 py-3 text-sm font-medium text-left text-white">Remboursement capital</th>
                            <th class="px-4 py-3 text-sm font-medium text-left text-white">Remboursement intérêt</th> -->
                            <th class="px-4 py-3 text-sm font-medium text-left text-white">Remboursement total</th>
                            <th class="px-4 py-3 text-sm font-medium text-left text-white">Cumul remboursement</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($remboursements as $remboursement)
                            <tr>
                                <td class="px-2 py-4 text-[12px] font-medium text-gray-700">{{ $remboursement['mois'] }}
                                </td>
                                <td class="px-2 py-4 text-[12px] text-gray-900">
                                    {{ number_format($remboursement['capital_restant'], 0, '', ' ') }} FCFA</td>
                                <td class="px-2 py-4 text-[12px] text-gray-900">
                                    {{ number_format($remboursement['interet_du'], 0, '', ' ') }} FCFA</td>
                                <!-- <td class="px-2 py-4 text-[12px] text-gray-900">
                                    {{ number_format($remboursement['remboursement_capital'], 0, '', ' ') }} FCFA</td>
                                <td class="px-2 py-4 text-[12px] text-gray-900">
                                    {{ number_format($remboursement['remboursement_interet'], 0, '', ' ') }} FCFA</td> -->
                                <td class="px-2 py-4 text-[12px] text-gray-900">
                                    {{ number_format($remboursement['remboursement_total'], 0, '', ' ') }} FCFA</td>
                                <td class="px-2 py-4 text-[12px] font-extrabold text-green-700">
                                    {{ number_format($remboursement['cumul_remboursement'], 0, '', ' ') }} FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endif

</div>
