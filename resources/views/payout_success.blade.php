<x-app-layout>

    <h2 class="text-center text-green-500 text-2xl my-4">Payout Successful</h2>

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
                        {{ $payment_id }}
                    </td>
                </tr>
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Payer Email
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        {{ $payout_email ?? Auth::user()->paypal_email }}
                    </td>
                </tr>
                <!-- Row 2: Amount -->
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Payment Status
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        <button class="text-green-600 bg-green-300/20 p-2 rounded-lg">Pending</button>                      
                    </td>
                </tr>
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Amount
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        ${{ $amount }}
                    </td>
                </tr>
                <!-- Row 3: Date -->
                <tr class="border-b border-gray-700">
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Date
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-300 text-right">
                        {{ now() }}
                    </td>
                </tr>
                <!-- Row 4: Status -->
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                        Currency
                    </td>
                    <td class="px-6 py-4 text-right">
                        USD
                    </td>
                </tr>
            </tbody>
        </table>

        
    </div>

    <div class="p-4 rounded grid w-full">
        <a class="text-center underline" href="{{ route('payout') }}"> Return to Payout </a>
    </div>


</x-app-layout>