<x-app-layout>
    <main class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Create Virtual Bank Account</h1>
                <p class="text-gray-600 mt-1">Set up a virtual bank account to receive payments</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Bank Account Information</h2>
                </div>

                <div class="mb-8">
                    <div
                        class="relative w-full bg-gradient-to-r from-accent to-secondary rounded-xl shadow-lg p-6 text-white mb-6 overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mt-12 -mr-12">
                        </div>
                        <div class="flex flex-col space-y-4 py-4">
                            <div>
                                <div class="text-sm uppercase mb-1">Virtual Bank Account</div>
                                <div class="flex items-center">
                                    <i class="fas fa-university mr-2"></i>
                                    <span>VirtualCardEU Banking Solutions</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-xs opacity-75">Account Holder</div>
                                <div class="text-lg font-medium">{{ Auth::user()->name }}</div>
                            </div>
                            <div>
                                <div class="text-xs opacity-75">Account Information</div>
                                <div class="grid grid-cols-2 gap-4 mt-1">
                                    <div>
                                        <div class="text-xs opacity-75">Account Number</div>
                                        <div>**** **** 1234</div>
                                    </div>
                                    <div>
                                        <div class="text-xs opacity-75">Routing Number</div>
                                        <div>**** **** 5678</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form class="space-y-6" method="post" action="{{ route('request_bank') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <div>
                            <label for="account_type" class="block text-sm font-medium text-gray-700 mb-1">Account
                                Type</label>
                            <select name="account_type" id="account_type"
                                class="w-full text-sm px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="" class="">Select Account Type</option>
                                <option class="text-md" value="Checking">Checking</option>
                            </select>
                        </div>

                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                            <select name="currency" id="currency"
                                class="w-full text-sm px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">Select Currency</option>
                                <option value="USD">USD</option>
                                <option value="EURO">EURO</option>
                                <option value="GBP">GBP</option>

                            </select>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-medium text-gray-900 mb-2">Fee Information</h3>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex justify-between">
                                    <span>Account Setup Fee</span>
                                    <span class="font-medium">${{ $settings->bank_setup_fee }}.00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span>Monthly Maintenance</span>
                                    <span class="font-medium">${{ $settings->bank_maintenance_fee }}.00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span>Incoming Transfer Fee</span>
                                    <span class="font-medium">{{ $settings->incoming_transfer_fee }}% per
                                        transaction</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-secondary transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Create Account
                            </button>
                        </div>

                        <p class="text-sm text-gray-500 text-center">
                            By creating an account, you agree to our <a href="#"
                                class="text-primary hover:underline">Terms of Service</a> and
                            <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                        </p>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">About Virtual Bank Accounts</h3>
                <p class="text-gray-600 mb-4">
                    Virtual bank accounts allow you to receive payments from anywhere in the world without sharing your
                    personal banking details. They're ideal for businesses, freelancers, and anyone who needs to accept
                    payments safely.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Secure way to receive payments
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-globe"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Accept international transfers
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-random"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Easy transfers to your external accounts
                        </p>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 h-6 w-6 text-primary">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <p class="ml-2 text-gray-600">
                            Track all transactions in real-time
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>