<x-app-layout>
    <x-slot name="header">
        <h2 class="flex text-[21px] items-center space-x-4"><i class="fa-solid fa-circle text-[#5030E5] mr-4 text-[8px]"></i>
            {{ __('Remboursement') }}
        </h2>
    </x-slot>

    <div class="py-2 lg:py-5">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                @livewire('remboursements')
            </div>
        </div>
    </div>
</x-app-layout>
