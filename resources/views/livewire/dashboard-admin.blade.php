<div class="grid grid-cols-1 md:grid-cols-4 gap-5 justify-center" wire:poll.5s>
    <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-center">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-[#FEC604] dark:text-white">
            {{ $utilisateurs }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Utilisateur(s)</p>
    </div>
    <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-center">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-[#17A3F1] dark:text-white">
            {{ $compteStatup }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Compte(s) Startup</p>
    </div>
    <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-center">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-[#E93AE0] dark:text-white">
            {{ $compteInvestisseur }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Compte(s) Investisseur</p>
    </div>
    <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-center">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $attenteRetrait }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Attente(s) de retrait</p>
    </div>
</div>
