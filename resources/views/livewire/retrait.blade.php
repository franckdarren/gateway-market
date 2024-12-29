<div class="max-w-2xl mx-auto px-8 pb-8 bg-white rounded-lg shadow-lg">
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
    @if (session('error'))
        <div class="flex items-center justify-between p-4 mx-auto mb-4 space-x-4 text-white bg-red-500 rounded-md shadow-md md:fixed md:top-5 md:right-5"
            x-data="{ open: true }" x-show="open" x-transition>
            <span>{{ session('error') }}</span>
            <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
    <div>
        <h2 class="mb-6 text-2xl font-semibold text-center">Faire une transaction</h2>
        <form wire:submit.prevent="submit" class="space-y-6">
            <!-- Type de transaction -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type de transaction</label>
                <select wire:model="type" id="type"
                    class="block w-full px-4 py-2 mt-1 border bg-gray-100 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" onchange="handleTypeChange()">
                    <option>Choisir le type de transaction</option>
                    <option value="depot">Dépot</option>
                    <option value="retrait">Retrait</option>
                    required
                </select>
                @error('type')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Montant -->
            <div class="">
                <div>
                    <label for="montant" class="block text-sm font-medium text-gray-700">Montant (en FCFA)</label>
                    <input type="number" wire:model="montant" id="montant"
                        class="block w-full px-4 py-2 mt-1 border bg-gray-100 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('montant')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Mode de Retrait -->
            <div id="retraitFields" class="hidden">
                <label for="mode_retrait" class="block text-sm font-medium text-gray-700">Mode de Retrait</label>
                <select wire:model="mode_retrait" id="mode_retrait"
                    class="block w-full px-4 py-2 mt-1 border bg-gray-100 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option>Choisir un mode de retrait</option>
                    <option value="AirtelMoney">AirtelMoney</option>
                    <option value="MoovMoney">MoovMoney</option>
                    <option value="Virement">Virement</option>
                </select>
                @error('mode_retrait')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mode de Dépot -->
            <div id="depotFields" class="hidden">
                <label for="mode_depot" class="block text-sm font-medium text-gray-700">Mode de Dépot</label>
                <select wire:model="mode_depot" id="mode_depot"
                    class="block w-full px-4 py-2 mt-1 border bg-gray-100 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option>Choisir un mode de dépot</option>
                    <option value="AirtelMoney">AirtelMoney</option>
                    <option value="MoovMoney">MoovMoney</option>
                    <option value="Virement">Virement</option>
                </select>
                @error('mode_depot')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Numero du Compte -->
            <div>
                <label for="numero_compte" class="block text-sm font-medium text-gray-700">Numéro ou RIB</label>
                <input type="text" wire:model="numero_compte" id="numero_compte"
                    class="block w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @error('numero_compte')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nom du Compte -->
            <div>
                <label for="nom_compte" class="block text-sm font-medium text-gray-700">Nom du Compte</label>
                <input type="text" wire:model="nom_compte" id="nom_compte"
                    class="block w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @error('nom_compte')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Numéro de la transaction -->
            <div id="depotFields2" class="hidden">
                <label for="numero_transaction" class="block text-sm font-medium text-gray-700">Numéro de la transaction</label>
                <input type="text" wire:model="numero_transaction" id="numero_transaction"
                    class="block w-full px-4 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('numero_transaction')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit"
                    class="px-6 py-3 text-white font-semibold rounded-md shadow-md   bg-[#5B3FFC] hover:bg-[#5B3FFC]/90 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Soumettre
                </button>
            </div>
        </form>
        <script>
            function handleTypeChange() {
                const type = document.getElementById('type').value;
                const retraitFields = document.getElementById('retraitFields');
                const depotFields = document.getElementById('depotFields');

                // Masquer ou afficher les champs en fonction de la sélection
                if (type === 'retrait') {
                    retraitFields.classList.remove('hidden');
                    depotFields.classList.add('hidden');
                    depotFields2.classList.add('hidden');

                } else if (type === 'depot') {
                    retraitFields.classList.add('hidden');
                    depotFields.classList.remove('hidden');
                    depotFields2.classList.remove('hidden');

                } else {
                    retraitFields.classList.add('hidden');
                    depotFields.classList.add('hidden');
                    depotFields2.classList.add('hidden');

                }
            }
        </script>
    </div>

</div>
