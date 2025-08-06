<x-app-layout>

   <div class="flex-1 p-4 pb-10 md:p-6 ">

      <div class="bg-white mb-4 p-4 rounded-lg flex justify-between">
         <div class=""> <i class="fa fa-bell text-gray-500"></i> <span class="text-gray-500">Notifications</span> 
            <span class="ml-4 text-sm">{{ $last_notification->content ?? "No notification available"}}</span> </div>
         <a href="{{ route('notifications') }}" class="text-primary">See all </a>
      </div>

      <div class=" rounded-lg bg-white w-full p-6 mb-4 relative overflow-hidden backdrop-blur-md border shadow-lg">
         <div class="absolute inset-0 bg-no-repeat bg-right-bottom opacity-20"
            style='background-image: url("data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="70" cy="70" r="40" fill="white"/></svg>"); background-size: 100px;'>
         </div>

         <div class="relative z-10">
            <div class="flex mb-6">
               <img src="{{ asset('/assets/usd_flag.png') }}" class="rounded-[50px] max-h-8 max-w-8" alt="">
               <div class="ml-4">
                  <p class="text-sm ">Your balance</p>
                  <p class="text-xl md:text-2xl text-green-400 font-bold ">${{ Auth::user()->balance }} USD</p>
               </div>
               
            </div>

            <div class="flex space-x-4">

               <a href="{{ route('deposit') }}"
                  class="flex-1 bg-white text-purple-600 p-2 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                  </svg>
                  <span>Deposit</span>
               </a>

               <a href="{{ route('payout') }}"
                  class="flex-1 bg-white text-purple-600 p-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                  <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18">
                     </path>
                  </svg>
                  <span>Send</span>
               </a>

               <a href="{{ route('cards') }}"
                  class="flex-1 bg-white text-purple-600 p-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                  <i class="fa fa-credit-card"></i>
                  <span>Card</span>
               </a>

            </div>
         </div>
      </div>

      <section class="bg-white rounded-lg shadow-md p-6">
         <h2 class=" font-semibold text-gray-800 mb-4">Recent transactions</h2>

         <div class="overflow-x-auto">

            @if (!$transactions->isEmpty())

            <table class="w-full text-left text-gray-500">
               <thead class=" text-gray-700  text-sm bg-gray-50">
                  <tr>
                     <th scope="col" class="px-4 py-3">Transaction ID</th>
                     <th scope="col" class="px-4 py-3">Merchant</th>
                     <th scope="col" class="px-4 py-3">Date</th>
                     <th scope="col" class="px-4 py-3 ">Amount</th>
                     <th scope="col" class="px-4 py-3 ">Type</th>
                     <th scope="col" class="px-4 py-3 ">Status</th>
                  </tr>
               </thead>
               <tbody>


                  @foreach ($transactions as $transaction)
                  <tr class="border-b text-sm  hover:bg-gray-50">
                     <td class="px-4 py-3  text-gray-900">{{ $transaction->payment_id }}</td>
                     <td class="px-4 py-3  text-gray-900">{{ $transaction->merchant }}</td>
                     <td class="px-4 py-3 w-40  whitespace-nowrap">{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                     <td class="px-4 py-3  {{ $transaction->type === "Incoming" ? "text-green-600" : "text-red-600" }} ">${{ $transaction->amount }} </td>
                     <td class="px-4 py-3  text-gray-900">{{ $transaction->type }}</td>
                     <td class="px-4 py-3 ">
                        <span class="px-2 py-1  rounded-full bg-green-100 text-green-800">{{ $transaction->status }}</span>
                     </td>
                  </tr>
                  @endforeach

               </tbody>
            </table>
            @else
            <div class="flex justify-center">
               <div class="p-8 my-14 flex flex-col rounded-lg gap-2  max-w-fit items-center">
              <i class="fa-solid fa-chart-simple fa-2xl mb-4"></i>
               <div class=" flex justify-center">No transactions to show</div>
            </div>
            </div>
            @endif
         </div>

      </section>
   </div>


</x-app-layout>