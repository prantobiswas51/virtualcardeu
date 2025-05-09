
<header class="bg-sky-100 shadow-sm" id="nav_header">
   <div class=" mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
         <div class="flex items-center">
            <a href="#" class="flex-shrink-0 flex items-center">
               <span class="text-2xl font-bold text-primary">VirtualCardEU</span>
            </a>
         </div>

         <div class="flex items-center">

            @auth
            <div class="hidden md:ml-6 md:flex md:items-center md:space-x-6">

               {{-- Notification --}}
               <a href="{{ route('notifications') }}" class="text-gray-800 hover:text-primary px-3 py-2 text-sm font-medium">
                  <i class="fas fa-lg fa-bell"></i>
               </a>

               {{-- settings --}}
               <a href="{{ route('settings') }}" class="flex flex-col justify-center items-center">
                  <x-heroicon-s-cog-6-tooth class="w-4 h-4 sm:w-6 sm:h-6" />
               </a>

               {{-- Logout --}}
               <a href="{{ route('force_logout') }}"
                  class="text-gray-800 hover:text-primary px-3 py-2 text-sm font-medium">
                  <i class="fas fa-lg fa-sign-out-alt"></i>
               </a>

            </div>

            <div class="bg-sky-300 p-2 px-4 rounded-[50px]">${{ Auth::user()->balance }}</div>

            <div class="ml-4 flex items-center md:ml-6">
               <div class="relative">

                  <button class="max-w-xs rounded-full flex items-center text-sm focus:outline-none">
                     <span class="sr-only">Open user menu</span>
                     <a href="{{ route('profile.edit') }}">

                        @if(Auth::user()->profile_photo && file_exists(storage_path('app/public/' .
                        Auth::user()->profile_photo)))
                        <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]"
                           src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
                        @else
                        <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]"
                           src="{{ asset('assets/avatar.png') }}" alt="Avatar">
                        @endif

                     </a>
                  </button>

               </div>
            </div>
            @else
            <div class=" flex p-4 items-center gap-3">
               <a class="py-2 flex" href="/login">
                  <x-heroicon-s-arrow-right-end-on-rectangle class="w-6 h-6 text-gray-800" />Login
               </a>
               <a class="py-2 flex" href="/register">
                  <x-heroicon-s-clipboard-document-list class="w-6 h-6 text-gray-800" />Register
               </a>
            </div>
            @endauth
         </div>
      </div>
   </div>
</header>