<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocker Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s ease;
            width: 80px;
        }
        .sidebar.expanded {
            width: 250px;
        }
        .sidebar-text {
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .sidebar.expanded .sidebar-text {
            opacity: 1;
        }
        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">
    <!-- Sidebar -->
    <div class="sidebar bg-indigo-800 text-white h-full fixed md:relative flex flex-col" id="sidebar">
        <!-- Close Button (visible when expanded) -->
        <button id="close-btn" class="hidden absolute top-4 right-4 text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
        
        <!-- Logo/Brand -->
        <div class="p-4 flex items-center justify-center md:justify-start border-b border-indigo-700">
            <i class="fas fa-rocket text-2xl"></i>
            <span class="sidebar-text ml-3 font-bold text-xl">Rocker</span>
        </div>
        
        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-4">
            <!-- Dashboard Section -->
            <div class="px-4 py-2">
                <div class="flex items-center">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="sidebar-text ml-3 font-medium">Dashboard</span>
                </div>
                <div class="mt-2 ml-8 pl-2 border-l border-indigo-700">
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Default</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Alternate</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Graphical</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Application</span>
                    </a>
                </div>
            </div>
            
            <!-- UI Elements Section -->
            <div class="px-4 py-2">
                <div class="flex items-center">
                    <i class="fas fa-paint-brush"></i>
                    <span class="sidebar-text ml-3 font-medium">UI ELEMENTS</span>
                </div>
                <div class="mt-2 ml-8 pl-2 border-l border-indigo-700">
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Widgets</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">eCommerce</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Components</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Content</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Icons</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-1 px-2 rounded">
                        <i class="fas fa-circle text-xs mr-3"></i>
                        <span class="sidebar-text">Froala Editor</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="p-4 border-t border-indigo-700">
            <div class="flex items-center">
                <i class="fas fa-cog"></i>
                <span class="sidebar-text ml-3">Settings</span>
            </div>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden ml-[80px] md:ml-0">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
            <!-- Left side - Search and menu button (mobile) -->
            <div class="flex items-center">
                <button class="md:hidden text-gray-500 mr-2" id="mobile-menu-button">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            
            <!-- Right side - User and notifications -->
            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-gray-700 relative">
                    <i class="fas fa-bell"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                </button>
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-envelope"></i>
                </button>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="User" class="h-8 w-8 rounded-full">
                    <span class="ml-2 hidden md:inline">John Doe</span>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Orders -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500">Total Orders</p>
                            <p class="text-2xl font-bold mt-2">4,805</p>
                            <p class="text-green-500 text-sm mt-1">+2.8% from last week</p>
                        </div>
                        <i class="fas fa-shopping-cart text-indigo-500 text-xl"></i>
                    </div>
                </div>
                
                <!-- Total Revenue -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500">Total Revenue</p>
                            <p class="text-2xl font-bold mt-2">384,245</p>
                            <p class="text-green-500 text-sm mt-1">+5.4% from last week</p>
                        </div>
                        <i class="fas fa-dollar-sign text-indigo-500 text-xl"></i>
                    </div>
                </div>
                
                <!-- Bounce Rate -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500">Bounce Rate</p>
                            <p class="text-2xl font-bold mt-2">34.6%</p>
                            <p class="text-red-500 text-sm mt-1">-4.9% from last week</p>
                        </div>
                        <i class="fas fa-chart-line text-indigo-500 text-xl"></i>
                    </div>
                </div>
                
                <!-- Total Customers -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500">Total Customers</p>
                            <p class="text-2xl font-bold mt-2">8.4K</p>
                            <p class="text-green-500 text-sm mt-1">+8.4% from last week</p>
                        </div>
                        <i class="fas fa-users text-indigo-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-bold">Sales Overview</h2>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm bg-indigo-100 text-indigo-700 rounded">Sales</button>
                            <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded">Visits</button>
                        </div>
                    </div>
                    <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
                        <p class="text-gray-500">Sales Chart</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="font-bold mb-4">Trading Products</h2>
                    <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
                        <p class="text-gray-500">Products Chart</p>
                    </div>
                </div>
            </div>
            
            <!-- Products Section -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="font-bold mb-4">Featured Product</h2>
                <div class="flex items-center justify-center p-8 bg-gray-100 rounded">
                    <p class="text-xl font-bold">Jeans</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('close-btn');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        
        // Expand sidebar on hover (desktop)
        if (window.innerWidth >= 768) {
            sidebar.addEventListener('mouseenter', () => {
                sidebar.classList.add('expanded');
                closeBtn.classList.remove('hidden');
            });
        }
        
        // Close button functionality
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('expanded');
            closeBtn.classList.add('hidden');
        });
        
        // Mobile menu toggle
        mobileMenuButton.addEventListener('click', () => {
            if (sidebar.classList.contains('expanded')) {
                sidebar.classList.remove('expanded');
                closeBtn.classList.add('hidden');
            } else {
                sidebar.classList.add('expanded');
                closeBtn.classList.remove('hidden');
            }
        });
        
        // Close sidebar when clicking outside (mobile)
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768 && 
                sidebar.classList.contains('expanded') && 
                !sidebar.contains(e.target) &&
                e.target !== mobileMenuButton) {
                sidebar.classList.remove('expanded');
                closeBtn.classList.add('hidden');
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                // On desktop, ensure hover behavior
                sidebar.classList.remove('expanded');
                closeBtn.classList.add('hidden');
            }
        });
    </script>
</body>
</html>