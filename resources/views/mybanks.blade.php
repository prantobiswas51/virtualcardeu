<x-app-layout>

    <div id="account-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-90vh overflow-y-auto">
            <div class="p-6 border-b border-gray-200">

                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Account Details</h2>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

            </div>
            <div id="account-details" class="p-6">
                <div class="text-center p-4">Loading bank details...</div>
            </div>
        </div>
    </div>

    <div id="transfer_modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-90vh overflow-y-auto">

            <div class="flex justify-between items-center p-4">
                <h2 class="text-xl font-bold text-gray-800">Transfer Bank Balance</h2>
                <button id="close_bank_modal" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('transfer_bank_balance') }}" method="POST"
                class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-md mx-auto">
                @csrf
                <label for="transfer-amount" class="sr-only">Enter amount to transfer</label>

                <input type="hidden" name="bank_id" id="transfer_bank_id">

                <input type="text" value="" name="bank_balance" class="w-full p-3 mb-4 text-gray-800 border border-gray-300 rounded-lg 
                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="Enter amount to transfer..." aria-label="Amount to transfer">


                <button type="submit"
                    class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-200">
                    Request Transfer
                </button>


            </form>

        </div>
    </div>


    <div class="flex-1 p-4 md:p-6 pb-20 md:pb-6">

        <div class="max-w-4xl mx-auto">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    
                    <div class="">
                        <h1 class="text-2xl font-bold text-gray-900">Order Virtual Card</h1>
                        <p class="text-gray-600 mt-1">Create a virtual card for secure online transactions</p>
                    </div>

                    <a href="{{ route('order_banks') }}"
                        class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Create Account
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <div id="active-accounts" class="flex space-x-6 pb-4">
                        {{-- Loop through $my_banks here in Blade --}}
                        @if (!$my_banks->isEmpty())
                        @foreach($my_banks as $my_bank)


                        <div
                            class="min-w-[400px] md:min-w-[435px] max-w-xs flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-6 bg-gradient-to-r from-primary to-secondary text-white">

                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm opacity-80">Bank Name</p>
                                        <h3 class="text-xl font-bold">{{ $my_bank->bank_name }}</h3>
                                    </div>
                                    <span
                                        class="uppercase text-xs font-semibold bg-white bg-opacity-20 px-2 py-1 rounded">
                                        {{ $my_bank->account_type }}
                                    </span>
                                </div>

                                <div class="flex flex-row mt-4 justify-between gap-y-2">
                                    <div>
                                        <p class="text-sm opacity-80">Bank Location</p>
                                        <h3>{{ $my_bank->bank_location }}</h3>
                                    </div>
                                    <div class="font-mono">
                                        <p class="text-sm opacity-80">Bank Currency</p>
                                        <p>{{ $my_bank->currency }}</p>
                                    </div>
                                    <div class="font-mono">
                                        <p class="text-sm opacity-80">Routing Number</p>
                                        <p>{{ $my_bank->routing_number }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-row mt-4 justify-between gap-y-2">
                                    <div>
                                        <p class="text-sm opacity-80">Account Number</p>
                                        <h3 class="text-xl font-bold">{{ $my_bank->bank_account_number }}</h3>
                                    </div>
                                    @if ($my_bank->currency === "USD")
                                    <div class="">
                                        <img src="{{ asset('/assets/usd_flag.png') }}"
                                            class="rounded-[50px] max-h-12 max-w-12" alt="">
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 bg-white">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Available Balance</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ $my_bank->currency_symbol }} {{ number_format($my_bank->bank_balance, 2)
                                            }}
                                        </p>
                                    </div>
                                    <div>
                                        @if ($my_bank->status === "Active")
                                        <span
                                            class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> {{ ucfirst($my_bank->status) }}
                                        </span>
                                        @else
                                        <span
                                            class="inline-flex px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-check-circle mr-1"></i> {{ ucfirst($my_bank->status) }}
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="flex justify-between">
                                    <button onclick="request_bank_transfer({{ $my_bank->id }})"
                                        class="text-white hover:bg-blue-600 text-sm bg-primary p-2 rounded-md">
                                        <i class="fa-solid fa-arrow-right"></i> Transfer Balance
                                    </button>

                                    <button class="view-details text-primary hover:text-secondary text-sm"
                                        data-id="{{ $my_bank->id }}">
                                        <i class="fas fa-eye mr-1"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </div>


                        @endforeach
                        @else
                        <p class="text-red-500">You have no Bank</p>
                        @endif
                    </div>
                </div>


                <!-- Card Transactions -->
                <div class="bg-white rounded-lg shadow-sm my-6">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Bank Transactions</h2>

                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Merchant</th>
                                    <th scope="col" class="px-4 py-3 w-[20px]">Date</th>
                                    <th scope="col" class="px-4 py-3">Bank Number</th>
                                    <th scope="col" class="px-4 py-3 text-right">Amount</th>
                                    <th scope="col" class="px-4 py-3 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($transactions as $transaction)
                                <tr class="border-b text-xs hover:bg-gray-50">
                                    <td class="px-4 py-3  text-gray-900">{{ $transaction->id }}</td>
                                    <td class="px-4 py-3  text-gray-900">{{ $transaction->merchant }}</td>
                                    <td class="px-4 py-3 w-40  whitespace-nowrap">
                                        {{ $transaction->created_at->format('d M Y, h:i A') }}
                                    </td>

                                    <td class="px-4 py-3">...{{ substr($transaction->bank->bank_account_number, -3) }}</td>

                                    <td class="px-4 py-3 text-right text-red-600 ">${{ $transaction->amount }} </td>
                                    <td class="px-4 py-3 text-right">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $transaction->status }}</span>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t">
                        <a href="{{ route('activity') }}" class="text-primary text-sm hover:underline">View all
                            transactions</a>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const accountModal = document.getElementById('account-modal');
            const closeModalButton = document.getElementById('close-modal');
            const accountDetailsDiv = document.getElementById('account-details');
            const viewDetailsButtons = document.querySelectorAll('.view-details');

           viewDetailsButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bankId = this.dataset.id; // Get the bank ID from the data-id attribute
                    accountDetailsDiv.innerHTML = '<div class="text-center p-4">Loading bank details...</div>'; // Show loading message
                    accountModal.style.display = 'flex'; // Show the modal

                    // Make an AJAX request to fetch bank details
                    fetch(`/my-banks/${bankId}`) // Adjust this URL to your Laravel route
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(bank => {
                            // Populate the modal with the fetched bank details
                            accountDetailsDiv.innerHTML = `
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Bank Name</p>
                                        <p class="font-semibold">${bank.bank_name}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Account Type</p>
                                        <p class="font-semibold">${bank.account_type}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Bank Location</p>
                                        <p class="font-semibold">${bank.bank_location}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Currency</p>
                                        <p class="font-semibold">${bank.currency}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Routing Number</p>
                                        <p class="font-semibold">${bank.routing_number}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Account Number</p>
                                        <p class="font-semibold">${bank.bank_account_number}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Available Balance</p>
                                        <p class="text-lg font-bold">${parseFloat(bank.bank_balance).toFixed(2)}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Status</p>
                                        <span class="inline-flex px-2 py-1 text-xs rounded-full ${bank.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                            <i class="fas fa-check-circle mr-1"></i> ${bank.status.charAt(0).toUpperCase() + bank.status.slice(1)}
                                        </span>
                                    </div>
                                    ${bank.account_holder_name ? `
                                        <div>
                                            <p class="text-sm text-gray-500">Account Holder Name</p>
                                            <p class="font-semibold">${bank.account_holder_name}</p>
                                        </div>
                                    ` : ''}
                                    ${bank.swift_code ? `
                                        <div>
                                            <p class="text-sm text-gray-500">SWIFT Code</p>
                                            <p class="font-semibold">${bank.swift_code}</p>
                                        </div>
                                    ` : ''}
                                    ${bank.iban ? `
                                        <div>
                                            <p class="text-sm text-gray-500">IBAN</p>
                                            <p class="font-semibold">${bank.iban}</p>
                                        </div>
                                    ` : ''}
                                    ${bank.opened_at ? `
                                        <div>
                                            <p class="text-sm text-gray-500">Opened On</p>
                                            <p class="font-semibold">${new Date(bank.opened_at).toLocaleDateString()}</p>
                                        </div>
                                    ` : ''}
                                    ${bank.bank_address ? `
                                        <div>
                                            <p class="text-sm text-gray-500">Bank Address</p>
                                            <p class="font-semibold">${bank.bank_address}</p>
                                        </div>
                                    ` : ''}
                                    ${bank.email_address ? `
                                        <div>
                                            <p class="text-sm text-gray-500">Email Address</p>
                                            <p class="font-semibold">${bank.email_address}</p>
                                        </div>
                                    ` : ''}
                                </div>
                            `;
                        })
                        .catch(error => {
                            console.error('Error fetching bank details:', error);
                            accountDetailsDiv.innerHTML = '<div class="text-center p-4 text-red-600">Error loading details. Please try again.</div>';
                        });
                });
            });

            closeModalButton.addEventListener('click', function () {
                accountModal.style.display = 'none'; // Hide the modal
            });

            // Optional: Close modal when clicking outside of it
            accountModal.addEventListener('click', function(event) {
                if (event.target === accountModal) {
                    accountModal.style.display = 'none';
                }
            });
        });

        function request_bank_transfer(bankId) {
            const transfer_modal = document.getElementById('transfer_modal');
            const close_bank_modal = document.getElementById('close_bank_modal');
            const transfer_bank_id_input = document.getElementById('transfer_bank_id'); // Get the hidden input

            // Set the value of the hidden input field
            transfer_bank_id_input.value = bankId;

            transfer_modal.style.display = "flex";

            close_bank_modal.addEventListener('click', function () {
                transfer_modal.style.display = 'none';
                transfer_bank_id_input.value = ''; // Clear the value when closing the modal
            });

            // Optional: Close modal if clicking outside
            transfer_modal.addEventListener('click', function (event) {
                if (event.target === transfer_modal) {
                    transfer_modal.style.display = 'none';
                    transfer_bank_id_input.value = ''; // Clear the value when closing
                }
            });
        }

        // new modal
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#transfer_modal form');
            const amountInput = form.querySelector('input[name="bank_balance"]');
            const bankIdInput = form.querySelector('#transfer_bank_id');

            form.addEventListener('submit', function (e) {
                const enteredAmount = parseFloat(amountInput.value);
                const bank = @json($my_banks); // all banks

                const selectedBank = bank.find(b => b.id == bankIdInput.value);

                if (!selectedBank) {
                    alert('Invalid bank selected.');
                    e.preventDefault();
                    return;
                }

                if (isNaN(enteredAmount) || enteredAmount <= 0) {
                    alert('Enter a valid transfer amount.');
                    e.preventDefault();
                    return;
                }

                if (enteredAmount > parseFloat(selectedBank.bank_balance)) {
                    alert('Not enough balance');
                    e.preventDefault();
                }
            });
        });

    </script>
</x-app-layout>