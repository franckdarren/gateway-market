<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-medium text-gray-700">
            @if (auth()->user()->hasRole('Administrateur'))
                {{ __('Dashboard') }}
            @elseif (auth()->user()->hasRole('Startup'))
                {{ __('Mes offres') }} ({{ $mesOffres }})
            @else
                {{ __('Liste des offres') }} ({{ $mesOffres }})
            @endif
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
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-0 xl:px-8">
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
