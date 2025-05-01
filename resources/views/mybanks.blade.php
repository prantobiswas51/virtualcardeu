<x-app-layout>

    <!-- Main Content -->
    <main class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Virtual Bank Accounts</h1>
                <a href="{{ route('order_banks') }}" class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Create Account
                </a>
            </div>

            <!-- Active Accounts -->
            <div class="mb-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Active Accounts</h2>
                <div id="active-accounts" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Active accounts will be loaded here -->
                </div>
            </div>

            <!-- Pending Accounts -->
            <div id="pending-accounts-section" class="mb-10" style="display: none;">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Pending Accounts</h2>
                <div id="pending-accounts" class="grid grid-cols-1 gap-4">
                    <!-- Pending accounts will be loaded here -->
                </div>
            </div>

            <!-- Empty State -->
            <div id="empty-state" class="text-center py-10 bg-white rounded-lg shadow-md" style="display: none;">
                <div class="inline-block rounded-full bg-blue-100 p-5 mb-4">
                    <i class="fas fa-university text-blue-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">No Virtual Accounts</h3>
                <p class="text-gray-600 mb-6">You don't have any virtual bank accounts yet. Get started by creating your first account.</p>
                <a href="create-bank.html" class="inline-block bg-primary hover:bg-secondary text-white px-6 py-2 rounded-lg">
                    Create Your First Account
                </a>
            </div>
        </div>
    </main>

    <!-- Account Details Modal -->
    <div id="account-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-90vh overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Account Details</h2>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div id="account-details" class="p-6">
                <!-- Account details will be displayed here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mock data for accounts
            // In a real app, this would come from an API
            const accounts = [
                {
                    id: 1,
                    account_name: "Personal Checking",
                    account_number: "4567890123456",
                    routing_number: "987654321",
                    account_type: "checking",
                    currency: "USD",
                    balance: 1250.75,
                    status: "active",
                    created_at: "2023-06-15"
                },
                {
                    id: 2,
                    account_name: "Business Account",
                    account_number: "9876543210123",
                    routing_number: "123456789",
                    account_type: "business",
                    currency: "EUR",
                    balance: 5430.20,
                    status: "active",
                    created_at: "2023-05-10"
                },
                {
                    id: 3,
                    account_name: "Savings Account",
                    account_number: "1234567890123",
                    routing_number: "456789123",
                    account_type: "savings",
                    currency: "GBP",
                    balance: 0.00,
                    status: "pending",
                    created_at: "2023-07-01"
                }
            ];
            
            // Display accounts
            displayAccounts(accounts);
            
            // Setup modal close button
            document.getElementById('close-modal').addEventListener('click', function() {
                document.getElementById('account-modal').style.display = 'none';
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('account-modal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
        
        function displayAccounts(accounts) {
            const activeAccountsEl = document.getElementById('active-accounts');
            const pendingAccountsEl = document.getElementById('pending-accounts');
            const pendingAccountsSectionEl = document.getElementById('pending-accounts-section');
            const emptyStateEl = document.getElementById('empty-state');
            
            // Clear containers
            activeAccountsEl.innerHTML = '';
            pendingAccountsEl.innerHTML = '';
            
            // Filter accounts by status
            const activeAccounts = accounts.filter(account => account.status === 'active');
            const pendingAccounts = accounts.filter(account => ['pending', 'processing', 'reviewing'].includes(account.status));
            
            // Show empty state if no accounts
            if (accounts.length === 0) {
                emptyStateEl.style.display = 'block';
                return;
            } else {
                emptyStateEl.style.display = 'none';
            }
            
            // Display active accounts
            if (activeAccounts.length > 0) {
                activeAccounts.forEach(account => {
                    activeAccountsEl.appendChild(createAccountCard(account));
                });
            } else {
                activeAccountsEl.innerHTML = '<p class="text-gray-500 col-span-2 text-center py-4">No active accounts found.</p>';
            }
            
            // Display pending accounts if any
            if (pendingAccounts.length > 0) {
                pendingAccountsSectionEl.style.display = 'block';
                pendingAccounts.forEach(account => {
                    pendingAccountsEl.appendChild(createPendingAccountRow(account));
                });
            } else {
                pendingAccountsSectionEl.style.display = 'none';
            }
        }
        
        function createAccountCard(account) {
            const accountCard = document.createElement('div');
            accountCard.className = 'bg-white rounded-lg shadow-md overflow-hidden';
            
            // Format account number with last 4 digits visible
            const maskedAccountNumber = '**** **** **** ' + account.account_number.slice(-4);
            
            // Format currency symbol
            let currencySymbol = '$';
            if (account.currency === 'EUR') currencySymbol = '€';
            if (account.currency === 'GBP') currencySymbol = '£';
            
            accountCard.innerHTML = `
                <div class="p-6 bg-gradient-to-r from-primary to-secondary text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm opacity-80">Account Name</p>
                            <h3 class="text-xl font-bold">${account.account_name}</h3>
                        </div>
                        <span class="uppercase text-xs font-semibold bg-white bg-opacity-20 px-2 py-1 rounded">
                            ${account.account_type}
                        </span>
                    </div>
                    <div class="mt-4 font-mono">
                        <p class="text-sm opacity-80">Account Number</p>
                        <p>${maskedAccountNumber}</p>
                    </div>
                </div>
                <div class="p-4 bg-white">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Available Balance</p>
                            <p class="text-2xl font-bold text-gray-800">${currencySymbol}${account.balance.toFixed(2)}</p>
                        </div>
                        <div>
                            <span class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Active
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <button class="view-details text-primary hover:text-secondary text-sm" data-id="${account.id}">
                            <i class="fas fa-eye mr-1"></i> View Details
                        </button>
                        <button class="text-primary hover:text-secondary text-sm">
                            <i class="fas fa-exchange-alt mr-1"></i> Transactions
                        </button>
                    </div>
                </div>
            `;
            
            // Add event listener to view details button
            accountCard.querySelector('.view-details').addEventListener('click', function() {
                showAccountDetails(account);
            });
            
            return accountCard;
        }
        
        function createPendingAccountRow(account) {
            const accountRow = document.createElement('div');
            accountRow.className = 'bg-white rounded-lg shadow-md p-4';
            
            // Determine status styling
            let statusClass = '';
            let statusIcon = '';
            
            switch (account.status) {
                case 'pending':
                    statusClass = 'bg-yellow-100 text-yellow-800';
                    statusIcon = '<i class="fas fa-clock mr-1"></i>';
                    break;
                case 'processing':
                    statusClass = 'bg-blue-100 text-blue-800';
                    statusIcon = '<i class="fas fa-cog fa-spin mr-1"></i>';
                    break;
                case 'reviewing':
                    statusClass = 'bg-purple-100 text-purple-800';
                    statusIcon = '<i class="fas fa-search mr-1"></i>';
                    break;
            }
            
            accountRow.innerHTML = `
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="mb-3 md:mb-0">
                        <h3 class="font-semibold text-gray-800">${account.account_name}</h3>
                        <p class="text-sm text-gray-500">
                            <span class="uppercase">${account.account_type}</span> - ${account.currency}
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4">
                        <span class="inline-flex items-center px-2 py-1 text-xs rounded-full ${statusClass}">
                            ${statusIcon} ${account.status.toUpperCase()}
                        </span>
                        <a href="#" class="inline-block text-primary hover:text-secondary text-sm">
                            <i class="fas fa-spinner fa-spin mr-1"></i> Track Status
                        </a>
                    </div>
                </div>
            `;
            
            return accountRow;
        }
        
        function showAccountDetails(account) {
            const modal = document.getElementById('account-modal');
            const detailsContainer = document.getElementById('account-details');
            
            // Format dates
            const createdDate = new Date(account.created_at).toLocaleDateString();
            
            // Format currency symbol
            let currencySymbol = '$';
            if (account.currency === 'EUR') currencySymbol = '€';
            if (account.currency === 'GBP') currencySymbol = '£';
            
            // Build modal content
            detailsContainer.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Account Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Account Name</p>
                                <p class="font-semibold">${account.account_name}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Account Type</p>
                                <p class="font-semibold capitalize">${account.account_type}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Currency</p>
                                <p class="font-semibold">${account.currency}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Created On</p>
                                <p class="font-semibold">${createdDate}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Account Details</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Account Number</p>
                                <div class="flex items-center">
                                    <p class="font-mono font-semibold">${account.account_number}</p>
                                    <button class="ml-2 text-gray-500 hover:text-primary" onclick="copyToClipboard('${account.account_number}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Routing Number</p>
                                <div class="flex items-center">
                                    <p class="font-mono font-semibold">${account.routing_number}</p>
                                    <button class="ml-2 text-gray-500 hover:text-primary" onclick="copyToClipboard('${account.routing_number}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Available Balance</p>
                                <p class="text-2xl font-bold text-primary">${currencySymbol}${account.balance.toFixed(2)}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <button class="bg-primary hover:bg-secondary text-white py-2 px-4 rounded">
                            <i class="fas fa-plus mr-2"></i> Deposit Funds
                        </button>
                        <button class="bg-white border border-primary text-primary hover:bg-gray-50 py-2 px-4 rounded">
                            <i class="fas fa-exchange-alt mr-2"></i> Transfer Money
                        </button>
                        <button class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 py-2 px-4 rounded">
                            <i class="fas fa-file-invoice-dollar mr-2"></i> Statements
                        </button>
                    </div>
                </div>
            `;
            
            // Show modal
            modal.style.display = 'flex';
        }
        
        function copyToClipboard(text) {
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            
            // Could show a toast notification here
            alert('Copied to clipboard!');
        }
    </script>


</x-app-layout>