<x-app-layout>
    <div class="bg-gray-800 p-8 rounded-lg mx-auto my-4 shadow-md w-full">
        <h2 class="text-2xl font-semibold text-gray-100 text-center mb-6">Contact Us</h2>
        
        <form action="#" method="POST" class="space-y-4">
            <!-- Name -->
            <div>
                <label class="block text-gray-200 font-medium">Full Name</label>
                <input type="text" name="name" required class="w-full mt-1 p-2 border border-gray-300 bg-gray-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-200 font-medium">Email</label>
                <input type="email" name="email" required class="w-full mt-1 p-2 border border-gray-300 bg-gray-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <!-- Phone (Optional) -->
            <div>
                <label class="block text-gray-200 font-medium">Phone (Optional)</label>
                <input type="tel" name="phone" class="w-full mt-1 p-2 border border-gray-300 bg-gray-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <!-- Type (Select) -->
            <div>
                <label class="block text-gray-200 font-medium">Type</label>
                <select name="type" required class="w-full mt-1 p-2 border border-gray-300 bg-gray-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="Deposit">Deposit</option>
                    <option value="Payout">Payout</option>
                    <option value="Cards">Cards</option>
                    <option value="Banks">Banks</option>
                </select>
            </div>

            <!-- Method (Select) -->
            <div>
                <label class="block text-gray-200 font-medium">Payment Method</label>
                <select name="method" required class="w-full mt-1 p-2 border border-gray-300 bg-gray-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="Paypal">Paypal</option>
                    <option value="Payeer">Payeer</option>
                    <option value="Crypto">Crypto</option>
                </select>
            </div>

            <!-- Message -->
            <div>
                <label class="block text-gray-200 font-medium">Message</label>
                <textarea name="message" rows="4" required class="w-full mt-1 p-2 border border-gray-300 bg-gray-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg font-medium hover:bg-blue-600 transition">Send Message</button>
        </form>
    </div>

    
 </x-app-layout>
 