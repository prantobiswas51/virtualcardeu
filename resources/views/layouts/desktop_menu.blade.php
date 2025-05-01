{{-- <div class="footer bg-gray-800 fixed w-full bottom-0 mt-[200px] text-[12px] sm:text-[16px]">
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
</div> --}}

<div class="hidden md:block w-64 bg-white shadow-md">
   <div class="h-full px-3 py-4 overflow-y-auto">
      <ul class="space-y-2">
         <li>
            <a href="{{ route('dashboard') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-home w-6"></i>
               <span class="ml-3">Dashboard</span>
            </a>
         </li>
         
         {{-- <li>
            <a href="#"
               class="flex items-center p-3 rounded-lg {{ request()->is('wallet') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-wallet w-6"></i>
               <span class="ml-3">Wallet</span>
            </a>
         </li> --}}

         <li class="{{ Request::is('cards*') ? 'text-primary' : '' }}">
            <a href="{{ route('cards') }}"
               class="flex items-center p-3 rounded-lg {{ request()->is('cards*') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
                <i class="fas fa-credit-card w-6"></i>
                <span class="ml-3">Cards</span>
            </a>
        </li>        

         <li>
            <a href="{{ route('banks') }}"
               class="flex items-center p-3 rounded-lg {{ request()->is('banks*') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-university w-6"></i>
               <span class="ml-3">Virtual Bank</span>
            </a>
         </li>
         <li>
            <a href="{{ route('activity') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('activity') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-chart-line w-6"></i>
               <span class="ml-3">Activity</span>
            </a>
         </li>
         <li>
            <a href="{{ route('deposit') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('deposit') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-arrow-down w-6"></i>
               <span class="ml-3">Deposit</span>
            </a>
         </li>
         <li>
            <a href="{{ route('payout') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('payout') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-arrow-up w-6"></i>
               <span class="ml-3">Withdraw</span>
            </a>
         </li>
         <li>
            <a href="{{ route('profile.edit') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-user w-6"></i>
               <span class="ml-3">Profile</span>
            </a>
         </li>
      </ul>

   </div>
</div>