<x-app-layout>

    <div class="flex-1 p-4 md:p-6 pb-20 md:pb-6">

        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Cards</h1>
                    <p class="text-gray-600 mt-1">Manage your virtual cards</p>
                </div>
                <a href="{{ route('order_cards') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary">
                    <i class="fas fa-plus mr-2"></i> New Card
                </a>
            </div>

            <!-- Cards Grid -->
            <div class="overflow-x-auto mb-6">
                <div class="flex space-x-6 pb-4">
                    @foreach ($myCards as $myCard)
                    <div class="min-w-[430px] max-w-xs flex-shrink-0 bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-1">
                            <div
                                class="h-48 bg-gradient-to-r from-primary to-secondary rounded-lg shadow-md p-6 text-white relative overflow-hidden">
                                <div
                                    class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mt-12 -mr-12">
                                </div>
                                <div class="flex flex-col justify-between h-full">
                                    <div>
                                        <div class="text-sm uppercase mb-1">Virtual Card</div>
                                        <div class="flex items-center">
                                            <i class="fas fa-globe mr-2"></i>
                                            {{ $myCard->type }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xl font-mono mb-4">{{ $myCard->number }}</div>
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <div class="text-xs opacity-75">Card Holder</div>
                                                <div>{{ Auth::user()->name }}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs opacity-75">Expires</div>
                                                <div>{{ $myCard->expiry_date }}</div>
                                            </div>
                                            <div class="w-12">
                                                @if ($myCard->type === 'Mastercard Reloadable' || $myCard->type === 'Mastercard One Time')
                                                <i class="fa-brands fa-cc-mastercard text-3xl"></i>
                                                @else
                                                <i class="fab fa-cc-visa text-3xl"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 border-t">
                            <div class="flex justify-between mb-2">
                                <div>
                                    <h3 class="font-medium text-gray-900">Personal Card</h3>
                                    <p class="text-gray-500 text-sm">USD Currency</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs px-2 rounded-full flex items-center">
                                    <i class="fas fa-check-circle mr-1"></i> {{ $myCard->status }}
                                </span>
                            </div>
                            <div class="flex justify-between text-sm mb-4">
                                <span class="text-gray-500">Balance:</span>
                                <span class="font-semibold text-gray-900">${{ $myCard->amount }}</span>
                            </div>
                            <div class="flex justify-between space-x-2">
                                <button
                                    class="flex-1 bg-primary text-white py-2 px-3 rounded-md hover:bg-secondary transition-colors text-sm">
                                    <i class="fas fa-money-bill-wave mr-1"></i> Top Up
                                </button>
                                <button
                                    class="flex-1 border border-gray-300 text-gray-700 py-2 px-3 rounded-md hover:bg-gray-50 transition-colors text-sm">
                                    <i class="fas fa-eye mr-1"></i> Details
                                </button>
                                <button
                                    class="bg-red-50 text-red-500 p-2 rounded-md hover:bg-red-100 transition-colors text-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


            <!-- Card Transactions -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Card Transactions</h2>
                    <select class="text-sm border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                        <option value="all">All Cards</option>
                        <option value="4256">Mastercard (...5678)</option>
                    </select>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Merchant</th>
                                <th scope="col" class="px-4 py-3">Date</th>
                                <th scope="col" class="px-4 py-3">Card Number</th>
                                <th scope="col" class="px-4 py-3 text-right">Amount</th>
                                <th scope="col" class="px-4 py-3 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($transactions as $transaction)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $transaction->merchant }}</td>
                                <td class="px-4 py-3">{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                                <td class="px-4 py-3">{{ $transaction->card_id }}</td>
                                <td class="px-4 py-3 text-right text-red-600 font-medium">${{ $transaction->amount }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{
                                        $transaction->status }}</span>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t">
                    <a href="activity.html" class="text-primary text-sm hover:underline">View all transactions</a>
                </div>
            </div>


        </div>

    </div>


</x-app-layout>