<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dettes') }}
        </h2>
    </x-slot>

    <div class="py-2  lg:py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @livewire('dettes')
            </div>
        </div>
    </div>
</x-app-layout>
