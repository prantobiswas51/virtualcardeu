<x-app-layout>
    <div class="m-6  bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class=" font-semibold text-gray-800">Notifications</h1>
            <button id="markAllAsReadBtn" class="text-sm text-blue-600 hover:underline">Mark all as read</button>
        </div>

        <!-- Example notification item -->
        <div class="space-y-2">
            <!-- Loop this block for each notification -->

            @foreach ($notifications as $notification)
            <div
                class="p-2 pl-4 border rounded-lg shadow-sm flex justify-between items-start {{ $notification->read ? 'bg-white border-gray-200' : 'bg-blue-50 border-blue-100' }}">
                <div>
                    <p class="text-gray-800 text-sm">
                        {{ $notification->content }}
                    </p>
                </div>
                <div class="flex items-center">

                    @if ($notification->read == true)
                    <i class="fa-solid fa-envelope-open ml-2 fa-lg"></i>
                    @else
                    <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">New</span>
                    <i class="fa-solid fa-envelope ml-2 fa-lg"></i>
                    @endif
                    <p class="text-sm text-gray-500 ml-2">2 hours ago</p>
                </div>
            </div>
            @endforeach

            <!-- End loop -->
        </div>
    </div>


    <script>
        document.getElementById('markAllAsReadBtn').addEventListener('click', function() {
            if (confirm('Are you sure you want to mark all notifications as read?')) {
                fetch('{{ route('notifications_mark_all_asRead') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notificationDivs = document.querySelectorAll('.space-y-2 > div');
                        notificationDivs.forEach(div => {
                            div.classList.remove('bg-blue-50', 'border-blue-100');
                            div.classList.add('bg-white', 'border-gray-200');
                            const newBadge = div.querySelector('.bg-blue-500');
                            if (newBadge) {
                                newBadge.remove();
                            }
                            const unreadIcon = div.querySelector('.fa-envelope');
                            if (unreadIcon) {
                                unreadIcon.classList.remove('fa-envelope');
                                unreadIcon.classList.add('fa-envelope-open');
                            }
                        });
                        alert('All notifications marked as read!');
                    } else {
                        alert('Failed to mark notifications as read.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while marking notifications as read.');
                });
            }
        });
    </script>
   
</x-app-layout>