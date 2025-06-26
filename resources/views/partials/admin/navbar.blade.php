<nav
    class="bg-white dark:bg-dark-800 border-b border-gray-200 dark:border-gray-700/50 px-6 py-3 flex items-center justify-between fixed w-[80%]">
    <!-- Left side - Search and menu button (mobile) -->
    <div class="flex items-center space-x-4">
        <button class="md:hidden text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white"
            id="mobile-menu-button">
            <i class="fas fa-bars"></i>
        </button>
        <div class="relative hidden md:block">
            <input type="text" placeholder="Search..."
                class="pl-10 pr-4 py-2 w-64 bg-gray-100 dark:bg-gray-700 border-none rounded-lg focus:ring-2 focus:ring-primary-500 focus:bg-white dark:focus:bg-gray-600 text-gray-700 dark:text-gray-200 transition">
            <div class="absolute left-3 top-2.5 text-gray-400">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    <!-- Right side - User and notifications -->
    <div class="flex items-center space-x-2">
        <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white relative">
            <i class="fas fa-bell text-xl"></i>
            <span class="notification-dot">3</span>
        </button>
        <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white relative">
            <i class="fas fa-envelope text-xl"></i>
            <span class="notification-dot">5</span>
        </button>

        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
            class=" h-7 rounded-full cursor-pointer" src="https://media.istockphoto.com/id/610003972/vector/vector-businessman-black-silhouette-isolated.jpg?s=612x612&w=0&k=20&c=Iu6j0zFZBkswfq8VLVW8XmTLLxTLM63bfvI6uXdkacM="
            alt="User dropdown">

        <!-- Dropdown menu -->
        <div id="userDropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                @auth
                @if(auth()->user()->isAdmin())
                    <div class="admin-name-display">
                        {{ auth()->user()->name }} <!-- This will show "Bonnie Green" for admin -->
                    </div>
                @endif
            @endauth
            @auth
            @if(auth()->user()->isAdmin())
                <div class="admin-name-display">
                    {{ auth()->user()->email }} <!-- This will show "Bonnie Green" for admin -->
                </div>
            @endif
        @endauth
            </div>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                <li>
                    <a href=""
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('manager.dashboard')}}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Manager Dashboard</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                </li>
            </ul>
            <div class="py-1">
                <a href="{{route('Userlogout')}}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                    out</a>
            </div>
        </div>

        <button id="theme-toggle" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">
            <i class="fas fa-moon dark:hidden"></i>
            <i class="fas fa-sun hidden dark:block"></i>
        </button>
    </div>
</nav>