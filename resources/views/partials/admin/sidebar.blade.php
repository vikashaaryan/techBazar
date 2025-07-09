<div class="sidebar bg-dark-800 text-white h-screen fixed md:relative flex  flex-col z-20" id="sidebar">
    <!-- Logo/Brand - Now with lock functionality -->
    <div class="p-4 flex items-center justify-center md:justify-start border-b border-gray-700/50 logo-container"
        id="logo-container">
        <div class="bg-gray-700 px-2 py-1 rounded-lg cursor-pointer" id="logo-btn">
            <i class="fa-solid fa-bolt" id="logo-icon"></i>
            <div class="lock-indicator hidden" id="lock-indicator">
                <i class="fas fa-lock"></i>
            </div>
        </div>
        <span class="sidebar-text ml-3 font-bold text-xl">{{env('APP_NAME')}} | Admin</span>
    </div>

    <div class="flex-1 scrollable-containeroverflow-y-auto py-4">
        <!-- Dashboard Section -->
        <div class="px-4 py-2">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fas fa-tachometer-alt text-lg"></i>
                    <span class="sidebar-text ml-3 font-medium">Dashboard</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <x-sidebar-link wire:navigate href="{{route('admin.dashboard')}}" icon="fas fa-circle" active="admin.dashboard">
                    Sales Summary
                </x-sidebar-link>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Top Products</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Due & Alerts</span>
                </a>
            </div>
        </div>

        <!-- Sales Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span class="sidebar-text ml-3 font-medium">Sales</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <x-sidebar-link wire:navigate href="{{route('admin.sales')}}" icon="fas fa-circle" active="admin.sales">
                    Top Selling
                </x-sidebar-link>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Sales Histroy</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Sales Returns</span>
                </a>
            </div>
        </div>

        <!-- Purchase Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-shop"></i>
                    <span class="sidebar-text ml-3 font-medium">Purchases</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Add Purchase</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Purchase History</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Due Purchases</span>
                </a>
            </div>
        </div>

        <!-- Customers Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-users"></i>
                    <span class="sidebar-text ml-3 font-medium">Customers</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">All Customers</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Add Customer</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">OutStanding Payemnts</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Kanban</span>
                </a>
            </div>
        </div>

        <!-- Invoices Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-receipt"></i>
                    <span class="sidebar-text ml-3 font-medium">Invoices</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">All Invoices</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Print / Email</span>
                </a>
            </div>
        </div>

        <!-- Quotes Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="sidebar-text ml-3 font-medium">Quotes</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">All Quotes</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Recent Quotes</span>
                </a>
            </div>
        </div>
        <!-- Products Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="sidebar-text ml-3 font-medium">Products</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">All Products</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Add Product</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Categories / Brands</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Stock Alerts</span>
                </a>
            </div>
        </div>
        <!-- Payments Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    <span class="sidebar-text ml-3 font-medium">Payments</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">All Payments</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Add Payment</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Refund History</span>
                </a>
            </div>
        </div>
        <!-- Settings Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-gear"></i>
                    <span class="sidebar-text ml-3 font-medium">Settings</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Business Info</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Taxes & Currency</span>
                </a>
                <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                    <i class="fas fa-circle text-[6px] mr-3"></i>
                    <span class="sidebar-text">Backup & Restore</span>
                </a>
            </div>
        </div>
        <!-- Staff / Manager Section -->
        <div class="px-4 py-2 mt-4">
            <div
                class="flex items-center justify-between text-gray-400 hover:text-white transition-colors cursor-pointer dropdown-toggle">
                <div class="flex items-center">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="sidebar-text ml-3 font-medium">Staff / Manager</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text dropdown-icon transition-transform"></i>
            </div>
            <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1 dropdown-content hidden">
                <x-sidebar-link wire:navigate href="{{route('admin.staff')}}" icon="fas fa-circle" active="admin.staff">
                    Add New Staff
                </x-sidebar-link>
            </div>
        </div>
    </div>
</div>
