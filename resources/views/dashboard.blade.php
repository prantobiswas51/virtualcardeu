<x-app-layout>
   <div class="wlt py-4">
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
               <td colspan="6" class="text-center text-white my-4 bg-red-600 py-2">No Transactions Found</td>
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
                  <button class="bg-green-800 p-1 px-2 rounded-md">{{ $transaction->status }}</button>
               </td>
               <td>{{ $transaction->type }}</td>
            </tr>
         </tbody>
         @endforeach
         @endif

      </table>



   </div>


</x-app-layout>