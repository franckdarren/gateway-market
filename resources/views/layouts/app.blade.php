<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gateway Market') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @filamentStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        {{-- @livewire('navigation-menu') --}}

        <!-- Page Content -->
        {{-- <main>
            {{ $slot }}
        </main> --}}
        <div>
            <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                    class="fixed inset-0 z-20 transition-opacity bg-blue-200 opacity-50 lg:hidden"></div>

                <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
                    <div class="flex items-center justify-center mt-8">
                        <div class="flex items-center">
                            <a href="{{ route('dashboard') }}">
                                <x-application-mark class="block w-auto h-9" />
                            </a>
                        </div>
                    </div>

                    <nav class="mt-10">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 10h6v11H3zM15 3h6v18h-6zM9 3h6v11H9z\"/>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </svg>"'>
                            @if (auth()->user()->hasRole('Administrateur'))
                                {{ __('Dashboard') }}
                            @else
                                {{ __('Accueil') }}
                            @endif
                        </x-nav-link>

                        @role('Administrateur')
                            <!-- Lien Investisseurs -->
                            <x-nav-link href="{{ route('investisseur') }}" :active="request()->routeIs('investisseur')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M14 11H6m0 0L3 8m3 3l3 3m10-4h1a1 1 0 001-1V7a4 4 0 00-4-4H7a4 4 0 00-4 4v1a1 1 0 001 1h1m12 4a4 4 0 110 8 4 4 0 010-8z\"></path>
                                                                                                                                                                                                            </svg>"'>
                                {{ __('Investisseurs') }}
                            </x-nav-link>
                        @endrole

                        @role('Administrateur')
                            <!-- Lien Startups -->
                            <x-nav-link href="{{ route('startup') }}" :active="request()->routeIs('startup')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 2a10 10 0 0110 10v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a10 10 0 0110-10zm0 6v6m4-3H8\"></path>
                                                                                                                                                                                                            </svg>"'>
                                {{ __('Startups') }}
                            </x-nav-link>
                        @endrole

                        @role('Administrateur')
                            <!-- Lien Retraits -->
                            <x-nav-link href="{{ route('demandes') }}" :active="request()->routeIs('demandes')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 19v-7m0 7l-4-4m4 4l4-4M6 6h12\"></path>
                                                                                                                                                                                                            </svg>"'>
                                {{ __('Retraits') }}
                            </x-nav-link>
                        @endrole

                        @role('Administrateur')
                            <!-- Lien Transactions -->
                            <x-nav-link href="{{ route('transaction') }}" :active="request()->routeIs('transaction')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 12h14M5 12l4-4m-4 4l4 4m10-4l-4-4m4 4l-4 4\"></path>
                                                                                                                                                                                                            </svg>"'>
                                {{ __('Transactions') }}
                            </x-nav-link>
                        @endrole


                        @role('Investisseur')
                            <!-- Lien Mes projets -->
                            <x-nav-link href="{{ route('projets') }}" :active="request()->routeIs('projets')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 3L9 12l-5-5\"/>
                                                                                                                                                                                </svg>"'>
                                {{ __('Mes projets') }}
                            </x-nav-link>
                        @endrole

                        @role('Investisseur')
                            <!-- Lien Remboursement -->
                            <x-nav-link href="{{ route('remboursement') }}" :active="request()->routeIs('remboursement')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 4v16c0 1.104.896 2 2 2h14c1.104 0 2-.896 2-2V4H3zm6 14V8l6 5-6 5z\"/>
                                                                                                                                                                                </svg>"'>
                                {{ __('Remboursement') }}
                            </x-nav-link>
                        @endrole

                        @role('Investisseur')
                            <!-- Lien Historique -->
                            <x-nav-link href="{{ route('historique') }}" :active="request()->routeIs('historique')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 12h14M5 12l4-4m-4 4l4 4m10-4l-4-4m4 4l-4 4\"></path>
                                                                                                                                                                                </svg>"'>
                                {{ __('Historique') }}
                            </x-nav-link>
                        @endrole

                        @role('Investisseur')
                            <!-- Lien Retrait -->
                            <x-nav-link href="{{ route('retrait') }}" :active="request()->routeIs('retrait')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 19v-7m0 7l-4-4m4 4l4-4M6 6h12\"></path>
                                                                                                                                                                                </svg>"'>
                                {{ __('Retrait') }}
                            </x-nav-link>
                        @endrole


                        @role('Startup')
                            <x-nav-link href="{{ route('dette') }}" :active="request()->routeIs('dette')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8c3.866 0 7-1.79 7-4s-3.134-4-7-4-7 1.79-7 4 3.134 4 7 4z\"></path>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8v4m0 0c-3.866 0-7-1.79-7-4m7 4c3.866 0 7-1.79 7-4m-7 4v8m0 0h-4m4 0h4\"></path>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </svg>"'>
                                {{ __('Dette') }}
                            </x-nav-link>
                        @endrole

                        @role('Startup')
                            <x-nav-link href="{{ route('historique') }}" :active="request()->routeIs('historique')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 12a9 9 0 1118 0 9 9 0 01-18 0zM12 7v5l3 3\"></path>

                                                        </svg>"'>
                                {{ __('Historique') }}
                            </x-nav-link>
                        @endrole
                        @role('Startup')
                            <x-nav-link href="{{ route('retrait') }}" :active="request()->routeIs('retrait')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 17v5H8v-5M12 12l-4-4m4 4l4-4m-4 4V3\"></path>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </svg>"'>
                                {{ __('Retrait') }}
                            </x-nav-link>
                        @endrole
                        <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" :icone='"<svg class=\"w-6 h-6\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z\"></path>

                                                                                                </svg>"'>
                            {{ __('Profil') }}
                        </x-nav-link>

                    </nav>
                </div>
                <div class="flex flex-col flex-1 overflow-hidden">
                    <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                        <div class="flex items-center mr-5 md:mr-0">
                            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center justify-between w-full">
                            {{-- Solde --}}
                            @php
                                // Initialisation des soldes
                                $soldeInvestisseur = 0;
                                $soldeStartup = 0;
                                $soldeAdmin = 0;

                                // Vérification du rôle de l'utilisateur connecté
