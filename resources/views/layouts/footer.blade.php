<div class="footer bg-gray-800 fixed w-full bottom-0 mt-[200px] text-[12px] sm:text-[16px]">
    <div class="text-white max-w-3xl w-full mx-auto flex justify-between py-4 px-4">

        <div class="nav1 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <a href="{{ route('dashboard') }}" class="flex flex-col justify-center items-center">
                <x-heroicon-s-rectangle-group class="w-4 h-4 sm:w-6 sm:h-6" />
                <p>Dashboard</p>
            </a>
        </div>

        <div class="nav2 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <a href="{{ route('cards') }}" class="flex flex-col justify-center items-center">
                <x-heroicon-s-credit-card class="w-4 h-4 sm:w-6 sm:h-6" />
                <p>My Cards</p>
            </a>
        </div>

        <div class="nav3 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <a href="{{ route('banks') }}" class="flex flex-col justify-center items-center">
                <x-heroicon-s-banknotes class="w-4 h-4 sm:w-6 sm:h-6" />
                <p>My Banks</p>
            </a>
        </div>

        <div class="nav4 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <a href="{{ route('settings') }}" class="flex flex-col justify-center items-center">
                <x-heroicon-s-cog-6-tooth class="w-4 h-4 sm:w-6 sm:h-6" />
                <p>Settings</p>
            </a>
        </div>

        <div class="nav5 text-center  hover:text-sky-500 hover:cursor-pointer">
            <a href="{{ route('force_logout') }}" class="flex flex-col justify-center items-center">
                <x-heroicon-s-arrow-right-start-on-rectangle class="w-4 h-4 sm:w-6 sm:h-6" />
                <p>Logout</p>
            </a>
        </div>

    </div>
</div>