<div class="nav flex justify-between border-b border-gray-700 bg-gray">
    @auth
        <div class=" py-4 items-center flex">
            <a class="py-2 pr-2 underline" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="px-2 underline" href="{{ route('deposit') }}">Deposit</a>
            <a class="px-2 underline" href="{{ route('payout') }}">Payout</a>
            <a class="px-2 underline" href="">Support Ticket</a>
        </div>
        <div class=" flex p-4 items-center gap-2">
            <p>{{ Str::of(Auth::user()->name)->before(' ')  }}</p>
            <x-heroicon-s-bell-alert class="w-6 h-6" />
            <p class="bg-green-600 p-2 rounded-md">${{ Auth::user()->balance ?? "0.00"}}</p>
            <a href="{{ route('profile.edit') }}"><img class="rounded-[50%] w-10 h-10 bg-blue-600" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt=""></a> 
            
        </div>
    @else 
        <div class=" py-4 items-center flex gap-3">
            <a class="py-2 flex" href="/"><x-heroicon-s-home class="w-6 h-6 text-gray-300"/>Home</a>
            <a class="py-2 flex" href="/login"><x-heroicon-s-arrow-right-end-on-rectangle class="w-6 h-6 text-gray-300"/>Login</a>
            <a class="py-2 flex" href="/register"><x-heroicon-s-clipboard-document-list class="w-6 h-6 text-gray-300"/>Register</a>
        </div>
    @endauth
</div>