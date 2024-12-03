<div class="grid grid-cols-1 md:grid-cols-4 gap-5 justify-center mt-24" wire:poll.5s>
    <div
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-[#FEC604] dark:text-white">
            <svg class="w-12 h-12 stroke-yellow-400" viewBox="0 0 48 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M28.62 16.5L40.1 36.38M19.38 16.5H42.34M14.76 24.5L26.24 4.62M19.38 32.5L7.9 12.62M28.62 32.5H5.66M33.24 24.5L21.76 44.38M44 24.5C44 35.5457 35.0457 44.5 24 44.5C12.9543 44.5 4 35.5457 4 24.5C4 13.4543 12.9543 4.5 24 4.5C35.0457 4.5 44 13.4543 44 24.5Z" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
              {{ $utilisateurs }}
            </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400 ">Utilisateurs</p>
    </div>
    <div
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-[#17A3F1] dark:text-white">
            <svg class="w-12 h-12 stroke-sky-500" viewBox="0 0 48 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M40 42.5V38.5C40 36.3783 39.1571 34.3434 37.6569 32.8431C36.1566 31.3429 34.1217 30.5 32 30.5H16C13.8783 30.5 11.8434 31.3429 10.3431 32.8431C8.84285 34.3434 8 36.3783 8 38.5V42.5M32 14.5C32 18.9183 28.4183 22.5 24 22.5C19.5817 22.5 16 18.9183 16 14.5C16 10.0817 19.5817 6.5 24 6.5C28.4183 6.5 32 10.0817 32 14.5Z" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
              {{ $compteStatup }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Comptes Startup</p>
    </div>
    <div
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-[#E93AE0] dark:text-white">
            <svg class="w-12 h-12 stroke-pink-500" viewBox="0 0 48 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.54 14.4198L24 24.5198L41.46 14.4198M24 44.6598V24.4998M42 32.4998V16.4998C41.9993 15.7984 41.8141 15.1094 41.4631 14.5021C41.112 13.8948 40.6075 13.3905 40 13.0398L26 5.0398C25.3919 4.68873 24.7021 4.50391 24 4.50391C23.2979 4.50391 22.6081 4.68873 22 5.0398L8 13.0398C7.39253 13.3905 6.88796 13.8948 6.53692 14.5021C6.18589 15.1094 6.00072 15.7984 6 16.4998V32.4998C6.00072 33.2013 6.18589 33.8902 6.53692 34.4975C6.88796 35.1048 7.39253 35.6091 8 35.9598L22 43.9598C22.6081 44.3109 23.2979 44.4957 24 44.4957C24.7021 44.4957 25.3919 44.3109 26 43.9598L40 35.9598C40.6075 35.6091 41.112 35.1048 41.4631 34.4975C41.8141 33.8902 41.9993 33.2013 42 32.4998Z" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
              
            {{ $compteInvestisseur }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Comptes Investisseurs</p>
    </div>
    <div
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white">
            <svg class="w-12 h-12 stroke-green-500" viewBox="0 0 48 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24 2.5V46.5M34 10.5H19C17.1435 10.5 15.363 11.2375 14.0503 12.5503C12.7375 13.863 12 15.6435 12 17.5C12 19.3565 12.7375 21.137 14.0503 22.4497C15.363 23.7625 17.1435 24.5 19 24.5H29C30.8565 24.5 32.637 25.2375 33.9497 26.5503C35.2625 27.863 36 29.6435 36 31.5C36 33.3565 35.2625 35.137 33.9497 36.4497C32.637 37.7625 30.8565 38.5 29 38.5H12" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
              {{ $attenteRetrait }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Attentes de retrait</p>
    </div>
</div>
