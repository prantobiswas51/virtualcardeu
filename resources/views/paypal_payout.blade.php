<x-app-layout>
    <div class="pt-2">Paypal Payout</div>
    <div class="bg-gray-800 p-6 rounded-xl w-full mx-auto my-4 shadow-lg">
        <div class="text-center mb-4">
            <img src="https://www.paypalobjects.com/webstatic/icon/pp258.png" class="mx-auto w-16" alt="PayPal Logo">
        </div>

        <div class="bg-blue-700 p-3 rounded-lg text-sm mb-4">
            <div class="flex items-center">
                <x-heroicon-s-information-circle class="w-12 h-12 text-gray-300" />
                <p class="ml-2">We only support USD payments for now. You can convert to other currencies via PayPal.
                    Click <a href="#" class="underline">here</a> for details.</p>
            </div>
        </div>

        <div class="block text-gray-300 mb-1">Withdrawal Amount (Balance: $ {{ Auth::user()->balance }} )</div>
        <div class="flex items-center border border-gray-600 rounded-lg overflow-hidden mb-4">
            <span class="bg-gray-700 px-3 py-2">$</span>
            <input type="number" id="withdraw_input" class="bg-gray-900 text-white px-3 py-2 w-full focus:outline-none"
                placeholder="1.00" min="1">
        </div>

        <div class="flex gap-2 mb-4 justify-between">
            <button class="amount-btn bg-gray-700 px-3 py-2 w-full rounded-lg" data-amount="5">$5</button>
            <button class="amount-btn bg-gray-700 px-3 py-2 w-full rounded-lg" data-amount="10">$10</button>
            <button class="amount-btn bg-gray-700 px-3 py-2 w-full rounded-lg" data-amount="20">$20</button>
            <button class="amount-btn bg-gray-700 px-3 py-2 w-full rounded-lg" data-amount="50">$50</button>
            <button class="amount-btn bg-gray-700 px-3 py-2 w-full rounded-lg" data-amount="100">$100</button>
            <button class="amount-btn bg-gray-700 px-3 py-2 w-full rounded-lg" data-amount="150">$150</button>
        </div>

        <div class="bg-gray-700 p-4 rounded-lg mb-4">
            <p class="text-gray-400">PayPal Account Email</p>
            <div class="flex justify-between items-center">
                <span>
                    @if(Auth::user()->paypal_email)
                    {{ Auth::user()->paypal_email }}
                    @else
                    <a href="{{ route('payout') }}" class="underline text-red-400 text-sm">Add Email</a>
                    @endif
                </span>
                <p>
                    <a href="{{ route('payout') }}" class="underline text-red-400 text-sm">Change Email</a>
                </p>
            </div>
        </div>

        <form id="withdraw_form" action="{{ route('paypal_payout') }}" method="POST">
            @csrf
            <div class="bg-gray-700 p-4 rounded-lg mb-4">
                <p class="flex py-1 border-b justify-between">
                    <span class="text-gray-400">Withdrawal Amount</span>
                    <span>$<span id="total_amount_display">0.00</span></span>
                </p>
                <p class="flex py-1 border-b justify-between">
                    <span class="text-gray-400">Fee (5%)</span>
                    <span class="text-red-400">-$<span id="withdraw_fee_display">0.00</span></span>
                </p>
                <p class="flex py-1 border-b justify-between font-bold">
                    <span>Receive</span>
                    <span>$<span id="withdrawal_amount_display">0.00</span></span>
                </p>
            </div>

            <input type="hidden" id="total_amount" name="total_amount" value="">
            <p id="error" class="text-red-500 text-sm my-2"></p>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 w-full py-2 rounded-lg">Withdraw</button>

        </form>

        <p class="text-center text-gray-400 text-sm mt-4">
            Your withdrawal request will be completed within 1-7 business days.
        </p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const inputAmount = document.getElementById("withdraw_input");
        const totalAmountDisplay = document.getElementById("total_amount_display");
        const withdrawFeeDisplay = document.getElementById("withdraw_fee_display");
        const withdrawalAmountDisplay = document.getElementById("withdrawal_amount_display");
        const totalAmountInput = document.getElementById("total_amount");
        const form = document.getElementById("withdraw_form");
        const buttons = document.querySelectorAll(".amount-btn");

        const balance = parseFloat("{{ Auth::user()->balance }}"); // Get user balance from Blade
        const errorElement = document.getElementById("error");
        const submitButton = document.querySelector("button[type='submit']");

        function updateValues(amount) {
            if (amount < 1) amount = 1; // Prevent zero/negative values
            if (amount > balance) amount = balance; // Prevent exceeding balance

            let fee = (amount * 0.05).toFixed(2);
            let receiveAmount = (amount - fee).toFixed(2);

            totalAmountDisplay.textContent = amount.toFixed(2);
            withdrawFeeDisplay.textContent = fee;
            withdrawalAmountDisplay.textContent = receiveAmount;
            totalAmountInput.value = amount.toFixed(2);

            validateBalance(amount);
        }

        function validateBalance(amount) {
            if (amount > balance) {
                errorElement.textContent = "Insufficient balance.";
                submitButton.disabled = true;
            } else if (amount < 1) {
                errorElement.textContent = "Please enter a valid amount.";
                submitButton.disabled = true;
            } else {
                errorElement.textContent = "";
                submitButton.disabled = false;
            }
        }

        inputAmount.addEventListener("input", function () {
            let amount = parseFloat(inputAmount.value) || 0;
            updateValues(amount);
        });

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                let amount = parseFloat(this.getAttribute("data-amount"));
                inputAmount.value = amount;
                updateValues(amount);
            });
        });

        form.addEventListener("submit", function (event) {
            let amount = parseFloat(inputAmount.value) || 0;
            if (amount < 1 || amount > balance) {
                event.preventDefault();
                errorElement.textContent = "Please enter a valid withdrawal amount.";
            }
        });

    });

    </script>
</x-app-layout>