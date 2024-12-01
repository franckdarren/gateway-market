<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Investisseurs') }}
        </h2>
    </x-slot>

    <div class="py-2 w-full ">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('list-investisseur')
            </div>
        </div>
    </div>
</x-app-layout>
