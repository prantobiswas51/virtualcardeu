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
                    <!-- Card Preview -->
                    <div
                        class="relative w-full h-48 bg-gradient-to-r from-primary to-secondary rounded-xl shadow-lg p-6 text-white mb-6 overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mt-12 -mr-12">
                        </div>
                        <div class="flex flex-col justify-between h-full">
                            <div>
                                <div class="text-sm uppercase mb-1">Virtual Card</div>
                                <div class="flex items-center">
                                    <i class="fas fa-globe mr-2"></i>
                                    <span>DigiWallet Mastercard</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-xl font-mono mb-4">**** **** **** ****</div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="text-xs opacity-75">Card Holder</div>
                                        <div>JOHN DOE</div>
                                    </div>
                                    <div>
                                        <div class="text-xs opacity-75">Expires</div>
                                        <div>**/**</div>
                                    </div>
                                    <div class="w-12">
                                        <i class="fab fa-cc-mastercard text-3xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Options -->
                    <form class="space-y-6">
                        <div>
                            <label for="cardType" class="block text-sm font-medium text-gray-700 mb-1">Card Type</label>
                            <select id="cardType" name="cardType"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="mastercard">Mastercard Virtual</option>
                                <option value="visa">Visa Virtual</option>
                            </select>
                        </div>

                        <div>
                            <label for="cardName" class="block text-sm font-medium text-gray-700 mb-1">Name on
                                Card</label>
                            <input type="text" id="cardName" name="cardName" value="John Doe"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                            <select id="currency" name="currency"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="usd">USD - US Dollar</option>
                                <option value="eur">EUR - Euro</option>
                                <option value="gbp">GBP - British Pound</option>
                            </select>
                        </div>

                        <!-- Fee Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-900 mb-2">Fee Information</h3>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex justify-between">
                                    <span>Card Issuance Fee</span>
                                    <span class="font-medium">$25.00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span>Monthly divtenance</span>
                                    <span class="font-medium">$2.00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span>Transaction Fee</span>
                                    <span class="font-medium">1% per transaction</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-secondary transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Place Order - $25.00
                            </button>
                        </div>

                        <p class="text-sm text-gray-500 text-center">
                            By ordering, you agree to our <a href="#" class="text-primary hover:underline">Terms of
                                Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Information Section -->
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
                            Accepted worldwide wherever Mastercard is accepted
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
</x-app-layout>