if (auth()->user()->hasRole('Investisseur')) {
    // Si l'utilisateur est un Investisseur, récupère son solde
                                    $soldeInvestisseur = auth()->user()->compteInvestisseur
                                        ? auth()->user()->compteInvestisseur->solde
                                        : 0;
                                } elseif (auth()->user()->hasRole('Startup')) {
                                    // Si l'utilisateur est une Startup, récupère son solde
    $soldeStartup = auth()->user()->compteStartup
        ? auth()->user()->compteStartup->solde
        : 0;
} elseif (auth()->user()->hasRole('Administrateur')) {
    // Si l'utilisateur est un Admin, récupère le solde du compte admin
                                    $soldeAdmin = auth()->user()->compteAdmin ? auth()->user()->compteAdmin->solde : 0;
                                }
                            @endphp

                            <!-- Affichage conditionnel des soldes -->
                            <div class="">
                                @if (auth()->user()->hasRole('Investisseur'))
                                    <p class="text-lg font-semibold text-gray-800">Solde : <span
                                            class="text-xl text-green-600">{{ number_format($soldeInvestisseur, 0, '.', ' ') }}
                                            FCFA</span></p>
                                @elseif (auth()->user()->hasRole('Startup'))
                                    <p class="font-semibold text-gray-800 lg:text-lg">Solde : <span
                                            class="text-green-600 lg:text-xl">{{ number_format($soldeStartup, 0, '.', ' ') }}
                                            FCFA</span>
                                    </p>
                                @elseif (auth()->user()->hasRole('Administrateur'))
                                    <p class="text-lg font-semibold text-gray-800">Solde : <span
                                            class="text-xl text-green-600">{{ number_format($soldeAdmin, 0, '.', ' ') }}
                                            FCFA</span>
                                    </p>
                                @endif
                            </div>

                            <div x-data="{ dropdownOpen: false }" class="relative">
                                <button @click="dropdownOpen = ! dropdownOpen"
                                    class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                                    <img class="object-cover w-8 h-8 rounded-full"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                                </button>

                                <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                    class="fixed inset-0 z-10 w-full h-full" style="display: none;"></div>

                                <div x-show="dropdownOpen"
                                    class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                                    style="display: none;">
                                    <!-- Account Management -->

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#18181b] hover:text-white w-full text-left">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>
                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                        <div class="container px-6 py-6 mx-auto md:py-8">
                            <!-- Page Heading -->
                            @if (isset($header))
                                <header class="">
                                    <div class="">
                                        {{ $header }}
                                    </div>
                                </header>
                            @endif
                            <div class="">
                                {{ $slot }}
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
