<x-app-layout>

    <p class="text-2xl p-4 text-center">Buy Virtual Card</p>

    <div class="bg-gray-800 pb-6 rounded-2xl w-full max-w-md mx-auto mb-6 shadow-xl">
        <div class="py-4 bg-gradient-to-r rounded-t-2xl from-blue-500 via-purple-500 to-pink-500"></div>

        <div class="px-8 pt-6">

            {{-- Static Card --}}
            <div class="relative w-full text-gray-100 flex justify-center mb-4">
                <div style="background-image: url('{{ asset('assets/card_bg.jpg') }}');"
                    class="card flex flex-col justify-between min-w-[350px] min-h-[200px] rounded-lg  p-4 relative bg-cover bg-center ">
                    <div class="topright flex flex-col items-end">
                        <div class="flex justify-between w-full">
                            <p class="text-lg">$ XX</p>
                            <p class="text-lg">Virtual Card</p>
                        </div>
                        <div class="flex justify-between w-full">
                            <p class="text-md text-gray-300">Inactive</p>
                            <p class="text-sm text-gray-300">Onetime/Reloadable</p>
                        </div>
                    </div>
                    <div class="bottomleft flex flex-col">
                        <p>Limited Use</p>
                        <p class="text-lg pb-1">XXXX XXXX XXXX XXXX</p>
                        <div class="flex gap-2 items-center">
                            <div class="text-[10px] leading-none text-gray-200">Expiry <br> Date</div>
                            <div class="">XX/XX</div>
                            <div class="ml-8 text-[10px] leading-none text-gray-200">CVC <br> Code</div>
                            <div class="">XXX</div>
                        </div>
                    </div>
                    <div class="cardlogo absolute bottom-4 right-4">
                        <img class="max-w-[100px]" src="{{ asset('assets/visa.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <hr>

            <div class="fees">
                <div class="flex justify-between pt-2">
                    <p>Card Type</p>
                    <p id="selectedCardType" class="text-green-500"></p>
                </div>

                <div class="flex justify-between">
                    <p>Card Issue Fee</p>
                    <p id="cardFee" class="text-red-500">-$10.00</p>
                </div>

                <div class="flex justify-between pb-2">
                    <p>Total Cost</p>
                    <p id="totalCost" class="text-red-500">-$0.00</p>
                </div>
            </div>

            @php
                $av_grouped_cards = $available_cards->groupBy(['type', 'company', 'amount']);
            @endphp


            @if(!$av_grouped_cards->isEmpty())
            <form action="{{ route('request_card') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="company" class=" block mb-1">Card Type</label>
                    <div class="flex gap-2">
                        @foreach ($av_grouped_cards as $type => $companies)
                        <button type="button" onclick="updateCompanyOptions('{{ $type }}')"
                            class="type-btn w-1/2 py-2 bg-gray-700 text-gray-100 font-semibold rounded-md">
                            {{ $type }}</button>
                        @endforeach
                        <input type="hidden" name="type" id="type" value="{{ $available_cards->first()->type ?? '' }}">
                    </div>
                </div>

                <div>
                    <label class="block mb-1">Card Company</label>
                    <select name="company" id="company" class="w-full rounded-md bg-gray-800 text-white p-2"
                        onchange="updateAmountOptions()">
                        @foreach ($av_grouped_cards->first() as $company => $amounts)
                        <option value="{{ $company }}">{{ $company }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1">Select Amount</label>
                    <select name="amount" id="amount" class="w-full rounded-md bg-gray-800 text-white p-2">
                        @foreach ($av_grouped_cards->first()->first() as $amount => $cards)
                        <option value="{{ $amount }}">${{ $amount }}.00</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition duration-200">
                    Generate Now
                </button>
            </form>

            @else
                <p class="text-red-500 text-2xl text-center">No Available Card</p>
            @endif
        </div>
    </div>

    <hr>

    <h2 class="text-2xl py-4">Your Cards</h2>
    <div class="grid lg:grid-cols-2 gap-6">

        @foreach ($myCards as $myCard)
        <div style="background-image: url('{{ asset('assets/card_bg.jpg') }}');"
            class="card flex flex-col justify-between min-w-[350px] min-h-[200px] rounded-lg  p-4 relative bg-cover bg-center ">
            <div class="topright flex flex-col items-end">
                <div class="flex justify-between w-full">
                    <p class="text-lg">${{ $myCard->amount }}</p>
                    <p class="text-lg">Virtual Card</p>
                </div>
                <div class="flex justify-between w-full">
                    <p class="text-md text-gray-300">{{ $myCard->status }}</p>
                    <p class="text-sm text-gray-300">{{ $myCard->type }}</p>
                </div>
            </div>
            <div class="bottomleft flex flex-col">
                <p>Limited Use</p>
                <p class="text-lg pb-1">{{ $myCard->number }}</p>
                <div class="flex gap-2 items-center">
                    <div class="text-[10px] leading-none text-gray-200">Expiry <br> Date</div>
                    <div class="">{{ $myCard->expiry_date }}</div>
                    <div class="ml-8 text-[10px] leading-none text-gray-200">CVC <br> Code</div>
                    <div class="">{{ $myCard->cvc }}</div>
                </div>
            </div>
            <div class="cardlogo absolute bottom-4 right-4">
                @switch($myCard->company)
                    @case('Visa')
                        <img class="max-w-[100px]" src="{{ asset('assets/visa.svg') }}" alt="Visa">
                        @break
                    @case('Mastercard')
                        <img class="max-w-[100px]" src="{{ asset('assets/mastercard.png') }}" alt="Mastercard">
                        @break
                    @case('Amex')
                        <img class="max-w-[100px]" src="{{ asset('assets/amex.svg') }}" alt="Amex">
                        @break
                    @case('Discover')
                        <img class="max-w-[100px]" src="{{ asset('assets/discover.svg') }}" alt="Discover">
                        @break
                    @default
                        <img class="max-w-[100px]" src="{{ asset('assets/default.svg') }}" alt="Default">
                @endswitch

            </div>
        </div>
        @endforeach
    </div>

    <script>
        let groupedCards = @json($av_grouped_cards); // Get grouped data from PHP
        
        document.addEventListener("DOMContentLoaded", function () {
            let typeButtons = document.querySelectorAll(".type-btn");
            let companySelect = document.getElementById("company");
            let amountSelect = document.getElementById("amount");
            let totalCost = document.getElementById("totalCost");
            let selectedCardType = document.getElementById("selectedCardType");
            let cardFee = document.getElementById("cardFee");

            function updateSelectedText() {
                let selectedType = document.getElementById("type").value;
                let selectedCompany = companySelect.value;
                let selectedAmount = amountSelect.value;
                let fee = 10; // Fixed card issue fee
                let total = parseFloat(selectedAmount) + fee;

                selectedCardType.innerText = `${selectedCompany} - ${selectedType}`;
                cardFee.innerText = `-$${fee.toFixed(2)}`;
                totalCost.innerText = `-$${total.toFixed(2)}`;
            }

            typeButtons.forEach(button => {
                button.addEventListener("click", function () {
                    typeButtons.forEach(btn => {
                        btn.classList.remove("bg-orange-500", "text-white");
                        btn.classList.add("bg-gray-700", "text-gray-100");
                    });

                    this.classList.remove("bg-gray-700", "text-gray-100");
                    this.classList.add("bg-orange-500", "text-white");

                    document.getElementById("type").value = this.innerText.trim();
                    updateCompanyOptions(this.innerText.trim());
                    updateSelectedText();
                });
            });

            companySelect.addEventListener("change", updateSelectedText);
            amountSelect.addEventListener("change", updateSelectedText);
        });


    
        function updateCompanyOptions(selectedType) {
            let companySelect = document.getElementById("company");
            let amountSelect = document.getElementById("amount");
    
            // Clear existing options
            companySelect.innerHTML = "";
    
            // Populate based on selected type
            if (groupedCards[selectedType]) {
                for (let company in groupedCards[selectedType]) {
                    companySelect.innerHTML += `<option value="${company}">${company}</option>`;
                }
            }
    
            // Auto-update amount options
            updateAmountOptions();
        }
    
        function updateAmountOptions() {
            let selectedType = document.getElementById("type").value;
            let selectedCompany = document.getElementById("company").value;
            let amountSelect = document.getElementById("amount");
    
            // Clear existing options
            amountSelect.innerHTML = "";
    
            // Populate based on selected type & company
            if (groupedCards[selectedType] && groupedCards[selectedType][selectedCompany]) {
                for (let amount in groupedCards[selectedType][selectedCompany]) {
                    amountSelect.innerHTML += `<option value="${amount}">$${amount}.00</option>`;
                }
            }
        }
    </script>


</x-app-layout>