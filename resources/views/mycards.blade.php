<x-app-layout>
    <div class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Cards</h1>
                    <p class="text-gray-600 mt-1">Manage your virtual cards</p>
                </div>
                <a href="{{ route('order_cards') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm rounded-md shadow-sm text-white bg-primary hover:bg-secondary">
                    <i class="fas fa-plus mr-2"></i> New Card
                </a>
            </div>

            {{-- list of cards --}}
            @forelse ($myCards as $myCard)
            <div class="bg-white rounded-lg my-2 p-4 flex flex-col sm:flex-row items-center gap-4">

                <!-- Card Image -->
                <div class="sm:mr-4 min-w-[120px] justify-center flex">
                    @if ($myCard->type == 'Reloadable Visa Card')
                    <img class="max-h-[40px]" src="{{ asset('assets/visa.svg') }}" alt="Card Logo">
                    @else
                    <img class="max-h-[40px]" src="{{ asset('assets/mastercard.png') }}" alt="Card Logo">
                    @endif
                </div>

                <!-- Card Details and Actions -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center w-full gap-2">

                    <!-- Card Info -->
                    <div class="flex flex-col text-center sm:text-left sm:flex-1">
                        <div class="font-medium"> {{ $myCard->type }} </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 text-sm text-gray-700 mt-1">
                            <span>{{ $myCard->number }}</span>
                            <span class="text-green-700 font-bold">${{ $myCard->amount }}</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-wrap justify-center sm:justify-end gap-2 text-sm mt-2 sm:mt-0">
                        <!-- Open Modal Button with Dynamic Card Info -->
                        <button onclick="openCardDetailsModal(
                            '{{ $myCard->id }}',
                            '{{ $myCard->type }}',
                            '{{ $myCard->number }}',
                            '{{ $myCard->amount }}',                            
                            '{{ $myCard->status }}',
                            '{{ $myCard->expiry_date }}',
                            '{{ $myCard->cvc }}',
                        )" class="bg-gray-500/20 px-4 py-2 rounded-md text-gray-500 flex items-center">
                            <i class="fa-solid fa-circle-info mr-1"></i> Details
                        </button>
                        <button class="bg-red-800/20 px-4 py-2 rounded-md text-red-800 flex items-center">
                            <i class="fa-solid fa-trash mr-1"></i> Remove
                        </button>
                    </div>

                </div>

            </div>
            @empty
            <p>No cards here</p>
            @endforelse
        </div>
    </div>


    

    <!-- Card Details Modal -->
    <div class="modal-overlay fixed inset-0 bg-gray-500 bg-opacity-50 hidden pt-[50px]" id="cardDetailsModal">

        <div class="modal-content max-h-[90vh] pb-[100px] md:pb-0  overflow-y-auto bg-white rounded-lg max-w-4xl mx-auto  ">
            <span class="close-modal absolute top-2 right-2 text-2xl cursor-pointer bg-red-600 text-white px-2 rounded-full">&times;</span>

            <div class="p-6 border-b card-details-header flex justify-between items-center">
                <h3 class="text-xl font-semibold">Card Details</h3>
                <div class="card-status py-1 px-3 rounded" id="cardStatus">Active</div>
            </div>

            {{-- Cards preview --}}
            <div class=" card-details-content grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card-details-preview flex justify-center items-center">
                    <!-- Card preview will be inserted here -->
                    <div
                        class="w-80 h-52 rounded-xl shadow-lg p-6 text-white relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-800">
                        <!-- Decorative Circles (optional, for extra flair) -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white bg-opacity-10 rounded-full"></div>
                        <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-white bg-opacity-5 rounded-full"></div>

                        <!-- Card Header -->
                        <div class="flex items-start justify-between mb-8 relative z-10">
                            <div class="font-bold text-lg tracking-wide">VISA</div>
                            <div
                                class="w-10 h-7 bg-gradient-to-br from-gray-300 to-gray-500 rounded-md relative overflow-hidden">
                                <div class="absolute top-1/2 left-0 w-full h-px bg-black bg-opacity-20"></div>
                                <div class="absolute top-0 left-1/2 w-px h-full bg-black bg-opacity-20"></div>
                            </div>
                        </div>

                        <!-- Card Number -->
                        <div class="font-mono text-xl tracking-widest mb-6 relative z-10">
                            **** **** **** ****
                        </div>

                        <!-- Card Details -->
                        <div class="flex justify-between items-end relative z-10">
                            <div>
                                <span class="block text-xs uppercase text-white text-opacity-70 mb-1">Card Holder</span>
                                <span class="font-medium text-base">{{ Auth::user()->name }} </span>
                            </div>
                            <div>
                                <span class="block text-xs uppercase text-white text-opacity-70 mb-1">Expires</span>
                                <span class="font-medium text-base">**/**</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-details-info">
                    <!-- Card Info Groups -->
                    <div class="info-group mb-4">
                        <input type="hidden" id="cardName">
                    </div>
                    <div class="info-group mb-4">
                        <label class="font-medium text-gray-400">Card Type</label>
                        <div class="info-value" id="cardType"> </div>
                    </div>
                    <div class="info-group mb-4">
                        <label class="font-medium text-gray-400">Card Number</label>
                        <div class="flex">
                            <div class="info-value" id="cardNumber"> </div>
                            <i class="fa fa-copy ml-2 hover:cursor-pointer" id="copy_card_number"> </i>
                        </div>
                    </div>
                    <div class="info-group mb-4">
                        <label class="font-medium text-gray-400">Available Balance</label>
                        <div class="info-value" id="cardBalance">$0.00</div>
                    </div>

                    <div class="info-group mb-4">
                        <label class="font-medium text-gray-400">Expiry Date</label>
                        <div class="info-value" id="expiry_date"></div>
                    </div>

                    <div class="info-group mb-4 ">
                        <label class="font-medium text-gray-400">CVC</label>
                        <div class="info-value" id="cvc"></div>
                    </div>

                    <div class="info-group mb-4">
                        <label class="font-medium text-gray-400">Card Status</label>
                        <div class="card-status-controls flex gap-2" id="cardStatusControls"></div>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto hidden" id="topUpSection">
                <h2 class="text-lg bg-gray-200 p-2 px-6 mb-4">Top Up</h2>
                <form action="{{ route('card_topup') }}" method="POST" class="max-w-xl mx-auto pb-4 px-6 md:px-0">
                    @csrf
                    <label for="">Amount to Top Up</label>
                    <!-- Hidden card_id input (will be filled dynamically by JS) -->
                    <input type="hidden" name="card_id" id="topupCardId">
                    
                    <input type="number" name="topup_amount" placeholder="$30" class="p-1 px-2 w-full border-gray-300 rounded-md"> <br>
                    <button class="p-2 border rounded-md my-2 bg-primary text-white px-4">Confirm Topup</button>
                </form>
            </div>

            <div class="max-w-4xl mx-auto">
                <h2 class="text-lg font-semibold bg-gray-200 p-4 rounded-t-md">Transactions</h2>
                <div class="overflow-x-auto bg-white shadow-md rounded-b-md ">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                    Amount</th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

 
    </div>

    <script>
        // Open modal function to dynamically populate the modal
        function openCardDetailsModal(cardId, cardType, cardNumber, balance, status, expiry_date, cvc) {

            // Populate the modal with dynamic data
            document.getElementById('topupCardId').value = cardId;
            document.getElementById('cardName').textContent = cardType;
            document.getElementById('cardType').textContent = cardType;

            document.getElementById('expiry_date').textContent = expiry_date;
            document.getElementById('cvc').textContent = cvc;

            document.getElementById('cardNumber').textContent = cardNumber;
            document.getElementById('cardBalance').textContent = `$${balance}`;

            // Show or hide top-up section based on card type
            const topUpSection = document.getElementById('topUpSection');
            if (cardType === 'Reloadable Visa Card') {
                topUpSection.classList.remove('hidden');
            } else {
                topUpSection.classList.add('hidden');
            }

            




            // Set the card status dynamically
            const cardStatusElement = document.getElementById('cardStatus');
            const cardStatusControlsElement = document.getElementById('cardStatusControls');

            // Display the card status based on the dynamic data
            cardStatusElement.textContent = status;

            // Add the correct status control buttons
            let statusButtonsHTML = '';
            if (status === 'Active') {
                statusButtonsHTML = `
                    <button class="status-btn bg-green-500 text-white py-1 px-3 rounded">Active</button>
                    <button class="status-btn bg-gray-500 text-white py-1 px-3 rounded">Inactive</button>
                    <button class="action-btn bg-red-500 text-white py-2 px-4 rounded-md flex items-center" onclick="deleteCard(${cardId})">
                        <i class="fas fa-trash mr-2"></i> Delete Card
                    </button>
                `;
            } else if (status === 'Inactive') {
                statusButtonsHTML = `
                    <button class="status-btn bg-gray-500 text-white py-1 px-3 rounded">Active</button>
                    <button class="status-btn bg-green-500 text-white py-1 px-3 rounded">Inactive</button>
                    <button class="action-btn bg-red-500 text-white py-2 px-4 rounded-md flex items-center" onclick="deleteCard(${cardId})">
                        <i class="fas fa-trash mr-2"></i> Delete Card
                    </button>
                `;
            }

            cardStatusControlsElement.innerHTML = statusButtonsHTML;

            // Fetch related transactions
            fetch(`/cards/${cardId}/transactions`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#cardDetailsModal tbody');
                    tbody.innerHTML = '';

                    if (data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="4" class="text-center py-4">No transactions found</td></tr>`;
                        return;
                    }

                    data.forEach(tx => {
                        const formattedDate = new Date(tx.created_at).toLocaleString(); // Convert to readable format

                        tbody.innerHTML += `
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800">#${tx.id}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">${formattedDate}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">$${tx.amount}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-block px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">${tx.status}</span>
                                </td>
                            </tr>
                        `;
                    });

                });

            // Show the modal
            document.getElementById('cardDetailsModal').classList.remove('hidden');
        }

        function deleteCard(cardId) {

                if (!confirm('Are you sure you want to delete this card?')) return;

                const token = document.querySelector('meta[name="csrf-token"]').content;

                // Send the delete request to the Laravel route
                fetch(`/cards/${cardId}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ card_id: cardId }) // Sending cardId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.message);
                        document.getElementById('cardDetailsModal').classList.add('hidden');
                    } else {
                        alert('Failed to delete card');
                    }
                })
                .catch(error => {
                    console.log('Error: ' + error);
                });
            }

        // Close modal when clicking close button
        document.querySelector('.close-modal').addEventListener('click', function() {
            document.getElementById('cardDetailsModal').classList.add('hidden');
        });

        // Close modal if clicked outside modal content
        window.addEventListener('click', function(event) {
            if (event.target == document.getElementById('cardDetailsModal')) {
                document.getElementById('cardDetailsModal').classList.add('hidden');
            }
        });

        // Copy to clipboard
        document.getElementById("copy_card_number").addEventListener("click", function () {
            const cardNumber = document.getElementById("cardNumber").innerText;

            if (navigator.clipboard) {
            navigator.clipboard.writeText(cardNumber)
                .then(() => {
                alert("Card number copied!");
                // Optional: Add a visual confirmation like tooltip or toast
                })
                .catch(err => {
                console.error("Copy failed:", err);
                });
            } else {
            // Fallback for older browsers
            const textarea = document.createElement("textarea");
            textarea.value = cardNumber;
            textarea.setAttribute("readonly", "");
            textarea.style.position = "absolute";
            textarea.style.left = "-9999px";
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
                console.log("Card number copied!");
            }
        });
    </script>
</x-app-layout>