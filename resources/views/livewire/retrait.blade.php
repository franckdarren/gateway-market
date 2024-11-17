<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    @if (session()->has('message'))
        <div class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4"
            role="alert">
            <svg class="w-5 h-5 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M10 0a10 10 0 100 20A10 10 0 0010 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif
    <h2 class="text-2xl font-semibold text-center mb-6">Retrait d'argent</h2>
    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Montant -->
        <div class="">
            <div>
                <label for="montant" class="block text-sm font-medium text-gray-700">Montant (en</label>
                <input type="number" wire:model="montant" id="montant"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @error('montant')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Mode de Retrait -->
        <div>
            <label for="mode_retrait" class="block text-sm font-medium text-gray-700">Mode de Retrait</label>
            <select wire:model="mode_retrait" id="mode_retrait"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option>Choisir un mode de retrait</option>
                <option value="AirtelMoney">AirtelMoney</option>
                <option value="MoovMoney">MoovMoney</option>
                <option value="Virement">Virement</option>
                required
            </select>
            @error('mode_retrait')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Numero du Compte -->
        <div>
            <label for="numero_compte" class="block text-sm font-medium text-gray-700">Numéro ou RIB</label>
            <input type="text" wire:model="numero_compte" id="numero_compte"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                required>
            @error('numero_compte')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nom du Compte -->
        <div>
            <label for="nom_compte" class="block text-sm font-medium text-gray-700">Nom du Compte</label>
            <input type="text" wire:model="nom_compte" id="nom_compte"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                required>
            @error('nom_compte')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Soumettre
            </button>
        </div>
    </form>
</div>
