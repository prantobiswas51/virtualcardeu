<div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-full">
    <!-- Ticket List (Left Column) -->
    <div class=" rounded p-4 shadow overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">My Tickets</h3>
        @foreach ($tickets as $ticket)
            <div wire:click="selectTicket({{ $ticket->id }})"
                 class="p-2 mb-2 rounded cursor-pointer
                        {{ $selectedTicket && $ticket->id === $selectedTicket->id ? 'bg-blue-400 font-semibold' : 'hover:bg-gray-500' }}">
                <div>{{ $ticket->subject }}</div>
                <div class="text-xs text-gray-500">{{ $ticket->status }}</div>
            </div>
        @endforeach
    </div>

    <!-- Chat (Right Column, spans 2 cols) -->
    <div class="md:col-span-2  rounded p-4 shadow flex flex-col">
        @if ($selectedTicket)
            <h3 class="text-lg font-bold mb-2">{{ $selectedTicket->subject }}</h3>

            <div class="flex-1 overflow-y-auto space-y-3 mb-4 max-h-96">
                @foreach ($selectedTicket->messages as $msg)
                    <div class="p-3 rounded {{ $msg->user_id == Auth::id() ? 'bg-blue-400 text-right' : 'bg-gray-400' }}">
                        <p class="text-sm">{{ $msg->message }}</p>
                        <small class="text-gray-500">{{ $msg->user->name }} • {{ $msg->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>

            <form wire:submit.prevent="sendMessage" class="flex gap-2">
                <textarea wire:model.defer="message"
                          class="w-full border p-2 rounded" rows="2"
                          placeholder="Type your message..."></textarea>
                <button type="submit" class="bg-blue-600  px-4 py-2 rounded">Send</button>
            </form>
        @else
            <p>Select a ticket to view conversation.</p>
        @endif
    </div>
</div>
