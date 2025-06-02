<x-app-layout>

   <div class="flex-1 p-4 pb-20 md:p-6 ">
      <div class="p-16 flex justify-center bg-sky-600 md:py-24 rounded-lg my-4" style="background-image: url('/assets/dash.jpg');background-size:cover;">
         <div class="max-w-2xl rounded-lg w-full p-6 md:py-8 mb-8 relative overflow-hidden backdrop-blur-md border shadow-lg">

            <div class="absolute inset-0 bg-no-repeat bg-right-bottom opacity-20"
               style='background-image: url("data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="70" cy="70" r="40" fill="white"/></svg>"); background-size: 100px;'>
            </div>

            <div class="relative z-10 text-white ">
               <div class="flex justify-between">
                  <div class="">
                     <p class="text-sm text-gray-200 mb-2">Your balance</p>
                     <p class="text-4xl font-bold mb-6">{{ Auth::user()->balance }} USD</p>
                  </div>
                  <img src="{{ asset('/assets/usd_flag.png') }}" class="rounded-[50px] max-h-12 max-w-12" alt="">
               </div>

               <div class="flex space-x-4">

                  <a href="{{ route('deposit') }}"
                     class="flex-1 bg-white text-purple-600 py-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                     </svg>
                     <span>Deposit</span>
                  </a>

                  <a href="{{ route('payout') }}"
                     class="flex-1 bg-white text-purple-600 py-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                     <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                     </svg>
                     <span>Send</span>
                  </a>

                  <a href="{{ route('cards') }}"
                     class="flex-1 bg-white text-purple-600 py-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                     </svg>
                     <span>Card</span>
                  </a>

               </div>
            </div>
         </div>
      </div>

      <section class="bg-white rounded-lg shadow-md p-6">
         <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent transactions</h2>

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
                     <td class="px-4 py-3 text-right text-red-600 font-medium">${{ $transaction->amount }}</td>
                     <td class="px-4 py-3 text-right">
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{
                           $transaction->status }}</span>
                     </td>
                  </tr>
                  @endforeach

               </tbody>
            </table>
         </div>

      </section>
   </div>


</x-app-layout>