<aside
    class="fixed top-16 left-0 h-screen bg-[#F4EEFF] shadow-lg z-30 transition-all duration-300 ease-in-out scrollable-container overflow-y-auto"
    :class="sidebarOpen ? 'w-[13rem]' : 'w-16'">
    <nav class="flex flex-col p-2 space-y-1 text-sm font-medium">
        <!-- Dashboard -->
        <a href="{{ route('manager.dashboard') }}"
            class="flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
            <i class="fas fa-tachometer-alt text-indigo-500 group-hover:text-indigo-700 text-xl w-6 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Dashboard</span>
        </a>

        <!-- Customer Dropdown -->
        <div x-data="{ openCustomer: false }" class="relative">
            <button @click="openCustomer = !openCustomer"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-users text-blue-500 group-hover:text-blue-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Customers</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openCustomer }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openCustomer && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="{{ route('customer.create') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Add
                    Customer</a>
                <a href="{{ route('customer.index') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">View
                    Customers</a>
            </div>
        </div>


        <!-- Supplier Link -->
        <div class="relative">
            <a href="{{ route('supplier.index') }}"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-truck text-teal-500 group-hover:text-teal-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Suppliers</span>
            </a>
        </div>
        <!-- Products Dropdown -->
        <div x-data="{ openProduct: false }" class="relative">
            <button @click="openProduct = !openProduct"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-boxes text-orange-500 group-hover:text-orange-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Products</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openProduct }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openProduct && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="{{ route('product.create') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Add
                    Product</a>
                <a href="{{ route('product.index') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">View
                    Products</a>
                <a href="{{ route('category.index') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Categories</a>
            </div>
        </div>

        <!-- Purchase Dropdown -->
        <div x-data="{ openPurchase: false }" class="relative">
            <button @click="openPurchase = !openPurchase"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-shopping-cart text-amber-500 group-hover:text-amber-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Purchases</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openPurchase }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openPurchase && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="{{ route('purchase.create') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Add
                    Purchase</a>
                <a href="{{ route('purchase.index') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">View
                    Purchases</a>
            </div>
        </div>

        <!-- Sales Dropdown -->
        <div x-data="{ openSales: false }" class="relative">
            <button @click="openSales = !openSales"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-chart-line text-green-500 group-hover:text-green-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen" class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Sales</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openSales }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openSales && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="#"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">New
                    Sale</a>
                <a href="#"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Sales
                    History</a>
            </div>
        </div>

        <!-- Quotations Dropdown -->
        <div x-data="{ openQuotations: false }" class="relative">
            <button @click="openQuotations = !openQuotations"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i
                    class="fas fa-file-invoice-dollar text-cyan-500 group-hover:text-cyan-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Quotations</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openQuotations }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openQuotations && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="{{ route('createQuotation') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Create
                    Quotation</a>
                <a href="{{ route('showQuotation') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">View
                    Quotations</a>
            </div>
        </div>

        <!-- Invoices Dropdown -->
        <div x-data="{ openInvoices: false }" class="relative">
            <button @click="openInvoices = !openInvoices"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-file-alt text-red-500 group-hover:text-red-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Invoices</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openInvoices }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openInvoices && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="{{ route('createInvoice') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Create
                    Invoice</a>
                <a href="{{ route('showInvoice') }}"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">View
                    Invoices</a>
            </div>
        </div>

        <!-- Payments Dropdown -->
        <div x-data="{ openPayments: false }" class="relative">
            <button @click="openPayments = !openPayments"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-credit-card text-lime-500 group-hover:text-lime-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Payments</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openPayments }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openPayments && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="#"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Record
                    Payment</a>
                <a href="#"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Payment
                    History</a>
            </div>
        </div>

        <!-- Reports Dropdown -->
        <div x-data="{ openReports: false }" class="relative">
            <button @click="openReports = !openReports"
                class="w-full flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
                <i class="fas fa-chart-pie text-violet-500 group-hover:text-violet-700 text-xl w-6 text-center"></i>
                <span x-show="sidebarOpen"
                    class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Reports</span>
                <i x-show="sidebarOpen" :class="{ 'transform rotate-180': openReports }"
                    class="fas fa-chevron-down ml-auto text-xs text-gray-500 transition-transform duration-200"></i>
            </button>
            <div x-show="openReports && sidebarOpen" x-transition class="ml-9 mt-1 space-y-1">
                <a href="#"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Sales
                    Reports</a>
                <a href="#"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Inventory
                    Reports</a>
                <a href="#"
                    class="block px-3 py-2 text-sm rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-600 hover:text-gray-900">Financial
                    Reports</a>
            </div>
        </div>

        <!-- Settings -->
        <a href="{{ route('manager.setting') }}"
            class="flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all group">
            <i class="fas fa-cog text-gray-500 group-hover:text-gray-700 text-xl w-6 text-center"></i>
            <span x-show="sidebarOpen"
                class="ml-3 text-gray-700 group-hover:text-gray-900 font-medium">Settings</span>
        </a>
    </nav>

    <!-- Sidebar Toggle Hint -->
    <div x-show="!sidebarOpen" class="absolute bottom-4 left-0 right-0 text-center">
        <div class="text-xs text-gray-500 animate-pulse">Click to expand</div>
    </div>
</aside>

<style>
    .scrollable-container {
        overflow-y: auto;
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE/Edge */
    }

    .scrollable-container::-webkit-scrollbar {
        display: none;
        /* Chrome/Safari */
    }
</style>
