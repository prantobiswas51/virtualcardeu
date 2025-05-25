<x-app-layout>

    <div class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Order Virtual Card</h1>
                <p class="text-gray-600 mt-1">Create a virtual card for secure online transactions</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Card Information</h2>
                </div>

                <div class="mb-8">
                    <div class="">
                        {{-- Static Card --}}
                        <div class="relative w-full text-gray-100 flex justify-center mb-4">
                            <div
                                class="card bg-gradient-to-r from-primary to-secondary flex flex-col justify-between w-full min-h-[200px] rounded-lg p-4 relative bg-cover bg-center ">

                                <div class="topright flex flex-col items-end">
                                    <div class="flex justify-between w-full">
                                        <p class="text-xl">$ **</p>
                                        <p class="text-lg">Virtual Card</p>
                                    </div>
                                    <div class="flex justify-between w-full">
                                        <p class="text-md text-gray-300">Inactive</p>
                                        <p class="text-sm text-gray-300">Onetime/Reloadable</p>
                                    </div>
                                </div>

                                <div class="bottomleft flex flex-col">
                                    <p>Limited Use</p>
                                    <p class="text-xl pb-1">**** **** **** ****</p>

                                    <div class="flex gap-2 justify-between">
                                        <div class="">
                                            <div class="">Expires</div>
                                            <div class="text-xl">**/**</div>
                                        </div>
                                        <div class="">
                                            <div class="">CVC</div>
                                            <div class="text-xl">***</div>
                                        </div>

                                        <div class="cardlogo">
                                            <img class="max-w-[100px]" src="{{ asset('assets/visa.svg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="bg-gray-50 p-4 mt-2 rounded-lg">
                            <h3 class="text-md font-medium text-gray-900 mb-2">Fee Information</h3>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex justify-between">
                                    <span>Card Type</span>
                                    <p id="selectedCardType" class="text-green-500">Select Card</p>
                                </li>
                                <li class="flex justify-between">
                                    <span>Card Issuance Fee</span>
                                    <p id="cardFee" class="text-red-500">-$10.00</p>
                                </li>
                                <li class="flex justify-between">
                                    <span>Total Cost</span>
                                    <p id="totalCost" class="text-red-500">-$0.00</p>
                                </li>
                                <li class="flex justify-between">
                                    <span>Currency</span>
                                    <p class="font-bold text-green-500">USD</p>
                                </li>
                            </ul>
                        </div>

                        @php
                        // Ensure $available_cards is passed from the controller and is a Collection
                        $av_grouped_cards = $available_cards->groupBy(['type', 'amount']);
                        @endphp

                        @if(!$av_grouped_cards->isEmpty())
                        <form action="{{ route('request_card') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block mb-1">Card Type</label>
                                <select name="type" id="type"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                    {{-- onchange handled by jQuery --}}
                                    @foreach ($av_grouped_cards as $type => $amountsGroup)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block mb-1">Select Amount</label>
                                <select name="amount" id="amount"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                    {{-- Initial options will be for the first 'type' --}}
                                    @foreach ($av_grouped_cards->first() as $amount => $cards)
                                    <option value="{{ $amount }}">${{ $amount }}.00</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-secondary transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Place Order
                                </button>
                            </div>

                            <p class="text-sm text-gray-500 text-center">
                                By ordering, you agree to our <a href="#" class="text-primary hover:underline">Terms of
                                    Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                            </p>
                        </form>

                        @else
                        <p class="text-red-500 text-2xl text-center">No Available Card</p>
                        @endif

                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">About Virtual Cards</h3>
                <p class="text-gray-600 mb-4">
                    Virtual cards provide enhanced security for online transactions by generating temporary card
                    details. They help protect your div account from fraud and unauthorized charges.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Secure for online shopping and subscriptions
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-globe"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Accepted worldwide wherever Visa/Mastercard is accepted
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-lock"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Create multiple cards for different purposes
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Set spending limits and expiration dates
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get grouped data from PHP, converted to JSON
        let groupedCards = @json($av_grouped_cards);

        $(document).ready(function() {
            let $typeSelect = $("#type");
            let $amountSelect = $("#amount");
            let $totalCost = $("#totalCost");
            let $selectedCardType = $("#selectedCardType");
            let $cardFee = $("#cardFee");

            function updateSelectedText() {
                let selectedType = $typeSelect.val();
                let selectedAmount = $amountSelect.val();
                let fee = 10; // Fixed card issue fee
                let total = parseFloat(selectedAmount) + fee;

                // Updated to show just Type and Amount as Company is removed
                $selectedCardType.text(`${selectedType} - $${parseFloat(selectedAmount).toFixed(2)}`);
                $cardFee.text(`-$${fee.toFixed(2)}`);
                $totalCost.text(`-$${total.toFixed(2)}`);
            }

            function updateAmountOptions() {
                let selectedType = $typeSelect.val();
                $amountSelect.empty();

                // Populate based on selected type
                if (groupedCards[selectedType]) {
                    for (let amount in groupedCards[selectedType]) {
                        $amountSelect.append(`<option value="${amount}">$${parseFloat(amount).toFixed(2)}</option>`);
                    }
                }

                if ($amountSelect.val() === null && $amountSelect.find('option').length > 0) {
                    $amountSelect.val($amountSelect.find('option:first').val());
                }

                updateSelectedText(); // Update displayed text after amounts change
            }

            $typeSelect.on("change", updateAmountOptions);
            $amountSelect.on("change", updateSelectedText);
            updateAmountOptions();
        });
    </script>
</x-app-layout>