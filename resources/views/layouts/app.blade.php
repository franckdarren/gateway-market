<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ config('app.name', 'Gateway Market') }}</title>

    <link rel="stylesheet" href="../../css/skilline.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>


    @filamentStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-white">
        <!-- Page Content -->
        <div>
            <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-white">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                    class="fixed inset-0 z-20 transition-opacity bg-blue-200 opacity-50 lg:hidden"></div>

                <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform  bg-[#2B2B2B] lg:translate-x-0 lg:static lg:inset-0">
                    <div class="flex items-center justify-center mt-8">
                        <div class="flex items-center">
                            <a href="{{ route('dashboard') }}">
                                <x-application-mark class="block w-auto h-9" />
                            </a>
                        </div>
                    </div>

                    <nav class="mt-10">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                            :icone="'<span class=\'iconify text-4xl\'
                            data-icon=\'duo-icons:dashboard\' data-inline=\'false\'></span>
                            '">
                            @if (auth()->user()->hasRole('Administrateur'))
                                {{ __('Dashboard') }}
                            @elseif (auth()->user()->hasRole('Investisseur'))
                                {{ __('Accueil') }}
                            @elseif (auth()->user()->hasRole('Startup'))
                                {{ __('Accueil') }}
                            @else
                                {{ __('Dashboard') }}
                            @endif
                        </x-nav-link>

                        @role('Administrateur')
                        <!-- Lien Investisseurs -->
                        <x-nav-link href="{{ route('validations-offres') }}"
                            :active="request()->routeIs('validations-offres')" :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'uim:briefcase\' data-inline=\'false\'></span>'">
                            {{ __('Offres') }}
                        </x-nav-link>
                        @endrole

                        @role(['Administrateur', 'Superviseur'])
                        <!-- Lien Investisseurs -->
                        <x-nav-link href="{{ route('investisseur') }}" :active="request()->routeIs('investisseur')"
                            :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'stash:user-dollar-duotone\' data-inline=\'false\'></span>'">
                            {{ __('Investisseurs') }}
                        </x-nav-link>
                        @endrole

                        @role(['Administrateur', 'Superviseur'])
                        <!-- Lien Startups -->
                        <x-nav-link href="{{ route('startup') }}" :active="request()->routeIs('startup')" :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'solar:rocket-bold-duotone\' data-inline=\'false\'></span>'">
                            {{ __('Startups') }}
                        </x-nav-link>
                        @endrole

                        @role(['Administrateur', 'Superviseur'])
                        <!-- Lien Retraits -->
                        <x-nav-link href="{{ route('demandes') }}" :active="request()->routeIs('demandes')"
                            :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'pepicons-print:money-note-circle-filled\' data-inline=\'false\'></span>'">
                            {{ __('Dépots/Retraits') }}
                        </x-nav-link>
                        @endrole

                        @role('Administrateur')
                        <!-- Lien Transactions -->
                        <x-nav-link href="{{ route('transaction') }}" :active="request()->routeIs('transaction')"
                            :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'proicons:arrow-swap\' data-inline=\'false\'></span>'">
                            {{ __('Transactions') }}
                        </x-nav-link>
                        @endrole


                        @role('Investisseur')
                        <!-- Lien Mes projets -->
                        <x-nav-link href="{{ route('projets') }}" :active="request()->routeIs('projets')" :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'uim:chart\' data-inline=\'false\'></span>'">
                            {{ __('Mes placements') }}
                        </x-nav-link>
                        @endrole

                        @role('Investisseur')
                        <!-- Lien Favoris -->
                        <x-nav-link href="{{ route('favoris') }}" :active="request()->routeIs('favoris')" :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'iconamoon:star-duotone\' data-inline=\'false\'></span>'">
                            {{ __('Favoris') }}
                        </x-nav-link>
                        @endrole

                        @role('Investisseur')
                        <!-- Lien Remboursement -->
                        <x-nav-link href="{{ route('remboursement') }}" :active="request()->routeIs('remboursement')"
                            :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'pepicons-print:coins\' data-inline=\'false\'></span>'">
                            {{ __('Remboursement') }}
                        </x-nav-link>
                        @endrole

                        @role('Investisseur')
                        <!-- Lien Historique -->
                        <x-nav-link href="{{ route('historique') }}" :active="request()->routeIs('historique')"
                            :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'proicons:arrow-swap\' data-inline=\'false\'></span>'">
                            {{ __('Transactions') }}
                        </x-nav-link>
                        @endrole

                        @role('Investisseur')
                        <!-- Lien Retrait -->
                        <x-nav-link href="{{ route('retrait') }}" :active="request()->routeIs('retrait')" :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'pepicons-print:money-note-circle-filled\' data-inline=\'false\'></span>'">
                            {{ __('Dépot/Retrait') }}
                        </x-nav-link>
                        @endrole

                        @role('Startup')
                        <x-nav-link href="{{ route('dette') }}" :active="request()->routeIs('dette')" :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'ic:twotone-receipt-long\' data-inline=\'false\'></span>'">
                            {{ __('Dette') }}
                        </x-nav-link>
                        @endrole

                        @role('Startup')
                        <x-nav-link href="{{ route('historique') }}" :active="request()->routeIs('historique')"
                            :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'proicons:arrow-swap\' data-inline=\'false\'></span>'">
                            {{ __('Historique') }}
                        </x-nav-link>
                        @endrole
                        @role('Startup')
                        <x-nav-link href="{{ route('retrait') }}" :active="request()->routeIs('retrait')" :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'pepicons-print:money-note-circle-filled\' data-inline=\'false\'></span>'">
                            {{ __('Dépot/Retrait') }}
                        </x-nav-link>
                        @endrole
                        <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')"
                            :icone="'<span class=\'iconify text-4xl\'
                                data-icon=\'solar:user-bold-duotone\' data-inline=\'false\'></span>'">
                            {{ __('Profil') }}
                        </x-nav-link>
                    </nav>
                </div>
                <div class="flex flex-col flex-1 overflow-hidden">
                    <header class="flex items-center justify-between px-6 py-4 bg-white border-b-2 ">
                        <!-- border-b-4 border-[#0A52AB] -->
                        <div class="flex items-center mr-5 md:mr-0">
                            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                    <div class="flex justify-center items-center text-lg font-semibold text-gray-800">
                                        <div class="flex items-center space-x-2 bg-white py-4 md:p-4 rounded-lg w-full max-w-sm">
                                            <!-- Icône de solde -->
                                            <i class="fas fa-wallet text-2xl text-[#5030E5]"></i>

                                            <!-- Titre solde -->
                                            <span class="text-base hidden md:flex text-gray-500">Solde disponible :</span>


                                            <span
                                                class="text-lg md:text-xl text-green-600">{{ number_format($soldeInvestisseur, 0, '.', ' ') }}
                                                FCFA</span>


                                        </div>
                                    </div>
                                @elseif (auth()->user()->hasRole('Startup'))
                                    <div class="flex justify-center items-center text-lg font-semibold text-gray-800">
                                        <div class="flex items-center space-x-2 bg-white py-4 md:p-4  rounded-lg w-full max-w-sm">
                                            <!-- Icône de solde -->
                                            <i class="fas fa-wallet text-2xl text-[#5030E5]"></i>

                                            <!-- Titre solde -->
                                            <span class="text-base hidden md:flex text-gray-500">Solde disponible :</span>


                                            <span
                                                class="text-green-600 text-lg md:text-xl">{{ number_format($soldeStartup, 0, '.', ' ') }}
                                                FCFA
                                            </span>


                                        </div>
                                    </div>
                                @elseif (auth()->user()->hasRole('Administrateur'))
                                    <div class="flex justify-center items-center text-lg font-semibold text-gray-800">
                                        <div class="flex items-center space-x-2 bg-white p-4 rounded-lg w-full max-w-sm">
                                            <!-- Icône de solde -->
                                            <i class="fas fa-wallet text-2xl text-[#5030E5]"></i>

                                            <!-- Titre solde -->
                                            <span class="text-base text-gray-500">Solde disponible :</span>


                                            <span
                                                class="text-xl text-green-600">{{ number_format($soldeAdmin, 0, '.', ' ') }}
                                                FCFA
                                            </span>


                                        </div>
                                    </div>
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
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#1973E2] hover:text-white w-full text-left">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>
                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white p-6 ">
                        <div class="space-y-5">

                            <div class="flex space-x-5">
                                <div class="w-full bg-white rounded-t-2xl container mx-auto md:py-8">
                                    @if (isset($header))
                                        <header class="">
                                            <div
                                                class="flex justify-between border-b-4 border-[#5030E5] pb-5 items-center mx-5">
                                                {{ $header }}
                                            </div>
                                        </header>
                                    @endif
                                    <div class="">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section PORTEFEUILLE -->
                        @if (auth()->user()->compteStartup || auth()->user()->compteInvestisseur)
                            <div x-data="{ showModal: false }" class="relative">
                                <!-- Bouton pour ouvrir la modale -->
                                <a href="javascript:void(0)" @click="showModal = true"
                                    class="fixed bottom-[30px] right-[20px] md:bottom-[50px] md:right-[60px] hover:scale-110 transition-all duration-300 ease-in-out transform bg-[#9d83fd]/80 text-[#673DF9] p-3 rounded-full shadow-2xl hover:bg-[#9d83fd] hover:border-[#673DF9] hover:border-4">
                                    <span class="iconify text-4xl" data-icon="solar:wallet-money-bold-duotone"
                                        data-inline="false"></span>
                                </a>

                                <!-- Modale -->
                                <div x-show="showModal" x-transition x-cloak
                                    class="fixed inset-x-0 lg:left-64 bottom-0 z-50 bg-white shadow-lg border ">
                                    <!-- En-tête de la modale -->
                                    <div class="flex items-center justify-between xl:px-10 md:px-8 px-2 py-3 border-b">
                                        <h2 class="text-lg xl:text-[21px] font-semibold">Mon portefeuille</h2>
                                        <button @click="showModal = false" class="text-gray-500 hover:text-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Contenu de la modale -->
                                    <div class="px-2 md:px-8 xl:px-10 flex w-full items-center justify-between  py-4">
                                        <div>
                                            <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total remboursé</p>
                                            <p class="text-[14px] text-blue-900 md:text-[16px] xl:text-2xl">2 000 000 Fcfa</p>
                                        </div>
                                        <span class="iconify  text-gray-800  text-md md:text-2xl xl:text-4xl" data-icon="ic:round-minus"
                                            data-inline="false"></span>
                                        <div>
                                            <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total investis</p>
                                            <p class="text-[14px] md:text-[16px] xl:text-2xl">10 000 000 Fcfa</p>
                                        </div>
                                        <span class="iconify text-gray-800 text-md md:text-2xl xl:text-4xl" data-icon="material-symbols:equal-rounded"
                                            data-inline="false"></span>
                                        <div>
                                            <p class="text-gray-600 text-[12px] md:text-[14px] xl:text-xl">Total bénéfice gain/perte</p>
                                            <p class="{{ 800000 >= 0 ? 'text-green-500' : 'text-red-500 ' }} text-[14px] font-bold md:text-[16px] xl:text-2xl">8 000 000 Fcfa</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- FIN Section PORTEFEUILLE -->
                    </main>
                </div>
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
    @filamentScripts
    @vite('resources/js/app.js')
    <!-- Script JavaScript -->
    <script>
        let idleTime = 0;
        const maxIdleTime = 120 * 60 * 1000; // 120 minutes

        function resetIdleTime() {
            idleTime = 0;
        }

        document.onmousemove = resetIdleTime;
        document.onkeypress = resetIdleTime;

        setInterval(() => {
            idleTime += 1000;
            if (idleTime >= maxIdleTime) {
                alert('Votre session a expiré. Vous allez être redirigé.');
                window.location.href = '/login';
            }
        }, 1000);
    </script>
</body>

</html>