<div class="footer bg-gray-800 fixed w-full bottom-0 mt-[200px]">
    <div class="text-white max-w-[800px] mx-auto flex justify-between py-4">

        <div class="nav1 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <x-heroicon-s-rectangle-group class="w-6 h-6 " />
            <p>Dashboard</p>
        </div>

        <div class="nav2 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <x-heroicon-s-credit-card class="w-6 h-6 " />
            <p>My Cards</p>
        </div>

        <div class="nav1 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <x-heroicon-s-banknotes class="w-6 h-6 " />
            <p>My Banks</p>
        </div>

        <div class="nav1 text-center flex flex-col items-center hover:text-sky-500 hover:cursor-pointer">
            <x-heroicon-s-cog-6-tooth class="w-6 h-6" />
            <p>Settings</p>
        </div>

        <div class="nav1 text-center  hover:text-sky-500 hover:cursor-pointer">
            <a href="{{ route('force_logout') }}" class="flex flex-col justify-center items-center">
                <x-heroicon-s-arrow-right-start-on-rectangle class="w-6 h-6" />
                <p>Logout</p>
            </a>
        </div>

    </div>
</div>