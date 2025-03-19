<x-app-layout>
    <div class="">
        <p class="text-gray-100 font-medium pt-4 text-2xl text-center">Confirm</p>
        <p class="text-gray-100 font-medium text-sm text-center">Transfer amount</p>

        @php
            $amount = floatval(request('amount', 0)); 
            $currency = request('currency');
            $method = request('selected_method');
            $transaction_fee = $amount * 0.10;
            $total_amount = $amount + $transaction_fee;
        @endphp

        <p class="text-gray-100 font-medium text-2xl pb-4 text-center">${{ number_format($amount, 2) }}</p>

        {{-- <form action="{{ route('deposit_paypal') }}" method="POST"> --}}
        <form id="deposit_form" action="{{ route('deposit_paypal') }}" method="POST">
            @csrf

            <input type="hidden" id="hidden_method" value="{{ $method }}">
            <input type="hidden" name="currency" value="{{ $currency }}">

            <div class="method flex justify-between bg-gray-800 rounded-md p-4 items-center py-2">
                <div class="">Method</div>
                <div class="flex items-center">Paypal 
                    <img class="max-h-[50px] rounded-md ml-2" src="{{ asset('assets/paypal.png') }}" alt=""> 
                </div>
            </div>

            <div class="bg-gray-800 p-4 rounded-md mt-4">
                <div class="method flex items-center justify-between gap-2 border-b border-gray-500">
                    <p class="py-2">Transaction Fee </p>
                    <p>10%</p>
                </div>
                <div class="method flex items-center justify-between gap-2 border-b border-gray-500">
                    <p class="py-2">Deposit Amount </p>
                    <p>${{ number_format($amount, 2) }} </p>
                </div>

                <div class="method flex items-center justify-between gap-2 border-b border-gray-500">
                    <p class="py-2">Total Amount Including Fee </p>
                    <div class="flex">${{ number_format($total_amount, 2) }}</div>
                </div>

                <!-- Hidden input to send total amount in the form -->
                <input type="hidden" name="total_amount" value="{{ $total_amount }}">
            </div>

            <button type="submit" id="pay_now" class="bg-green-700 my-4 p-2 rounded-md w-full">Pay Now</button>
        </form>
    </div>

    <script>
        document.getElementById('pay_now').addEventListener('click', function(event) {
            event.preventDefault();
    
            let selectedMethod = document.getElementById('hidden_method').value;
            let depositForm = document.getElementById('deposit_form');
    
            // Update form action dynamically
            if (selectedMethod === 'crypto') {
                depositForm.action = "{{ route('deposit_crypto') }}";
            } 
            
            if (selectedMethod === 'paypal') {
                depositForm.action = "{{ route('deposit_paypal') }}";
            }

            if (selectedMethod === 'payeer') {
                depositForm.action = "{{ route('deposit_payeer') }}";
            }
    
            depositForm.submit(); // Submit the form after updating action
        });
    </script>

</x-app-layout>
