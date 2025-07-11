<div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-full">

    <head>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>

    <!-- Ticket List (Left Column) -->
    <div class="rounded p-2 shadow overflow-y-auto border bg-gray-900 ">
        <h3 class="text-lg font-bold mb-4">My Tickets</h3>
        @foreach ($tickets as $ticket)
            <div wire:click="selectTicket({{ $ticket->id }})"
                class="p-3 mb-2 rounded-md cursor-pointer transition-all
                    {{ $selectedTicket && $ticket->id === $selectedTicket->id
                        ? 'bg-blue-700 font-semibold'
                        : 'bg-gray-800 hover:bg-gray-700' }}">
                <div class="flex justify-between">
                    <div class="">{{ $ticket->subject }}</div>
                    <div class="">#{{ $ticket->id }}</div>
                </div>
                <div class="text-xs text-gray-400">{{ $ticket->status }}</div>
            </div>
        @endforeach
    </div>

    <!-- Chat (Right Column) -->
    <div class="md:col-span-2 rounded shadow flex flex-col border ">
        @if ($selectedTicket)
            <!-- Chat Header -->
            <div class="p-4 border-b ">
                <h3 class="text-lg font-bold">{{ $selectedTicket->subject }}</h3>
            </div>

            <!-- Messages Area -->
            <div class="flex-1 overflow-y-auto p-4 space-y-3  max-h-[60vh]">
                @foreach ($selectedTicket->messages as $msg)
                    <div class="flex {{ $msg->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="max-w-[75%] p-3 rounded-lg shadow
                            {{ $msg->user_id == Auth::id() ? 'bg-blue-600 ' : ' border' }}">
                            <p class="text-sm">{{ $msg->message }}</p>
                            <small class="text-xs {{ $msg->user_id != Auth::id() ? 'text-gray-500' : '' }}">
                                {{ $msg->user_id == Auth::id() ? 'You' : 'Admin' }} •
                                {{ $msg->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <form wire:submit.prevent="sendMessage" class="flex items-center text-gray-500 p-4 border-t gap-2">
                <textarea wire:model.defer="message" class="w-full border p-2 rounded-lg resize-none" rows="2" placeholder="Type your message..."></textarea>
                <button type="submit" class="bg-blue-600 border text-gray-800 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Send
                </button>
            </form>
        @else
            <div class="p-6 text-gray-500">
                <p>Select a ticket from the left to view the conversation.</p>
            </div>
        @endif
    </div>
</div>
