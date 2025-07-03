<x-app-layout>
    <div class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Submit a Support Ticket</h1>
                <p class="text-gray-600 mt-1">Need help? Fill out the form below and our team will get back to you.</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-4 text-red-600">{{ session('error') }}</div>
                @endif

                <form action="{{ route('create_ticket') }}" method="POST" class="space-y-5">
                    @csrf


                    <div>
                        <label for="number" class="block font-medium text-sm text-gray-700">Phone Number
                            (Optional)</label>
                        <input type="text" name="number" id="number"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            value="{{ old('number') }}">
                    </div>

                    <div>
                        <label for="subject" class="block font-medium text-sm text-gray-700">Subject</label>
                        <input type="text" name="subject" id="subject"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            required value="{{ old('subject') }}">
                    </div>

                    <div>
                        <label for="message" class="block font-medium text-sm text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="5"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>{{ old('message') }}</textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-secondary transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Submit Ticket
                        </button>
                    </div>

                    <p class="text-sm text-gray-500 text-center">
                        Our team typically responds within 24–48 hours.
                    </p>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-sm mt-4 p-4">
                <h2 class="text-lg font-bold">List of Tickets</h2>

                <div class="overflow-x-auto border rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left font-semibold">Name</th>
                                <th class="px-4 py-2 text-left font-semibold">Subject</th>
                                <th class="px-4 py-2 text-left font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($tickets as $ticket)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ Auth::user()->name }}</td>
                                    
                                    <td class="px-4 py-2">
                                        <a href="{{ route('view_ticket', ['id' => $ticket->id]) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $ticket->subject }}
                                        </a>
                                    </td>

                                    <td class="px-4 py-2">
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-medium rounded-full {{ $ticket->status === 'Open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">
                                        No tickets found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
