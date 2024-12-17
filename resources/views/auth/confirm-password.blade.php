<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                {{-- <x-button class="ms-4 bg-blue-800 hover:bg-blue-900">
                    {{ __('Confirm') }}
                </x-button> --}}
                <button type="submit"
                    class="ms-4 px-6 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md
           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                    Confirmer
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
