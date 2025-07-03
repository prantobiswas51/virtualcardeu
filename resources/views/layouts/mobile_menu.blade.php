
<div class="md:hidden fixed bottom-0 left-0 right-0 bg-white shadow-md z-50">
    <div class="flex justify-between px-6 py-3">

        <a href="{{ route('dashboard') }}"
            class="text-gray-600 hover:text-primary flex flex-col items-center justify-center">
            <i class="fa-solid fa-id-card-clip text-lg"></i>
            <span class="text-xs mt-1">Dashboard</span>
        </a>

        <a href="{{ route('cards') }}" class="text-gray-600 hover:text-primary flex flex-col items-center justify-center">
            <i class="fa-solid fa-credit-card text-lg"></i>
            <span class="text-xs mt-1">Cards</span>
        </a>

        <a href="{{ route('activity') }}"
            class="text-gray-600 hover:text-primary flex flex-col items-center justify-center">
            <i class="fas fa-chart-line text-lg"></i>
            <span class="text-xs mt-1">Activity</span>
        </a>

        <a href="{{ route('force_logout') }}"
            class="text-gray-600 hover:text-primary flex flex-col items-center justify-center">
            <i class="fas text-lg fa-sign-out-alt"></i>
            <span class="text-xs mt-1">Logout</span>
        </a>

    </div>
</div>
