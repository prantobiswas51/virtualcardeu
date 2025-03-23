<x-app-layout>

    <h3 class="py-2 text-2xl font-bold">Payout</h3>

    <div class="bg-gray-800 p-6 rounded-md">

        <label for="payment-method" class="block text-gray-100 py-4">Select Payout Method</label>
        <div class="flex gap-3">
            <div class="payment_method p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectPaymentMethod(this, 'paypal')">
                <img class="w-6 mr-2" src="{{ asset('assets/paypal.png') }}" alt=""> PayPal
            </div>

            <div class="payment_method p-2 bg-gray-50 px-4 rounded-md text-black flex items-center justify-center cursor-pointer hover:bg-blue-300"
                onclick="selectPaymentMethod(this, 'crypto')">
                <img class="w-8 mr-2" src="{{ asset('assets/crypto.jpg') }}" alt=""> Crypto
            </div>
        </div>

        <input type="hidden" id="selected_method" value="">

        <div class="w-full my-4 mt-6 hidden" id="paypal_login_button">
            @if (Auth::user()->paypal_id && Auth::user()->paypal_email)
                <p>You are already logged in with Paypal.</p>
                <a href="/payout/paypal/form"><button class="w-full bg-green-600 p-2 rounded-md my-2">Open Paypal Payout Form</button></a>
            @else  
                <div id="paypal-login-button">
                    <button class="w-full px-4 py-2 bg-blue-600 rounded-md" onclick="redirectToPayPal()">Log in with PayPal</button>
                </div>
            @endif
        </div>

        <div class=" my-4">

            <form action="{{ route('crypto_payout') }}" method="POST">
                @csrf
                <input type="text" name="address" class="w-full bg-gray-700">
                <input type="text" name="amount" class="w-full bg-gray-700">
                <button type="submit" class="border p-2 px-4 rounded-md"> Submit </button>
            </form>
        </div>

    </div>

    {{-- <div class="my-4 mt-16">
        <button id="next_button" onclick="gotoFees()" class="w-full bg-gray-600 text-white py-2 rounded-lg transition">Next</button>
    </div> --}}

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

            // Show or hide paypal_login_button based on selected method
            const currenciesDiv = document.getElementById('paypal_login_button');
            if (method === 'paypal') {
                currenciesDiv.classList.remove('hidden');                
            } else {
                currenciesDiv.classList.add('hidden');
            }

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

        function redirectToPayPal() {
            const clientId = "{{ config('paypal.client_id') }}";
            const redirectUri = encodeURIComponent("https://vc.sostarghor.com/payout/paypal/callback");
            const loginUrl = `https://www.sandbox.paypal.com/signin/authorize?client_id=${clientId}&response_type=code&scope=email&redirect_uri=${redirectUri}`;
            window.location.href = loginUrl;
        }
    </script>

</x-app-layout>