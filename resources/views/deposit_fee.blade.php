<x-app-layout>
    <div class="">
        <p class="text-gray-100 font-medium pt-4 text-2xl text-center">Confirm</p>
        <p class="text-gray-100 font-medium text-sm text-center">Transfer amount</p>

        @php
            $amount = floatval(request('amount', 0)); // Ensure it's numeric
            $transaction_fee = $amount * 0.10; // 10% fee
            $total_amount = $amount + $transaction_fee;
        @endphp

        <p class="text-gray-100 font-medium text-2xl pb-4 text-center">${{ number_format($amount, 2) }}</p>

        <form action="{{ route('deposit_paypal') }}" method="POST">
            @csrf

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

            <button type="submit" class="bg-green-700 my-4 p-2 rounded-md w-full">Pay Now</button>
        </form>
    </div>
</x-app-layout>
