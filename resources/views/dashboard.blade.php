<x-app-layout>

   {{-- <div class="wlt py-4">
      <p class="text-white">My Wallet</p>
      <p class="text-green-500 font-bold text-2xl">$ {{ Auth::user()->balance }}</p>
   </div>
   <!-- cards -->
   <div class="card flex gap-2">
      <div class="p-4 bg-gray-800 text-white border  border-green-300 max-w-[300px] my-2 rounded-lg">
         <div class="bg-purple-400/20 h-12 w-12 flex items-center justify-center rounded-[50px]">
            <x-heroicon-s-clipboard class="w-8 h-8 text-purple-600" />
         </div>
         <h3>Set up your wallet</h3>
         <p class="text-gray-500 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque dolore
            deserunt veniam dicta possimus cupiditate.</p>
      </div>
      <div class="p-4 bg-gray-800 text-white border  border-green-300 max-w-[300px] my-2 rounded-lg">
         <div class="bg-green-400/20 h-12 w-12 flex items-center justify-center rounded-[50px]">
            <x-heroicon-s-clipboard class="w-8 h-8 text-green-600" />
         </div>
         <h3>Create your collection</h3>
         <p class="text-gray-500 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque dolore
            deserunt veniam dicta possimus cupiditate.</p>
      </div>


   </div>
   <!-- transaction -->
   <div class="transaction">
      <p class="font-bold text-white py-4">Transactions</p>
   </div>
   <!-- eth -->

   <div class="eth flex justify-between my-2">

      <table class="w-full text-sm text-gray-400">
         <thead class=" text-left py-1  rounded-md">
            <th class="rounded-l-md bg-gray-600 p-2">Date</th>
            <th class="bg-gray-600 ">Payment Method</th>
            <th class="bg-gray-600 ">Transanction ID</th>
            <th class="bg-gray-600 ">Amount</th>
            <th class="bg-gray-600 ">Status</th>
            <th class="bg-gray-600 rounded-r-md">Payment Type</th>
         </thead>

         @if($transactions->isEmpty())
         <tbody>
            <tr>
               <td colspan="6" class="text-center mt-2 text-white my-4 bg-red-600 py-2">No Transactions Found</td>
            </tr>
         </tbody>
         @else
         @foreach ($transactions as $transaction)
         <tbody>
            <tr class=" border-b border-gray-600">
               <td class="py-3">{{ $transaction->created_at->format('M j, Y') }}</td>
               <td>{{ $transaction->payment_method }}</td>
               <td>{{ $transaction->payment_id }}</td>
               <td>${{ $transaction->amount }}</td>
               <td>
                  <button class="
                           {{ $transaction->status === 'failed' ? 'bg-red-800' : '' }}
                           {{ $transaction->status === 'success' ? 'bg-green-800' : '' }}
                           {{ $transaction->status === 'pending' ? 'bg-yellow-800' : '' }}
                           p-1 px-2 rounded-md">
                     {{ $transaction->status }}
                  </button>

               </td>
               <td>{{ $transaction->type }}</td>
            </tr>
         </tbody>
         @endforeach
         @endif

      </table>



   </div> --}}


   <!-- Main Content -->
   <div class="flex-1 p-4 md:p-6 pb-20 bg-gray-100 md:pb-6">
      <div class="max-w-7xl mx-auto">
         <!-- User Welcome & Balance -->
         <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}</h1>
            <div class="bg-primary text-white mt-4 rounded-lg p-6">
               <p class="text-sm mb-1">Available Balance</p>
               <div class="flex items-end">
                  <h2 class="text-3xl font-bold">$ {{ Auth::user()->balance }}</h2>
                  <span class="text-white opacity-80 ml-2 text-sm mb-1">USD</span>
               </div>
            </div>
         </div>

         <!-- Quick Actions -->
         <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
            <a href="deposit.html"
               class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-shadow">
               <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary mb-2">
                  <i class="fas fa-arrow-down"></i>
               </div>
               <span class="text-gray-700 text-sm">Deposit</span>
            </a>
            <a href="withdraw.html"
               class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-shadow">
               <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary mb-2">
                  <i class="fas fa-arrow-up"></i>
               </div>
               <span class="text-gray-700 text-sm">Withdraw</span>
            </a>
            <a href="order-card.html"
               class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-shadow">
               <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary mb-2">
                  <i class="fas fa-credit-card"></i>
               </div>
               <span class="text-gray-700 text-sm">Order Card</span>
            </a>
            <a href="create_virtual_account.php"
               class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-shadow">
               <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-primary mb-2">
                  <i class="fas fa-university"></i>
               </div>
               <span class="text-gray-700 text-sm">Create Bank</span>
            </a>
         </div>

         <!-- Recent Transactions -->
         <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
               <h2 class="text-xl font-semibold text-gray-900">Recent Transactions</h2>
               <a href="activity.html" class="text-primary text-sm hover:underline">View all</a>
            </div>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
               <div class="divide-y divide-gray-200">
                  <div class="p-4 hover:bg-gray-50">
                     <div class="flex justify-between items-center">
                        <div class="flex items-start">
                           <div
                              class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 mr-3">
                              <i class="fas fa-arrow-down"></i>
                           </div>
                           <div>
                              <p class="text-sm font-medium text-gray-900">Deposit</p>
                              <p class="text-xs text-gray-500">Apr 15, 2025</p>
                           </div>
                        </div>
                        <span class="text-green-600 font-medium">+$500.00</span>
                     </div>
                  </div>
                  <div class="p-4 hover:bg-gray-50">
                     <div class="flex justify-between items-center">
                        <div class="flex items-start">
                           <div
                              class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center text-red-600 mr-3">
                              <i class="fas fa-arrow-up"></i>
                           </div>
                           <div>
                              <p class="text-sm font-medium text-gray-900">Withdrawal to PayPal</p>
                              <p class="text-xs text-gray-500">Apr 12, 2025</p>
                           </div>
                        </div>
                        <span class="text-red-600 font-medium">-$250.00</span>
                     </div>
                  </div>
                  <div class="p-4 hover:bg-gray-50">
                     <div class="flex justify-between items-center">
                        <div class="flex items-start">
                           <div
                              class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mr-3">
                              <i class="fas fa-credit-card"></i>
                           </div>
                           <div>
                              <p class="text-sm font-medium text-gray-900">Virtual Card Order</p>
                              <p class="text-xs text-gray-500">Apr 10, 2025</p>
                           </div>
                        </div>
                        <span class="text-red-600 font-medium">-$25.00</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Your Services -->
         <div>
            <div class="flex justify-between items-center mb-4">
               <h2 class="text-xl font-semibold text-gray-900">Your Services</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
               <div class="bg-white rounded-lg shadow-sm p-5">
                  <div class="flex items-start">
                     <div
                        class="flex-shrink-0 h-10 w-10 rounded-md bg-blue-50 flex items-center justify-center text-primary">
                        <i class="fas fa-credit-card"></i>
                     </div>
                     <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Virtual Card</h3>
                        <p class="mt-1 text-sm text-gray-500">Create a virtual card for online shopping with
                           enhanced security.</p>
                        <div class="mt-3">
                           <a href="order-card.html"
                              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                              Order Now
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="bg-white rounded-lg shadow-sm p-5">
                  <div class="flex items-start">
                     <div
                        class="flex-shrink-0 h-10 w-10 rounded-md bg-blue-50 flex items-center justify-center text-primary">
                        <i class="fas fa-university"></i>
                     </div>
                     <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Virtual Bank Account</h3>
                        <p class="mt-1 text-sm text-gray-500">Create a virtual bank account to receive payments
                           securely.</p>
                        <div class="mt-3">
                           <a href="create_virtual_account.php"
                              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                              Create Account
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</x-app-layout>