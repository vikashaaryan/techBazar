<div class="fixed top-1.5 left-0 h-screen mt-16 bg-white text-black shadow-lg z-50 overflow-y-auto">
    <nav class="flex flex-col space-y-2 p-4 text-sm font-medium">
        <!-- Existing Links -->
        <a href="{{route('manager.dashboard')}}" class="flex items-center space-x-3 px-3 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m-4 0h4" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{route('customer.index')}}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A9.004 9.004 0 0112 15c2.21 0 4.21.804 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>Customer</span>
        </a>
        
        <!-- Manage Supplier -->
        <a href="{{route('supplier.index')}}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span> Supplier</span>
        </a>

        <a href="{{route('category.index')}}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>Category</span>
        </a>

        <!-- Manage Purchase -->
        <a href="{{route('purchase.index')}}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span> Purchase</span>
        </a>

        <!-- Manage Sales -->
        <a href="" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
            </svg>
            <span> Sales</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0H5m14 0a2 2 0 01-2 2H7a2 2 0 01-2-2" />
            </svg>
            <span>Quotation</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-4 4h4m4 0h-4a4 4 0 01-4-4V9a4 4 0 014-4h4" />
            </svg>
            <span>Invoices</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8c-1.1 0-2 .9-2 2 0 1.105.9 2 2 2s2-.895 2-2c0-1.1-.9-2-2-2zm0 4a4 4 0 00-4 4v1h8v-1a4 4 0 00-4-4z" />
            </svg>
            <span>Payments</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
            <span>Products</span>
        </a>

        <!-- Return / Exchange -->
        <a href="/return-exchange" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
            <span>Return / Exchange</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Settings</span>
        </a>
    </nav>
</div>