<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Effectuer un retrait') }}
        </h2>
    </x-slot> --}}

    <div class="py-2 lg:py-5">
        
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="">
                @livewire('retrait')
            </div>
        </div>
    </div>
</x-app-layout>
