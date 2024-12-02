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
                <div class=" mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <h2 class="text-2xl font-semibold text-center mb-6 text-gray-700">Créer une offre</h2>
                    <!-- Livewire Formulaire pour capturer les données -->
                    <livewire:offre-form />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
