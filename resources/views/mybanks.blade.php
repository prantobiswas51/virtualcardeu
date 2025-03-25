<x-app-layout>

    <p class="text-2xl p-4 text-center">Buy Virtual Bank</p>

    <div class="bg-gray-800 pb-6 rounded-2xl w-full max-w-md mx-auto mb-6 shadow-xl">
        <div class="py-4 bg-gradient-to-r rounded-t-2xl from-blue-500 via-purple-500 to-pink-500"></div>

        <div class="px-8 pt-6">

            {{-- Static Card --}}
            <div class="relative w-full text-gray-100 flex justify-center mb-4">
                <div class="card flex flex-col bg-gray-600 justify-between min-w-[350px] min-h-[200px] rounded-lg  p-4 relative bg-cover bg-center ">
                    <div class="topright flex flex-col items-end">
                        <div class="flex justify-between w-full">
                            <p class="text-lg">$ XX</p>
                            <p class="text-lg">Virtual Bank</p>
                        </div>
                        <div class="flex justify-between w-full">
                            <p class="text-md text-gray-300">Inactive</p>
                            <p class="text-sm text-gray-300">Onetime</p>
                        </div>
                    </div>
                    <div class="bottomleft flex flex-col">
                        <p>Bank Number</p>
                        <p>Bank Name</p>
                    </div>
                </div>
            </div>
            <hr>

            <div class="fees">
                <div class="flex justify-between pt-2">
                    <p>Bank Type</p>
                    <p id="selectedCardType" class="text-green-500"></p>
                </div>

                <div class="flex justify-between">
                    <p>Bank Issue Fee</p>
                    <p id="cardFee" class="text-red-500">-$10.00</p>
                </div>

                <div class="flex justify-between pb-2">
                    <p>Total Cost</p>
                    <p id="totalCost" class="text-red-500">-$0.00</p>
                </div>
            </div>

        </div>
    </div>

    <hr>

    <h2 class="text-2xl py-4">Your Banks</h2>
    <div class="grid lg:grid-cols-2 gap-6">


    </div>

    


</x-app-layout>