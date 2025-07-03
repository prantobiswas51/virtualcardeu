<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">{{ $ticket->subject }}</h2>

            <div class="space-y-4">
                @foreach ($ticket->messages as $msg)
                    <div class="flex items-start space-x-3 bg-gray-50 p-4 rounded-md border">
                        <div class="flex-shrink-0">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-semibold text-blue-700">
                                {{ strtoupper(substr($msg->user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between">
                                <div class="text-sm text-gray-700 font-semibold">{{ $msg->user->name }}</div>
                                <div class="text-sm text-gray-500 mb-1">{{ $msg->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="text-gray-800">{{ $msg->message }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('ticket_reply', $ticket->id) }}" class="mt-6">
                @csrf
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Reply</label>
                <textarea name="message" id="message"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                    rows="4" required></textarea>
                <button type="submit"
                    class="mt-3 inline-block bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                    Reply
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
