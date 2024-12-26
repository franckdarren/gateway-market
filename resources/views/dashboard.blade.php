<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center space-x-4"><i class="fa-solid fa-circle text-[#5030E5] text-[8px]"></i>
            <h2 class="text-[16px] font-medium text-[#0D062D]">
                @if (auth()->user()->hasRole('Administrateur'))
                    {{ __('Dashboard') }}
                @elseif (auth()->user()->hasRole('Startup'))
                    {{ __('Mes offres') }} ({{ $mesOffres }})
                @elseif (auth()->user()->hasRole('Investisseur'))
                    {{ __('Liste des offres') }} ({{ $mesOffres }})
                @else
                    {{ __('Dashboard') }}
                @endif
            </h2>
        </div>
        @if  (auth()->user()->hasRole('Startup'))
            <a href="{{ route('offre.create') }}"
                class="inline-flex items-center justify-center p-3 mr-2 bg-[#d4cef2] text-[#5030E5] font-bold rounded-lg shadow-md hover:bg-[#478bc4] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-200 ease-in-out float-right mb-2">

                <svg class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>

        </a> @endif
    </x-slot>

    <div class="py-2 lg:py-5">
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
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-0 xl:px-8">
            <div class="">
                @if (auth()->user()->hasRole('Administrateur'))
                    @livewire('dashboard-admin')
                @elseif (auth()->user()->hasRole('Startup'))
                    @livewire('accueil-startup')
                @elseif (auth()->user()->hasRole('Investisseur'))
                    @livewire('investisseur')
                @else
                    @livewire('dashboard-admin')
                @endif
            </div>
        </div>
        
    </div>
</x-app-layout>