<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un compte startup') }}
        </h2>
    </x-slot>

    <div class="py-2 lg:py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @if ($errors->any())
                    <div class="bg-red-100 text-red-600 p-4 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8 mt-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Créer un Compte Startup</h2>
                    <form action="{{ route('compte_startup.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="nom" name="nom" required
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                        </div>

                        <!-- Date de création -->
                        <div>
                            <label for="date_creation" class="block text-sm font-medium text-gray-700">Date de
                                création</label>
                            <input type="date" id="date_creation" name="date_creation" required
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                        </div>

                        <!-- Activité principale -->
                        <div>
                            <label for="activite_principale" class="block text-sm font-medium text-gray-700">Activité
                                principale</label>
                            <input type="text" id="activite_principale" name="activite_principale" required
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" id="phone" name="phone" required
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
