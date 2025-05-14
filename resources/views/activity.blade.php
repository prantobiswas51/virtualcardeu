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
                        <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
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
                        <label for="transaction-type" class="block text-sm font-medium text-gray-700 mb-1">Transaction
                            Type</label>
                        <select id="transaction-type"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="all">All Transactions</option>
                            <option value="deposit">Deposits</option>
                            <option value="withdrawal">Withdrawals</option>
                            <option value="fee">Fees</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto">
                        <label for="date-range" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                        <select id="date-range"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="all">All Time</option>
                            <option value="last7">Last 7 days</option>
                            <option value="last30">Last 30 days</option>
                            <option value="last90">Last 90 days</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="all">All Statuses</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto flex items-end">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Transactions List -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="min-w-full divide-y divide-gray-200">
                    <div
                        class="bg-gray-50 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider grid grid-cols-12">
                        <div class="col-span-1"></div>
                        <div class="col-span-3">Transaction</div>
                        <div class="col-span-2">Date</div>
                        <div class="col-span-2 text-center">Amount</div>
                        <div class="col-span-2 text-center">Status</div>
                        <div class="col-span-2 text-right">Actions</div>
                    </div>
                    <div class="divide-y divide-gray-200">

                        @foreach ($transactions as $transaction)
                        <!-- PayPal Withdrawal 1 -->
                        <div class="px-6 py-4 grid grid-cols-12 items-center hover:bg-gray-50">
                            <div class="col-span-1">
                                <div
                                    class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                                    <i class="fab fa-paypal"></i>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="text-sm font-medium text-gray-900">{{ $transaction->payment_method }}</div>
                                <div class="text-xs text-gray-500">To: {{ $transaction->payer_email }}</div>
                            </div>
                            <div class="col-span-2 text-sm text-gray-500">
                                <div class="">{{
                                    \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y') }}</div>
                                <div class="">{{
                                    \Carbon\Carbon::parse($transaction->created_at)->format('h:i A') }}</div>
                            </div>

                            <div class="col-span-2 text-sm font-medium  text-center">
                                @if ($transaction->type === 'withdrawal')
                                    <span class="text-red-800">-${{$transaction->amount }}</span>
                                @else
                                    <span class="text-green-800">+${{$transaction->amount }}</span>
                                @endif
                            </div>

                            <div class="col-span-2 text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($transaction->status === 'approved') text-green-800 bg-green-100
                                    @elseif ($transaction->status === 'pending') text-yellow-800 bg-yellow-100
                                    @else
                                        text-red-600 bg-red-100
                                    @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>



                            </div>
                            <div class="col-span-2 text-right">
                                <button class="text-primary hover:text-secondary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="bg-white text-gray-50 px-4">
                            {{ $transactions->links() }}
                        </div>

                    </div>
                </div>
            </div>
</x-app-layout>