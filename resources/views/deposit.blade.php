<x-app-layout>

    {{-- Main COntent --}}
    <div class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Deposit Funds</h1>
                <p class="text-gray-600 mt-1">Add money to your DigiWallet account</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Deposit Methods</h2>
                </div>

                <!-- Deposit Methods Selection -->
                <div class="mb-6">
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full">
                            <div class="relative">
                                <div class=" border-gray-200">

                                    <div class="flex gap-3 border-b">
                                        <div class="payment_method p-2 px-4 flex items-center justify-center cursor-pointer hover:text-blue-700"
                                            onclick="selectPaymentMethod(this, 'paypal')">
                                            <img class="w-8 mr-2" src="{{ asset('assets/paypal.png') }}" alt=""> PayPal
                                        </div>

                                        <div class="payment_method p-2  px-4 flex items-center justify-center cursor-pointer hover:text-blue-700"
                                            onclick="selectPaymentMethod(this, 'payeer')">
                                            <img class="w-8 mr-2 rounded-2xl" src="{{ asset('assets/payeer.png') }}"
                                                alt=""> Payeer
                                        </div>

                                        <div class="payment_method p-2  px-4  flex items-center justify-center cursor-pointer hover:text-blue-700"
                                            onclick="selectPaymentMethod(this, 'crypto')">
                                            <img class="w-8 mr-2" src="{{ asset('assets/crypto.png') }}" alt=""> Crypto
                                        </div>
                                    </div>



                                    <div class="grid grid-cols-3 gap-3 mt-4 ">
                                        <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md flex items-center justify-center cursor-pointer hover:bg-blue-300"
                                            onclick="selectAmount(this, 50)">
                                            $50
                                        </div>
                                        <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md flex items-center justify-center cursor-pointer hover:bg-blue-300"
                                            onclick="selectAmount(this, 100)">
                                            $100
                                        </div>
                                        <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md flex items-center justify-center cursor-pointer hover:bg-blue-300"
                                            onclick="selectAmount(this, 150)">
                                            $150
                                        </div>
                                        <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md flex items-center justify-center cursor-pointer hover:bg-blue-300"
                                            onclick="selectAmount(this, 200)">
                                            $200
                                        </div>
                                        <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md flex items-center justify-center cursor-pointer hover:bg-blue-300"
                                            onclick="selectAmount(this, 250)">
                                            $250
                                        </div>
                                        <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md flex items-center justify-center cursor-pointer hover:bg-blue-300"
                                            onclick="selectAmount(this, 300)">
                                            $300
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div id="payment_form" class="mt-6">
                        <form class="space-y-6" id="deposit_form" action="{{ route('deposit_paypal') }}" method="POST" >
                            @csrf

                            {{-- Payment Method --}}
                            <input type="hidden" id="selected_method" value="">

                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount to
                                    Deposit (USD)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    {{-- Given amount --}}
                                    <input type="text" name="amount" id="amount"
                                        class="focus:ring-primary focus:border-primary block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md py-3"
                                        placeholder="10.00">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">USD</span>
                                    </div>
                                </div>
                            </div>


                            <!-- Calculate Fee Information -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-md font-medium text-gray-900 mb-2">Transaction Summary</h3>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex justify-between">
                                        <span>Payment Method</span>
                                        <span class="font-bold" id="update_payment_method">Select</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span>Deposit Amount</span>
                                        <span class="font-medium">$<span id="deposit_amount">0.00</span></span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span>Processing Fee (10%)</span>
                                        <span class="font-medium">$<span id="fee_amount">0.00</span></span>
                                    </li>
                                    <li class="flex justify-between border-t border-gray-200 pt-2 mt-2">
                                        <span class="font-medium">Total Amount</span>
                                        <span class="font-medium">$<span id="total_amount">0.00</span></span>
                                    </li>

                                    <li class="flex justify-between text-xs text-gray-500 pt-1">
                                        <span>Approximate BTC Amount</span>
                                        <span><span id="btc_amount">0.00000</span> BTC</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-secondary transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Continue to Payment
                                </button>
                            </div>
                        </form>

                    </div>


                </div>
            </div>

            <!-- Instructions and Support -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Deposit Instructions</h3>
                <div class="space-y-4 text-sm">
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Crypto deposits are usually credited within 10-30 minutes after receiving sufficient network
                            confirmations.
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            The minimum deposit amount is $10 USD equivalent in cryptocurrency.
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Make sure to send only the selected cryptocurrency to the deposit address. Sending any other
                            cryptocurrency may result in permanent loss.
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-5 w-5 text-yellow-500">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            <strong>Important:</strong> Always verify the deposit address before sending funds. Contact
                            support if you need assistance with your deposit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>

        function selectPaymentMethod(element, method) {
            document.getElementById('selected_method').value = method;

            // Remove 'bg-blue-600' from all payment methods
            document.querySelectorAll('.payment_method').forEach(div => {
                div.classList.remove('border-b-2', 'border-sky-400', 'text-sky-400');
                div.classList.add('text-black');
            });

            // Add 'bg-blue-600' to selected method
            element.classList.remove('border-b-2', 'border-sky-400');
            element.classList.add('border-b-2', 'border-sky-400', 'text-sky-400');

            checkSelection();
        }

        document.querySelector('#amount')?.addEventListener('input', function () {
            document.querySelectorAll('.payment_amount').forEach(element => {
                element.classList.remove('bg-blue-400', 'text-white');
                element.classList.add('bg-gray-50', 'text-black');
            });

            checkSelection(); // Ensure the "Next" button is updated properly
        });


        function selectAmount(element, amount) {
            document.getElementById('amount').value = amount;

            document.querySelectorAll('.payment_amount').forEach(div => {
                div.classList.remove('bg-blue-400', 'text-white');
                div.classList.add('bg-gray-50', 'text-black');
            });

            element.classList.remove('bg-gray-50', 'text-black');
            element.classList.add('bg-blue-400', 'text-white');

            updateFeeSummary(); // add this
            checkSelection();
        }


        function checkSelection() {
            const paymentMethod = document.getElementById('selected_method').value;
            const amount = document.getElementById('amount').value;
            const submitButton = document.getElementById('next_button');
            document.getElementById('update_payment_method').innerText =  paymentMethod;

            if (paymentMethod && amount) {
                submitButton.classList.remove('bg-gray-600');
                submitButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
            } else {
                submitButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                submitButton.classList.add('bg-gray-600');
            }
        }

        // Fee Calculation
        function updateFeeSummary() {
            const amountInput = document.getElementById('amount');
            const amount = parseFloat(amountInput.value);

            if (isNaN(amount) || amount <= 0) {
                setSummaryValues(0, 0, 0, 0);
                return;
            }

            const fee = amount * 0.10;
            const total = amount + fee;
            const btcRate = 96894; // example rate: 1 BTC = 27,000 USD
            const approxBTC = total / btcRate;

            setSummaryValues(amount, fee, total, approxBTC);
        }

        function setSummaryValues(deposit, fee, total, btc) {
            document.getElementById('deposit_amount').innerText = deposit.toFixed(2);
            document.getElementById('fee_amount').innerText = fee.toFixed(2);
            document.getElementById('total_amount').innerText = total.toFixed(2);
            document.getElementById('btc_amount').innerText = btc.toFixed(5);
        }


        document.querySelector('#amount')?.addEventListener('input', function () {
            document.querySelectorAll('.payment_amount').forEach(element => {
                element.classList.remove('bg-blue-400', 'text-white');
                element.classList.add('bg-gray-50', 'text-black');
            });

            updateFeeSummary(); // add this
            checkSelection();
        });

    </script>

</x-app-layout>

{{-- Currency Selector --}}
{{--
<div class="w-full my-4 hidden" id="currencies_div">
    <p class="py-2">Select currency you want to pay</p>
    <select name="currency" id="currency" class="w-full p-2 border bg-gray-800 border-gray-300 rounded">
        <option value="">Currencies</option>
        @if (!empty($currencies['currencies']))
        @foreach ($currencies['currencies'] as $currency)
        <option value="{{ $currency }}">{{ strtoupper($currency) }}</option>
        @endforeach
        @endif

    </select>
</div>

// Show or hide currencies_div based on selected method
// const currenciesDiv = document.getElementById('currencies_div');
// if (method === 'crypto') {
// currenciesDiv.classList.remove('hidden');
// } else {
// currenciesDiv.classList.add('hidden');
// }
--}}