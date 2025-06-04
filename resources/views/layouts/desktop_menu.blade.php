<div class="hidden md:block">

   <p class="font-bold text-primary text-3xl font-mono p-6">VirtualCardEU</p>

   <div class="h-full px-3 py-4 overflow-y-auto">
      <ul class="space-y-2">

         <li>
            <a href="{{ route('dashboard') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-home w-6"></i>
               <span class="ml-3">Dashboard</span>
            </a>
         </li>

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
               <span class="ml-3">Transactions</span>
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
            <a href="{{ route('support') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('support') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-phone w-6"></i>
               <span class="ml-3">Support</span>
            </a>
         </li>

         <li>
            <a href="{{ route('notifications') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('support') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-lg fa-bell"></i>
               <span class="ml-3">Notifications</span>
            </a>
         </li>

         <li>
            <a href="{{ route('force_logout') }}"
               class="flex items-center p-3 rounded-lg {{ request()->routeIs('support') ? 'bg-blue-50 text-primary' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
               <i class="fas fa-lg fa-sign-out-alt"></i>
               <span class="ml-3">Logout</span>
            </a>
         </li>
         <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center ">

               @if(Auth::user()->profile_photo && file_exists(storage_path('app/public/' . Auth::user()->profile_photo)))
               <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]"
                  src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
               @else
               <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]" src="{{ asset('assets/avatar.png') }}"
                  alt="Avatar">
               @endif
               <div class="flex justify-between  w-full">
                  <div class="ml-2">{{ Auth::user()->name }}</div>
                  <div class="ml-2">${{ Auth::user()->balance }}</div>
               </div>
            </a>
         </li>

         @if (Auth::user()->role === 'Admin')
         <li class="" style="border-top: 1px solid black;">
            <a href="{{ route('filament.admin.pages.dashboard') }}"
               class="flex items-center p-3 rounded-lg hover:bg-blue-50 hover:text-primary">
               <i class="fa-solid fa-user-tie w-6"></i>
               <span class="ml-3">Admin</span>
            </a>
         </li>
         @endif

      </ul>

   </div>
</div>