<x-app-layout>

   <!-- Main Content -->


   <div class=" flex flex-col w-full lg:flex-row">

      <div class="flex-1 p-6 lg:p-8">

         <div class="p-16 bg-sky-600 rounded-lg my-4"
            style="background-image: url('/assets/dash.jpg');background-size:cover;">
            <div class=" rounded-lg  p-6 mb-8 relative overflow-hidden backdrop-blur-md border shadow-lg">

               <div class="absolute inset-0 bg-gradient-to-br  opacity-80 rounded-lg"></div>
               <div class="absolute inset-0 bg-no-repeat bg-right-bottom opacity-20"
                  style='background-image: url("data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="70" cy="70" r="40" fill="white"/></svg>"); background-size: 100px;'>
               </div>

               <div class="relative z-10 text-white ">
                  <p class="text-sm text-gray-200 mb-2">Your balance</p>
                  <p class="text-4xl font-bold mb-6">{{ Auth::user()->balance }} USD</p>
                  <div class="flex space-x-4">
                     <button
                        class="flex-1 bg-white text-purple-600 py-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                           xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Deposit</span>
                     </button>
                     <button
                        class="flex-1 bg-white text-purple-600 py-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                           xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                        </svg>
                        <span>Send</span>
                     </button>
                     <button
                        class="flex-1 bg-white text-purple-600 py-3 rounded-lg flex items-center justify-center space-x-2 shadow hover:bg-gray-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                           xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        <span>Card</span>
                     </button>
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

      <aside class=" bg-white p-6 lg:p-8 border-l border-gray-200">
         <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">How to start with VirtualCardEU portal?</h2>
            <ul class="space-y-4">
               <li class="flex items-start">
                  <span
                     class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3 mt-1">1</span>
                  <div>
                     <p class="font-medium text-gray-700">Deposit money</p>
                     <p class="text-gray-500 text-sm">Deposit money to your account</p>
                  </div>
               </li>
               <li class="flex items-start">
                  <span
                     class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3 mt-1">2</span>
                  <div>
                     <p class="font-medium text-gray-700">Receive payments</p>
                     <p class="text-gray-500 text-sm">Receive international payments</p>
                  </div>
               </li>
               <li class="flex items-start">
                  <span
                     class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3 mt-1">3</span>
                  <div>
                     <p class="font-medium text-gray-700">Send payments</p>
                     <p class="text-gray-500 text-sm">Send international payments</p>
                  </div>
               </li>
            </ul>
         </section>

         <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent activity</h2>
            <div class="flex items-start bg-green-50 rounded-lg p-4">
               <svg class="w-6 h-6 text-green-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
               </svg>
               <div>
                  <p class="font-medium text-gray-700">Account registered</p>
                  <p class="text-gray-500 text-sm">Account registered on 2023-05-30</p>
               </div>
            </div>
         </section>


      </aside>

   </div>


</x-app-layout>