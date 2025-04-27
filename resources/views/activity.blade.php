<x-app-layout>
    <div class="flex-1 bg-gray-100 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Transaction History</h1>
                    <p class="text-gray-600 mt-1">View all your DigiWallet account activities</p>
                </div>
                <div class="flex">
                    <div class="relative inline-block text-left">
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Filter
                            <i class="fas fa-filter ml-2 mt-0.5"></i>
                        </button>
                    </div>
                </div>
            </div>
    
            <!-- Filter Options -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-wrap gap-4 justify-between">
                    <div class="w-full md:w-auto">
                        <label for="transaction-type" class="block text-sm font-medium text-gray-700 mb-1">Transaction Type</label>
                        <select id="transaction-type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="all">All Transactions</option>
                            <option value="deposit">Deposits</option>
                            <option value="withdrawal">Withdrawals</option>
                            <option value="fee">Fees</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto">
                        <label for="date-range" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                        <select id="date-range" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="all">All Time</option>
                            <option value="last7">Last 7 days</option>
                            <option value="last30">Last 30 days</option>
                            <option value="last90">Last 90 days</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="all">All Statuses</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto flex items-end">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>
    
            <!-- Transactions List -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="min-w-full divide-y divide-gray-200">
                    <div class="bg-gray-50 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider grid grid-cols-12">
                        <div class="col-span-1"></div>
                        <div class="col-span-3">Transaction</div>
                        <div class="col-span-2">Date</div>
                        <div class="col-span-2 text-center">Amount</div>
                        <div class="col-span-2 text-center">Status</div>
                        <div class="col-span-2 text-right">Actions</div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <!-- PayPal Withdrawal 1 -->
                        <div class="px-6 py-4 grid grid-cols-12 items-center hover:bg-gray-50">
                            <div class="col-span-1">
                                <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                                    <i class="fab fa-paypal"></i>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="text-sm font-medium text-gray-900">PayPal Withdrawal</div>
                                <div class="text-xs text-gray-500">To: john.doe@example.com</div>
                            </div>
                            <div class="col-span-2 text-sm text-gray-500">Apr 12, 2025</div>
                            <div class="col-span-2 text-sm font-medium text-red-600 text-center">-$250.00</div>
                            <div class="col-span-2 text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                            </div>
                            <div class="col-span-2 text-right">
                                <button class="text-primary hover:text-secondary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
    
                        <!-- PayPal Withdrawal 2 -->
                        <div class="px-6 py-4 grid grid-cols-12 items-center hover:bg-gray-50">
                            <div class="col-span-1">
                                <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                                    <i class="fab fa-paypal"></i>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="text-sm font-medium text-gray-900">PayPal Withdrawal</div>
                                <div class="text-xs text-gray-500">To: john.doe@example.com</div>
                            </div>
                            <div class="col-span-2 text-sm text-gray-500">Mar 28, 2025</div>
                            <div class="col-span-2 text-sm font-medium text-red-600 text-center">-$100.00</div>
                            <div class="col-span-2 text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                            </div>
                            <div class="col-span-2 text-right">
                                <button class="text-primary hover:text-secondary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
    
                        <!-- Crypto Deposit -->
                        <div class="px-6 py-4 grid grid-cols-12 items-center hover:bg-gray-50">
                            <div class="col-span-1">
                                <div class="h-10 w-10 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-500">
                                    <i class="fab fa-bitcoin"></i>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="text-sm font-medium text-gray-900">Bitcoin Deposit</div>
                                <div class="text-xs text-gray-500">ID: BC127834928347</div>
                            </div>
                            <div class="col-span-2 text-sm text-gray-500">Mar 15, 2025</div>
                            <div class="col-span-2 text-sm font-medium text-green-600 text-center">+$500.00</div>
                            <div class="col-span-2 text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                            </div>
                            <div class="col-span-2 text-right">
                                <button class="text-primary hover:text-secondary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
    
                        <!-- Card Order Fee -->
                        <div class="px-6 py-4 grid grid-cols-12 items-center hover:bg-gray-50">
                            <div class="col-span-1">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="text-sm font-medium text-gray-900">Virtual Card Fee</div>
                                <div class="text-xs text-gray-500">Card #: XXXX-XXXX-XXXX-4532</div>
                            </div>
                            <div class="col-span-2 text-sm text-gray-500">Feb 28, 2025</div>
                            <div class="col-span-2 text-sm font-medium text-red-600 text-center">-$15.00</div>
                            <div class="col-span-2 text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                            </div>
                            <div class="col-span-2 text-right">
                                <button class="text-primary hover:text-secondary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
    
                        <!-- Ethereum Deposit -->
                        <div class="px-6 py-4 grid grid-cols-12 items-center hover:bg-gray-50">
                            <div class="col-span-1">
                                <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                    <i class="fab fa-ethereum"></i>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="text-sm font-medium text-gray-900">Ethereum Deposit</div>
                                <div class="text-xs text-gray-500">ID: ETH98675645342</div>
                            </div>
                            <div class="col-span-2 text-sm text-gray-500">Feb 12, 2025</div>
                            <div class="col-span-2 text-sm font-medium text-green-600 text-center">+$350.00</div>
                            <div class="col-span-2 text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                            </div>
                            <div class="col-span-2 text-right">
                                <button class="text-primary hover:text-secondary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">12</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-primary hover:bg-blue-100">
                                    1
                                </a>
                                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    2
                                </a>
                                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    3
                                </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>