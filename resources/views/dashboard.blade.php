<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (auth()->user()->hasRole('Administrateur'))
                {{ __('Dashboard') }}
            @elseif (auth()->user()->hasRole('Startup'))
                {{ __('Liste des offres') }}
            @else
                {{ __('Liste des offres') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-2 bg-[#CFDFEA] lg:py-5">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md shadow-md mb-4 mx-10">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
