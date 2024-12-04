<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-medium text-gray-700">
            @if (auth()->user()->hasRole('Administrateur'))
                {{ __('Dashboard') }}
            @elseif (auth()->user()->hasRole('Startup'))
                {{ __('Liste des offres') }}
            @else
                {{ __('Liste des offres') }}
            @endif
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
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @if (auth()->user()->hasRole('Administrateur'))
                    @livewire('dashboard-admin')
                @elseif (auth()->user()->hasRole('Startup'))
                    @livewire('accueil-startup')
                @else
                    @livewire('investisseur')
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
