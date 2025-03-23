<div class="flex justify-between border-b border-gray-700 bg-gray">
    @auth
        <div class=" py-4 items-center flex">
            <a class="pr-2 underline" href="{{ route('deposit') }}">Deposit</a>
            <a class="px-2 underline" href="{{ route('payout') }}">Payout</a>
            <a class="px-2 underline" href="{{ route('support') }}">Support</a>
        </div>
        <div class=" flex p-4 items-center gap-2">
            <p>{{ Str::of(Auth::user()->name)->before(' ')  }}</p>
            <x-heroicon-s-bell-alert class="w-6 h-6" />
            <p class="bg-green-600 p-2 rounded-md">${{ Auth::user()->balance ?? "0.00"}}</p>
            <a href="{{ route('profile.edit') }}">
                @if(Auth::user()->profile_photo && file_exists(storage_path('app/public/' . Auth::user()->profile_photo)))
                    <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
                @else
                    <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]" src="{{ asset('assets/avatar.png') }}" alt="Avatar">
                @endif
            </a> 
        </div>
    @else 
        <div class="flex items-center gap-3 py-4 ">
            <a class="py-2 flex" href="/"><x-heroicon-s-home class="w-6 h-6 text-gray-300"/>Home</a>
        </div>
        <div class=" flex p-4 items-center gap-3">
            <a class="py-2 flex" href="/login"><x-heroicon-s-arrow-right-end-on-rectangle class="w-6 h-6 text-gray-300"/>Login</a>
            <a class="py-2 flex" href="/register"><x-heroicon-s-clipboard-document-list class="w-6 h-6 text-gray-300"/>Register</a>
        </div>
    @endauth
</div>