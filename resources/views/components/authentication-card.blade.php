<div class="min-h-screen w-full flex sm:justify-center items-center pt-6 sm:pt-0 bg-gray-200">

    <div class="flex bg-white relative z-20 h-[400px] w-full md:w-auto shadow-lg overflow-hidden rounded-l-lg pt-4 flex-col items-center justify-center">
        <div class="">
            {{ $logo }}
        </div>

        <div class="w-full h-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-l-lg">
            {{ $slot }}
        </div>
    </div>
    <div class="bg-black z-20 relative md:flex hidden rounded-r-lg shadow-lg overflow-hidden">
        <img class="h-[400px] rounded-r-lg" src="asset/image.png" alt="image1">
    </div>
    <div class="absolute z-0 flex ">
        <img class="w-full lg:w-[450px]" src="asset/arrow.png" alt="image1">
        <img class="w-[450px] hidden lg:flex" src="asset/arrow.png" alt="image1">
    </div>
</div>