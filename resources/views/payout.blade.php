<x-app-layout>
     
    <div class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Withdraw Funds</h1>
                <p class="text-gray-600 mt-1">Transfer money from your DigiWallet account</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Withdrawal Methods</h2>
                </div>

                <!-- Withdrawal Info -->
                <div class="bg-primary/10 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-5 w-5 text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-primary">Available Balance</h3>
                            <div class="mt-1 text-sm text-gray-700">
                                <p>You have $<span class="font-semibold">{{ Auth::user()->balance }}</span> available for withdrawal</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Withdrawal Methods Selection -->
                <div class="mb-6">
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full">
                            <div class="relative">
                                <div class="border-b border-gray-200">
                                    Choose withdrawl method
                                    <nav class="flex -mb-px space-x-6 overflow-x-auto">

                                        {{-- Top Buttons --}}
                                        
                                        <button id="paypalBtn" class="payment_method py-3 px-1 border-b border-gray-300 font-medium text-sm text-black" onclick="selectPaymentMethod(this, 'paypal')">
                                            PayPal
                                        </button>
                                        <button class="payment_method py-3 px-1 border-b border-gray-300 font-medium text-sm text-black" onclick="selectPaymentMethod(this, 'crypto')">
                                            Cryptocurrency
                                        </button>                                        

                                    </nav>

                                    <input type="hidden" id="selected_method" value="">

                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- PayPal Withdrawal Form -->
                    <div class="w-full my-4 mt-6 " id="paypal_login_button">
                        @if (Auth::user()->paypal_email)

                        <form class="space-y-6" id="withdrawal-form" method="POST" action="{{ route('paypal_payout') }}">
                            @csrf
                            <div>
                                <label for="paypal-email" class="block text-sm font-medium text-gray-700 mb-1">PayPal Email Address</label>

                                {{-- paypal email input --}}
                                <input type="email" value="{{ Auth::user()->paypal_email }}" id="paypal-email" name="paypal_email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>

                                <p class="text-red-600">Go to <a href="{{ route('profile.edit') }}" class="underline">Profile</a> to change and save paypal email or you can directly edit it here.</p>
                            </div>

                            <div>
                                <label for="withdraw-amount" class="block text-sm font-medium text-gray-700 mb-1">Amount to Withdraw (USD)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>

                                    {{-- paypal email input --}}
                                    <input type="number" name="total_amount" id="withdraw-amount" class="focus:ring-primary focus:border-primary block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md py-3" placeholder="0.00" required>

                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">USD</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Fee Information -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-md font-medium text-gray-900 mb-2">Transaction Summary</h3>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex justify-between">
                                        <span>Withdrawal Amount</span>
                                        <span id="summary-amount" class="font-medium">$0.00</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span id="summary-fee-label">Processing Fee ({{ $Settings->withdrawal_fee }}%)</span>
                                        <span id="summary-fee" class="font-medium">$0.00</span>
                                    </li>
                                    <li class="flex justify-between border-t border-gray-200 pt-2 mt-2">
                                        <span class="font-medium">You Will Receive</span>
                                        <span id="summary-total" class="font-medium">$0.00</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-secondary transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Withdraw Funds
                                </button>
                            </div>
                        </form>

                        @else
                        <div id="paypal-login-button">
                            <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-md" onclick="redirectToPayPal()">Log in with PayPal</button>
                            <p>Or go to <a href="{{ route('profile.edit') }}" class="underline">Profile</a> to add Paypal Email manually</p>
                            <p class="py-4">Is it safe to login with paypal? <br> Yes! Paypal do not share their data with anyone, but remember to enter 
                                the password only if you redirect to paypal's website.</p>
                        </div>
                        @endif
                    </div> 

                    {{-- Crypto Withdrawl Form --}}
                    <div class="w-full my-4 mt-6 hidden" id="crypto_form">
                        <div class="my-6  mx-auto  p-6 rounded-lg shadow-md">
                            <form action="{{ route('crypto_payout') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="address" class="block text-sm font-medium  mb-1">Wallet Address</label>
                                    <input type="text" id="address" name="address" placeholder="Enter wallet address"
                                        class="w-full p-3 rounded-md  border border-gray-600  focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <div class="mb-4">
                                    <label for="amount" class="block text-sm font-medium  mb-1">Amount</label>
                                    <input type="number" id="amount" name="amount" placeholder="Enter amount"
                                        class="w-full p-3 rounded-md  border border-gray-600  focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition">
                                    Withdraw
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Recent Withdrawals -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 recent-withdrawals">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Withdrawals</h2>
                    <a href="activity.html" class="text-primary text-sm hover:underline">View all</a>
                </div>
                <div class="overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-center">
                                <div class="flex items-start">
                                    <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary mr-3">
                                        <i class="fab fa-paypal"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">PayPal Withdrawal</p>
                                        <p class="text-xs text-gray-500">Apr 12, 2025</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-red-600 font-medium">-$250.00</span>
                                    <p class="text-xs text-green-600">Completed</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-center">
                                <div class="flex items-start">
                                    <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary mr-3">
                                        <i class="fab fa-paypal"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">PayPal Withdrawal</p>
                                        <p class="text-xs text-gray-500">Mar 28, 2025</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-red-600 font-medium">-$100.00</span>
                                    <p class="text-xs text-green-600">Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions and Support -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Withdrawal Information</h3>
                <div class="space-y-4 text-sm">
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Instant PayPal payouts are typically completed within minutes, while standard withdrawals may take 3-5 business days.
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            The minimum withdrawal amount is $10.00 USD.
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Ensure that your withdrawal details are correct. DigiWallet is not responsible for funds sent to incorrect accounts.
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-yellow-500">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            <strong>Important:</strong> For security reasons, your first withdrawal may require additional verification.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectPaymentMethod(element, method) {

            document.querySelectorAll('.payment_method').forEach(div => {
                div.classList.remove('text-blue-400', 'border-b-2', 'border-blue-400');
                div.classList.add('text-black', 'border-b');
            });

            element.classList.remove('text-black', 'border-b');
            element.classList.add('text-blue-400', 'border-b-2', 'border-blue-400');

            // Show or hide paypal_login_button based on selected method
            const currenciesDiv = document.getElementById('paypal_login_button');
            const crypto_div = document.getElementById('crypto_form');

            if (method === 'paypal') {
                currenciesDiv.classList.remove('hidden');                
            } else {
                currenciesDiv.classList.add('hidden');
            }

            if (method === 'crypto') {
                crypto_div.classList.remove('hidden');                
            } else {
                crypto_div.classList.add('hidden');
            }

            checkSelection();
        }

        window.onload = function() {
            const paypalButton = document.getElementById('paypalBtn');
            selectPaymentMethod(paypalButton, 'paypal');
        };

        document.querySelector('#amount')?.addEventListener('input', function () {
            document.querySelectorAll('.payment_amount').forEach(element => {
                element.classList.remove('bg-blue-400', 'text-white');
                element.classList.add('bg-gray-50', 'text-black');
            });

            checkSelection(); // Ensure the "Next" button is updated properly
        });


        function selectAmount(element, amount) {
            document.getElementById('amount').value = amount;

            // Remove 'bg-blue-200' from all amount buttons
            document.querySelectorAll('.payment_amount').forEach(div => {
                div.classList.remove('bg-blue-400', 'text-white');
                div.classList.add('bg-gray-50', 'text-black');
            });

            // Add 'bg-blue-200' to selected amount
            element.classList.remove('bg-gray-50', 'text-black');
            element.classList.add('bg-blue-400', 'text-white');

            checkSelection();
        }

        function checkSelection() {
            const paymentMethod = document.getElementById('selected_method').value;
            const amount = document.getElementById('amount').value;
            const submitButton = document.getElementById('next_button');

            if (paymentMethod && amount) {
                submitButton.classList.remove('bg-gray-600');
                submitButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
            } else {
                submitButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                submitButton.classList.add('bg-gray-600');
            }
        }

        // function gotoFees(){
        //     let selectedMethod = document.getElementById('selected_method').value;
        //     let amount = document.getElementById('amount').value;
        //     // let currency = document.getElementById('currency').value;
            
        //     if (!selectedMethod || !amount) {
        //         alert("Please select a payment method and enter an amount.");
        //         return;
        //     }

        //     window.location.href = `/deposit/fee_check?selected_method=${selectedMethod}&amount=${amount}`;
        // }


        // calculate Fees and check the entered balance
        document.addEventListener('DOMContentLoaded', function () {
            const amountInput = document.getElementById('withdraw-amount');
            const summaryAmount = document.getElementById('summary-amount');
            const summaryFee = document.getElementById('summary-fee');
            const summaryTotal = document.getElementById('summary-total');
            const submitBtn = document.querySelector('form#withdrawal-form button[type="submit"]');

            const feePercent = {{ $Settings->withdrawal_fee ?? 0 }};
            const userBalance = {{ Auth::user()->balance ?? 0 }};
            
            const warningMessage = document.createElement('p');
            warningMessage.className = 'text-red-600 text-sm mt-2 hidden';
            amountInput.parentElement.appendChild(warningMessage);

            amountInput.addEventListener('input', function () {
                let amount = parseFloat(amountInput.value) || 0;
                let fee = (amount * feePercent) / 100;
                let total = amount - fee;

                summaryAmount.textContent = `$${amount.toFixed(2)}`;
                summaryFee.textContent = `$${fee.toFixed(2)}`;
                summaryTotal.textContent = `$${total.toFixed(2)}`;

                if (amount > userBalance) {
                    warningMessage.textContent = `Withdrawal amount exceeds your current balance of $${userBalance.toFixed(2)}.`;
                    warningMessage.classList.remove('hidden');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    warningMessage.textContent = '';
                    warningMessage.classList.add('hidden');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            });
        });



        function redirectToPayPal() {
            const clientId = "{{ config('paypal.client_id') }}";
            const redirectUri = encodeURIComponent("https://vc.sostarghor.com/payout/paypal/callback");
            const loginUrl = `https://www.sandbox.paypal.com/signin/authorize?client_id=${clientId}&response_type=code&scope=email&redirect_uri=${redirectUri}`;
            window.location.href = loginUrl;
        }
    </script>

</x-app-layout>