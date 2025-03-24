<x-app-layout>
    <h3 class="py-2 text-2xl font-bold">Deposit</h3>

    <div class="bg-gray-800 p-6 rounded-md">

        <label for="payment-method" class="block text-gray-100 py-4">Select Payment Method</label>
        <div class="flex gap-3">
            <div class="payment_method p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectPaymentMethod(this, 'paypal')">
                <img class="w-6 mr-2" src="{{ asset('assets/paypal.png') }}" alt=""> PayPal
            </div>
            <div class="payment_method p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectPaymentMethod(this, 'payeer')">
                <img class="w-8 mr-2" src="{{ asset('assets/payeer.png') }}" alt=""> Payeer
            </div>
            <div class="payment_method p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectPaymentMethod(this, 'crypto')">
                <img class="w-8 mr-2" src="{{ asset('assets/crypto.png') }}" alt=""> Crypto
            </div>
        </div>

        <input type="hidden" id="selected_method" value="">

        <label for="amount" class="block text-gray-100 font-medium mt-6">Enter amount</label>
        <input type="number" id="amount" placeholder="Enter amount"
            class="w-full px-4 py-2 border rounded-lg text-gray-900 focus:ring focus:ring-blue-300">

        <div class="grid grid-cols-3 gap-3 mt-4">
            <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectAmount(this, 50)">
                $50
            </div>
            <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectAmount(this, 100)">
                $100
            </div>
            <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectAmount(this, 150)">
                $150
            </div>
            <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectAmount(this, 200)">
                $200
            </div>
            <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectAmount(this, 250)">
                $250
            </div>
            <div class="payment_amount p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectAmount(this, 300)">
                $300
            </div>
        </div>

        {{-- Currency Selector --}}
       {{--  <div class="w-full my-4 hidden" id="currencies_div">
            <p class="py-2">Select currency you want to pay</p>
            <select name="currency" id="currency" class="w-full p-2 border bg-gray-800 border-gray-300 rounded">
                <option value="">Currencies</option>
                @if (!empty($currencies['currencies']))
                    @foreach ($currencies['currencies'] as $currency)
                        <option value="{{ $currency }}">{{ strtoupper($currency) }}</option>
                    @endforeach
                @endif
                
            </select> 
        </div>--}}

    </div>

    <div class="my-4 mt-16">
        <button id="next_button" onclick="gotoFees()" class="w-full bg-gray-600 text-white py-2 rounded-lg transition">Next</button>
    </div>

    <script>
        function selectPaymentMethod(element, method) {
            document.getElementById('selected_method').value = method;

            // Remove 'bg-blue-600' from all payment methods
            document.querySelectorAll('.payment_method').forEach(div => {
                div.classList.remove('bg-blue-600', 'text-white');
                div.classList.add('bg-gray-50', 'text-black');
            });

            // Add 'bg-blue-600' to selected method
            element.classList.remove('bg-gray-50', 'text-black');
            element.classList.add('bg-blue-600', 'text-white');

            // Show or hide currencies_div based on selected method
            // const currenciesDiv = document.getElementById('currencies_div');
            // if (method === 'crypto') {
            //     currenciesDiv.classList.remove('hidden');
            // } else {
            //     currenciesDiv.classList.add('hidden');
            // }

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

        function gotoFees(){
            let selectedMethod = document.getElementById('selected_method').value;
            let amount = document.getElementById('amount').value;
            // let currency = document.getElementById('currency').value;
            
            if (!selectedMethod || !amount) {
                alert("Please select a payment method and enter an amount.");
                return;
            }

            window.location.href = `/deposit/fee_check?selected_method=${selectedMethod}&amount=${amount}`;
        }
    </script>

</x-app-layout>