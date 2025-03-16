<x-app-layout>

    <h2 class="text-center text-green-500 text-2xl my-4">Payment Successful</h2>

    <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden w-full my-4">
        <table class="min-w-full">
            <!-- Table Body -->
            <tbody>
                <!-- Row 1: Payment ID -->
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Payment ID
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        {{ $result->id }}
                    </td>
                </tr>
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Payer Email
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        {{ $result->payer->payer_info->email  }}
                    </td>
                </tr>
                <!-- Row 2: Amount -->
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Payment Status
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        @if ($result->state == 'approved')
                            <button class="text-green-600 bg-green-300/20 p-2 rounded-lg">Approved</button>
                        @else
                            <button class="text-red-600 bg-red-300/20 p-2 rounded-lg">Rejected</button>
                        @endif
                    </td>
                </tr>
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Amount
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        ${{ $result->transactions[0]->amount->total }}
                    </td>
                </tr>
                <!-- Row 3: Date -->
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Date
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        {{ $result->create_time }}
                    </td>
                </tr>
                <!-- Row 4: Status -->
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Currency
                    </td>
                    <td class="px-6 py-4 text-right">
                        {{ $result->transactions[0]->amount->currency }}
                    </td>
                </tr>
            </tbody>
        </table>

        
    </div>

    <div class="p-4 rounded grid w-full">
        <a class="text-center underline" href="{{ route('deposit') }}"> Return to Deposit </a>
    </div>


</x-app-layout>