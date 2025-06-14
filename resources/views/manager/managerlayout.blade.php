<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <!-- Top Navbar -->
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
                            <li><a href="{{route('Addcustomer')}}" class="block px-4 py-2 hover:bg-gray-100">Add Customer</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Customers</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Quotes Dropdown -->
                <div class="relative">
                    <button id="dropdownQuotesButton" data-dropdown-toggle="dropdownQuotes"
                        class="inline-flex items-center hover:text-gray-300">
                        Quotes
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="dropdownQuotes"
                        class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm">
                            <li><a 
                                    href="{{ route('quotes.index') }}" class="block px-4 py-2 hover:bg-gray-100">Create Quote</a>
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
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
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
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
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
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="dropdownPruducts"
                        class="z-10 hidden absolute bg-white text-black divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Add Products</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">View Products</a></li>
                        </ul>
                    </div>
                </div>
                <div class="relative">
                    <button id="dropdownPaymentsButton" data-dropdown-toggle="dropdownTasks"
                        class="inline-flex items-center hover:text-gray-300">
                        Tasks
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
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
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
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

    <x-create-quote />

    <!-- invoice modal -->
    <div id="default-modal-invoice" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm ">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal-invoice">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its
                        citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25
                        and is meant to ensure a common set of data rights in the European Union. It requires
                        organizations to notify users as soon as possible of high-risk data breaches that could
                        personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal-invoice" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                        accept</button>
                    <button data-modal-hide="default-modal-invoice" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Laravel Blade Content Section -->
    @section('content')
    @show
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>
