<nav class="bg-[#424874] px-2  w-full fixed top-0 text-[#F4EEFF] shadow-md z-40">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto py-3">
        <!-- Left Side - Logo and Menu Button -->
        <div class="flex items-center ml-2 space-x-2">
            <button @click="toggleSidebar" class="p-1 rounded-md hover:bg-gray-700 transition">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex items-center gap-1">
                <div class="bg-white/20 p-1 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold">Tech<span class="text-blue-600">Bazar</span></h1>
            </div>
        </div>
        <!-- Right Side - Icons and User Menu -->
        @auth
        <div class="flex items-center space-x-4">
            <!-- Notification Bell -->
          

            

            <!-- Quick Actions Dropdown -->
            <div class="relative">
                <button id="quickActionsButton" data-dropdown-toggle="quickActionsDropdown" class="p-2 rounded-full hover:bg-gray-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                
                <!-- Quick Actions Dropdown -->
                <div id="quickActionsDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-50">
                    <div class="p-3 border-b">
                        <h3 class="font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-2 p-2">
                        <a href="{{ route('supplier.index') }}" class="flex flex-col items-center p-3 rounded hover:bg-gray-100">
                            <div class="bg-blue-100 p-3 rounded-full mb-2">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Supplier</span>
                        </a>
                        <a href="{{route('product.index')}}" class="flex flex-col items-center p-3 rounded hover:bg-gray-100">
                            <div class="bg-green-100 p-3 rounded-full mb-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Products</span>
                        </a>
                        <a href="{{route('customer.index')}}" class="flex flex-col items-center p-3 rounded hover:bg-gray-100">
                            <div class="bg-purple-100 p-3 rounded-full mb-2">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Customers</span>
                        </a>
                        <a href="{{route('sales.history')}}" class="flex flex-col items-center p-3 rounded hover:bg-gray-100">
                            <div class="bg-yellow-100 p-3 rounded-full mb-2">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Sales History</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Profile Dropdown -->
            <div id="avatarButton" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                class="flex items-center gap-2 cursor-pointer border rounded-full p-1 transition-all duration-200 hover:bg-gray-700">
                <div
                    class="w-9 h-9 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex flex-col items-start mr-1">
                    <span class="text-sm font-medium text-[#F4EEFF]">{{ auth()->user()->name }}</span>
                    <span class="text-xs text-[#F4EEFF]/70">{{ auth()->user()->role }}</span>
                </div>
                <svg class="w-4 h-4 ml-1 text-[#F4EEFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            
            <!-- User Dropdown Menu -->
            <div id="userDropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div class="font-medium">{{ auth()->user()->name }}</div>
                    <div class="truncate">{{ auth()->user()->email }}</div>
                    <div class="text-xs text-gray-500 mt-1">Last login: {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->diffForHumans() : 'Never' }}</div>
                </div>
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    
                    <li>
                        <a href="{{route('manager.setting')}}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a>
                    </li>
                   
                </ul>
                <div class="py-1">
                    <a href="{{route('Userlogout')}}">
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sign out
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @endauth
    </div>
</nav>

<!-- Initialize Flowbite dropdowns -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all dropdowns
        const dropdowns = document.querySelectorAll('[data-dropdown-toggle]');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', function() {
                const targetId = this.getAttribute('data-dropdown-toggle');
                const target = document.getElementById(targetId);
                target.classList.toggle('hidden');
                
                // Close other dropdowns when opening a new one
                document.querySelectorAll('[data-dropdown-toggle]').forEach(otherDropdown => {
                    if (otherDropdown !== this) {
                        const otherTargetId = otherDropdown.getAttribute('data-dropdown-toggle');
                        const otherTarget = document.getElementById(otherTargetId);
                        otherTarget.classList.add('hidden');
                    }
                });
            });
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[data-dropdown-toggle]') && !event.target.closest('[id$="Dropdown"]')) {
                document.querySelectorAll('[id$="Dropdown"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    });
</script>