<nav class="bg-black p-2 w-full fixed top-0  text-white">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto px-4 py-3">
        <div>
            @auth
                <h2>Welcome, {{ Auth::user()->name }}</h2>
            @else
                <h2>Welcome, Guest</h2>
            @endauth

        </div>
        <div class="flex items-center justify-between space-x-6">

            <div class="relative">
                <button id="dropdownPaymentsButton" data-dropdown-toggle="dropdownClients"
                    class="inline-flex items-center hover:text-gray-300">
                    Customers
                    <svg class="w-4 h-4 font-semibold ml-1" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdownClients"
                    class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm">
                        <li><a href="{{route('customer.index')}}" class="block px-4 py-2 hover:bg-gray-100">Add
                                Customer</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Customers</a></li>
                    </ul>
                </div>
            </div>

            <!-- Quotes Dropdown -->
            <div class="relative">
                <button id="dropdownQuotesButton" data-dropdown-toggle="dropdownQuotes"
                    class="inline-flex items-center hover:text-gray-300">
                    Quotes
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdownQuotes"
                    class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm">
                        <li><a href="{{ route('quotes.create') }}" class="block px-4 py-2 hover:bg-gray-100">Create
                                Quote</a>
                        </li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Quotes</a></li>
                    </ul>
                </div>
            </div>

            <!-- Invoices Dropdown -->
            <div class="relative">
                <button id="dropdownInvoicesButton" data-dropdown-toggle="dropdownInvoices"
                    class="inline-flex items-center hover:text-gray-300">
                    Invoices
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdownInvoices"
                    class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm">
                        <li><a data-modal-target="default-modal-invoice" data-modal-toggle="default-modal-invoice"
                                href="#default-modal-invoice" class="block px-4 py-2 hover:bg-gray-100">Create
                                Invoice</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Invoices</a></li>
                    </ul>
                </div>
            </div>

            <!-- Payments Dropdown -->
            <div class="relative">
                <button id="dropdownPaymentsButton" data-dropdown-toggle="dropdownPayments"
                    class="inline-flex items-center hover:text-gray-300">
                    Payments
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdownPayments"
                    class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Enter Payment</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Payments</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Online Payment
                                Logs</a></li>
                    </ul>
                </div>
            </div>
            <div class="relative">
                <button id="dropdownPaymentsButton" data-dropdown-toggle="dropdownPruducts"
                    class="inline-flex items-center hover:text-gray-300">
                    Products
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdownPruducts"
                    class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm">
                        <li><a href="{{route('product.create')}}" class="block px-4 py-2 hover:bg-gray-100">Add Products</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Products</a></li>
                    </ul>
                </div>
            </div>
            <div class="relative">
                <button id="dropdownPaymentsButton" data-dropdown-toggle="dropdownTasks"
                    class="inline-flex items-center hover:text-gray-300">
                    Tasks
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdownTasks"
                    class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Add Task</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Tasks</a></li>
                    </ul>
                </div>
            </div>
            <div class="relative">
                <button id="dropdownPaymentsButton" data-dropdown-toggle="dropdownReports"
                    class="inline-flex items-center hover:text-gray-300">
                    Reports
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdownReports"
                    class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm">
                        <li><a href="#" class="block px-4 py-2 text-black hover:bg-gray-100">Invoice
                                Agining</a></li>
                        <li><a href="#" class="block px-4 py-2 text-black hover:bg-gray-100">Payment
                                History</a></li>
                        <li><a href="#" class="block px-4 py-2 text-black hover:bg-gray-100">Sale by
                                Client</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <form action="{{route('Userlogout')}}" method="post">
                    @csrf
                    <button type="submit" class="border px-2 py-0.5 rounded border-red-500">Logout</button>
                </form>
            </div>
        </div>

    </div>
</nav>