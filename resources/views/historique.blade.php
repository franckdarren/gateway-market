<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-medium text-gray-700">
            {{ __('Historique') }}
        </h2>
    </x-slot>

    <div class="py-2 lg:py-5">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('historique')
            </div>
        </div>
    </div>
</x-app-layout>
