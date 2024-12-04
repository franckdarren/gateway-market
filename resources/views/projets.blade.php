<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-medium text-gray-700">
            {{ __('Mes projets') }}
        </h2>
    </x-slot>
    <div class="py-2 lg:py-5">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md shadow-md mb-4 mx-10">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @livewire('projets')
            </div>
        </div>
    </div>
</x-app-layout>
