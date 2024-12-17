<div class="max-w-2xl p-8 mx-auto bg-white rounded-lg shadow-lg">
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
    <h2 class="mb-6 text-2xl font-semibold text-center">Retrait d'argent</h2>
    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Montant -->
        <div class="">
            <div>
                <label for="montant" class="block text-sm font-medium text-gray-700">Montant (en</label>
                <input type="number" wire:model="montant" id="montant"
                    class="block w-full px-4 py-2 mt-1 border bg-gray-100 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @error('montant')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Mode de Retrait -->
        <div>
            <label for="mode_retrait" class="block text-sm font-medium text-gray-700">Mode de Retrait</label>
            <select wire:model="mode_retrait" id="mode_retrait"
                class="block w-full px-4 py-2 mt-1 border bg-gray-100 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option>Choisir un mode de retrait</option>
                <option value="AirtelMoney">AirtelMoney</option>
                <option value="MoovMoney">MoovMoney</option>
                <option value="Virement">Virement</option>
                required
            </select>
            @error('mode_retrait')
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

        <div class="flex justify-center mt-6">
            <button type="submit"
                class="px-6 py-3 text-white font-semibold rounded-md shadow-md bg-[#0A52AB] hover:bg-[#478bc4] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Soumettre
            </button>
        </div>
    </form>
</div>
