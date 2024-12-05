<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une offres') }}
        </h2>
    </x-slot>

    <div class="py-2 lg:py-5">
        @if (session('success'))
            <div class="fixed top-5 right-5 p-4 bg-green-500 text-white rounded-md shadow-md flex items-center justify-between space-x-4"
                x-data="{ open: true }" x-show="open" x-transition>
                <span>{{ session('success') }}</span>
                <button class="text-white hover:text-gray-200 focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class=" mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <h2 class="text-2xl font-semibold text-center mb-6 text-gray-700">Créer une offre</h2>
                    <livewire:offre-form />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
