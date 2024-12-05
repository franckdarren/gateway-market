<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Créer un compte investisseur') }}
        </h2>
    </x-slot>

    <div class="py-2 lg:py-5">
        @if (session('success'))
            <div class="flex items-center justify-between p-4 mx-auto mb-4 space-x-4 text-white bg-green-500 rounded-md shadow-md md:fixed md:top-5 md:right-5"
                x-data="{ open: true }" x-show="open" x-transition>
                <span>{{ session('success') }}</span>
                <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="">
                <form method="POST" action="{{ route('compte_investisseur.store') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Nom -->
                        <div class="flex flex-col">
                            <label for="nom" class="block mb-2 text-sm font-medium text-gray-700">Nom :</label>
                            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('nom')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Prénom -->
                        <div class="flex flex-col">
                            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-700">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('prenom')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Pays -->
                        <div class="flex flex-col">
                            <label for="pays" class="block mb-2 text-sm font-medium text-gray-700">Pays :</label>
                            <input type="text" id="pays" name="pays" value="{{ old('pays') }}" required
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('pays')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Etat / Province -->
                        <div class="flex flex-col">
                            <label for="etat_province" class="block mb-2 text-sm font-medium text-gray-700">Etat /
                                Province :</label>
                            <input type="text" id="etat_province" name="etat_province"
                                value="{{ old('etat_province') }}"
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('etat_province')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Ville -->
                        <div class="flex flex-col">
                            <label for="ville" class="block mb-2 text-sm font-medium text-gray-700">Ville :</label>
                            <input type="text" id="ville" name="ville" value="{{ old('ville') }}"
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('ville')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Code postal -->
                        <div class="flex flex-col">
                            <label for="code_postal" class="block mb-2 text-sm font-medium text-gray-700">Code postal
                                :</label>
                            <input type="text" id="code_postal" name="code_postal" value="{{ old('code_postal') }}"
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('code_postal')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Téléphone -->
                        <div class="flex flex-col">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Téléphone
                                :</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('phone')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email :</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('email')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Profession -->
                        <div class="flex flex-col">
                            <label for="profession" class="block mb-2 text-sm font-medium text-gray-700">Profession
                                :</label>
                            <input type="text" id="profession" name="profession" value="{{ old('profession') }}"
                                required
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('profession')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-full px-6 py-3 font-semibold text-white bg-blue-600 rounded-lg shadow-md md:w-auto hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Créer le compte
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
