<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 80px;
        }
        .sidebar.expanded {
            width: 260px;
        }
        .sidebar-text {
            opacity: 0;
            transition: opacity 0.2s ease 0.1s;
        }
        .sidebar.expanded .sidebar-text {
            opacity: 1;
        }
        .sidebar-item {
            transition: all 0.2s ease;
        }
        .sidebar-item:hover {
            background-color: rgba(14, 165, 233, 0.1);
            transform: translateX(2px);
        }
        .sidebar-item.active {
            background-color: rgba(14, 165, 233, 0.2);
            border-left: 3px solid #0ea5e9;
        }
        .chart-container {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .notification-dot {
            position: absolute;
            top: -0.25rem;
            right: -0.25rem;
            width: 1rem;
            height: 1rem;
            border-radius: 9999px;
            background-color: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            color: white;
        }
        .progress-bar {
            height: 0.5rem;
            border-radius: 0.25rem;
            background-color: rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 0.25rem;
            background: linear-gradient(90deg, #0ea5e9, #3b82f6);
            transition: width 0.5s ease;
        }
        .dark .apexcharts-tooltip {
            background: #1e293b !important;
            color: #fff !important;
            border: 1px solid #334155 !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="bg-gray-100 dark:bg-dark-900 text-gray-800 dark:text-gray-200 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="sidebar bg-dark-800 text-white h-full fixed md:relative flex flex-col z-20" id="sidebar">
        <!-- Close Button (visible when expanded) -->
        <button id="close-btn" class="hidden absolute top-4 right-4 text-gray-400 hover:text-white transition-colors">
            <i class="fas fa-times"></i>
        </button>
        
        <!-- Logo/Brand -->
        <div class="p-5 flex items-center justify-center md:justify-start border-b border-gray-700/50">
            <div class="bg-primary-600 p-2 rounded-lg">
                <i class="fas fa-cube text-xl text-white"></i>
            </div>
            <span class="sidebar-text ml-3 font-bold text-xl">Nexus</span>
        </div>
        
        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-4">
            <!-- Dashboard Section -->
            <div class="px-4 py-2">
                <div class="flex items-center text-gray-400 hover:text-white transition-colors cursor-pointer">
                    <i class="fas fa-tachometer-alt text-lg"></i>
                    <span class="sidebar-text ml-3 font-medium">Dashboard</span>
                </div>
                <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1">
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm active">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Analytics</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">eCommerce</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">CRM</span>
                    </a>
                </div>
            </div>
            
            <!-- Applications Section -->
            <div class="px-4 py-2 mt-4">
                <div class="flex items-center text-gray-400 hover:text-white transition-colors cursor-pointer">
                    <i class="fas fa-th text-lg"></i>
                    <span class="sidebar-text ml-3 font-medium">Applications</span>
                </div>
                <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1">
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Email</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Chat</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Calendar</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Kanban</span>
                    </a>
                </div>
            </div>
            
            <!-- UI Elements Section -->
            <div class="px-4 py-2 mt-4">
                <div class="flex items-center text-gray-400 hover:text-white transition-colors cursor-pointer">
                    <i class="fas fa-puzzle-piece text-lg"></i>
                    <span class="sidebar-text ml-3 font-medium">Components</span>
                </div>
                <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1">
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">UI Elements</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Forms</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Tables</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Charts</span>
                    </a>
                </div>
            </div>
            
            <!-- Pages Section -->
            <div class="px-4 py-2 mt-4">
                <div class="flex items-center text-gray-400 hover:text-white transition-colors cursor-pointer">
                    <i class="fas fa-file text-lg"></i>
                    <span class="sidebar-text ml-3 font-medium">Pages</span>
                </div>
                <div class="mt-2 ml-8 pl-2 border-l border-gray-700/50 space-y-1">
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Authentication</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">User Profile</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Pricing</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center py-2 px-2 rounded text-sm">
                        <i class="fas fa-circle text-[6px] mr-3"></i>
                        <span class="sidebar-text">Invoice</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="p-4 border-t border-gray-700/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-8 w-8 rounded-full">
                    <div class="sidebar-text ml-3">
                        <p class="text-sm font-medium">John Doe</p>
                        <p class="text-xs text-gray-400">Admin</p>
                    </div>
                </div>
                <button class="sidebar-text text-gray-400 hover:text-white">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden ml-[80px] md:ml-0 transition-all duration-300">
        <!-- Navbar -->
        <nav class="bg-white dark:bg-dark-800 border-b border-gray-200 dark:border-gray-700/50 px-6 py-3 flex items-center justify-between">
            <!-- Left side - Search and menu button (mobile) -->
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white" id="mobile-menu-button">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 w-64 bg-gray-100 dark:bg-gray-700 border-none rounded-lg focus:ring-2 focus:ring-primary-500 focus:bg-white dark:focus:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            
            <!-- Right side - User and notifications -->
            <div class="flex items-center space-x-6">
                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="notification-dot">3</span>
                </button>
                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white relative">
                    <i class="fas fa-envelope text-xl"></i>
                    <span class="notification-dot">5</span>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-9 w-9 rounded-full cursor-pointer" id="user-menu-button">
                        <span class="absolute bottom-0 right-0 bg-green-500 rounded-full w-2.5 h-2.5 border-2 border-white dark:border-dark-800"></span>
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-medium">John Doe</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
                    </div>
                </div>
                <button id="theme-toggle" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>
            </div>
        </nav>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Dashboard</h1>
                    <p class="text-gray-500 dark:text-gray-400">Welcome back, John! Here's what's happening with your store today.</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <button class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg flex items-center space-x-2 transition">
                        <i class="fas fa-plus"></i>
                        <span>Add New</span>
                    </button>
                    <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg flex items-center space-x-2 transition">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Revenue -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Revenue</p>
                            <p class="text-2xl font-bold mt-2">$48,568</p>
                            <div class="flex items-center mt-2">
                                <span class="text-green-500 text-sm font-medium flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> 12.5%
                                </span>
                                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-primary-600 dark:text-primary-400 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Total Orders -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Orders</p>
                            <p class="text-2xl font-bold mt-2">1,258</p>
                            <div class="flex items-center mt-2">
                                <span class="text-green-500 text-sm font-medium flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> 8.3%
                                </span>
                                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Customers -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Customers</p>
                            <p class="text-2xl font-bold mt-2">8,426</p>
                            <div class="flex items-center mt-2">
                                <span class="text-green-500 text-sm font-medium flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> 5.1%
                                </span>
                                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <i class="fas fa-users text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Conversion -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Conversion</p>
                            <p class="text-2xl font-bold mt-2">3.6%</p>
                            <div class="flex items-center mt-2">
                                <span class="text-red-500 text-sm font-medium flex items-center">
                                    <i class="fas fa-arrow-down mr-1"></i> 1.2%
                                </span>
                                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                            <i class="fas fa-chart-line text-yellow-600 dark:text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Revenue Chart -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <h2 class="text-lg font-bold">Revenue Overview</h2>
                        <div class="flex space-x-2 mt-3 sm:mt-0">
                            <button class="px-3 py-1 text-sm bg-primary-600 text-white rounded-lg">Month</button>
                            <button class="px-3 py-1 text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg">Week</button>
                            <button class="px-3 py-1 text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg">Day</button>
                        </div>
                    </div>
                    <div class="h-80">
                        <div id="revenue-chart" class="h-full w-full"></div>
                    </div>
                </div>
                
                <!-- Sales Chart -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <h2 class="text-lg font-bold">Sales by Category</h2>
                        <div class="flex items-center space-x-2 mt-3 sm:mt-0">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Show:</span>
                            <select class="bg-gray-100 dark:bg-gray-700 border-none text-sm rounded-lg px-3 py-1 focus:ring-2 focus:ring-primary-500">
                                <option>All Categories</option>
                                <option>Electronics</option>
                                <option>Fashion</option>
                                <option>Home & Garden</option>
                            </select>
                        </div>
                    </div>
                    <div class="h-80">
                        <div id="sales-chart" class="h-full w-full"></div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Orders & Top Products -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Recent Orders -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold">Recent Orders</h2>
                        <button class="text-primary-600 dark:text-primary-400 text-sm font-medium">View All</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Customer</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-dark-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">#NX-1564</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">John Smith</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">Completed</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">$128.00</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">#NX-1563</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">Sarah Johnson</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400">Processing</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">$256.50</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">#NX-1562</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">Michael Brown</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">Shipped</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">$89.99</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">#NX-1561</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">Emily Davis</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">Cancelled</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">$175.00</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">#NX-1560</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">Robert Wilson</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">Completed</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">$342.75</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Top Products -->
                <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold">Top Products</h2>
                        <button class="text-primary-600 dark:text-primary-400 text-sm font-medium">View All</button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium">Smartphone X</p>
                                    <p class="text-sm font-medium">$899</p>
                                </div>
                                <div class="mt-1">
                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>Electronics</span>
                                        <span>1,248 sold</span>
                                    </div>
                                    <div class="progress-bar mt-1">
                                        <div class="progress-fill" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-tshirt text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium">Premium T-Shirt</p>
                                    <p class="text-sm font-medium">$29</p>
                                </div>
                                <div class="mt-1">
                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>Fashion</span>
                                        <span>856 sold</span>
                                    </div>
                                    <div class="progress-bar mt-1">
                                        <div class="progress-fill" style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-headphones text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium">Wireless Headphones</p>
                                    <p class="text-sm font-medium">$199</p>
                                </div>
                                <div class="mt-1">
                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>Electronics</span>
                                        <span>723 sold</span>
                                    </div>
                                    <div class="progress-bar mt-1">
                                        <div class="progress-fill" style="width: 55%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-book text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium">Design Patterns</p>
                                    <p class="text-sm font-medium">$49</p>
                                </div>
                                <div class="mt-1">
                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>Books</span>
                                        <span>512 sold</span>
                                    </div>
                                    <div class="progress-bar mt-1">
                                        <div class="progress-fill" style="width: 45%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-blender text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium">Smart Blender</p>
                                    <p class="text-sm font-medium">$129</p>
                                </div>
                                <div class="mt-1">
                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>Home</span>
                                        <span>487 sold</span>
                                    </div>
                                    <div class="progress-bar mt-1">
                                        <div class="progress-fill" style="width: 40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Activity Timeline -->
            <div class="bg-white dark:bg-dark-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700/50 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold">Recent Activity</h2>
                    <button class="text-primary-600 dark:text-primary-400 text-sm font-medium">View All</button>
                </div>
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4">
                            <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-blue-600 dark:text-blue-400"></i>
                            </div>
                        </div>
                        <div class="flex-1 border-b border-gray-200 dark:border-gray-700 pb-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium">New order received</p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">2 min ago</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Order #NX-1578 from John Smith for $256.00</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4">
                            <div class="h-10 w-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                            </div>
                        </div>
                        <div class="flex-1 border-b border-gray-200 dark:border-gray-700 pb-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium">Order completed</p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">1 hour ago</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Order #NX-1575 has been delivered successfully</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4">
                            <div class="h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                <i class="fas fa-user-plus text-purple-600 dark:text-purple-400"></i>
                            </div>
                        </div>
                        <div class="flex-1 border-b border-gray-200 dark:border-gray-700 pb-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium">New customer registered</p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">3 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Michael Brown has created an account</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4">
                            <div class="h-10 w-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                        </div>
                        <div class="flex-1 border-b border-gray-200 dark:border-gray-700 pb-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium">Order issue reported</p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">5 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Order #NX-1572 has a shipping delay</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-4">
                            <div class="h-10 w-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                <i class="fas fa-times-circle text-red-600 dark:text-red-400"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium">Order cancelled</p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">8 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Order #NX-1569 has been cancelled by the customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('block');
    });
    document.getElementById('theme-toggle').addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
    });
    document.getElementById('user-menu-button').addEventListener('click', function() {
        const userMenu = document.getElementById('user-menu');
        userMenu.classList.toggle('hidden');
        userMenu.classList.toggle('block');
    });
</script>
</body>
</html>