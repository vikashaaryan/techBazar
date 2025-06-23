<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }}</title>
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
        .dropdown-icon {
            transition: transform 0.2s ease;
        }

        .dropdown-toggle.active .dropdown-icon {
            transform: rotate(180deg);
        }

        .dropdown-content {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .sidebar {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 60px;
        }

        .sidebar:hover:not(.locked),
        .sidebar.expanded {
            width: 250px;
        }

        .sidebar-text {
            opacity: 0;
            transition: opacity 0.2s ease 0.1s;
            pointer-events: none;
        }

        .sidebar:hover:not(.locked) .sidebar-text,
        .sidebar.expanded .sidebar-text {
            opacity: 1;
            pointer-events: auto;
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

        @media (max-width: 768px) {
            .sidebar {
                width: 260px;
                left: -260px;
                position: fixed;
            }

            .sidebar.expanded {
                left: 0;
            }

            .sidebar-text {
                opacity: 1;
            }
        }

        .logo-container {
            position: relative;
        }

        .lock-indicator {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background-color: rgba(14, 165, 233, 0.9);
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            color: white;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-dark-900 text-gray-800 dark:text-gray-200 flex h-screen overflow-auto">
    <!-- Sidebar -->
    @include('partials.admin.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-y-scroll ml-[80px] md:ml-0 transition-all duration-300">
        <!-- Navbar -->
        @include('partials.admin.navbar')

        <div class="p-7 mt-16">
            {{ $slot }}
        </div>

    </div>
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('expanded');
        });

        // Theme toggle
        document.getElementById('theme-toggle').addEventListener('click', function () {
            document.documentElement.classList.toggle('dark');

            // Save preference to localStorage
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });

        // Check for saved theme preference
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuButton = document.getElementById('mobile-menu-button');

            if (window.innerWidth < 768 && !sidebar.contains(event.target) && event.target !== mobileMenuButton) {
                sidebar.classList.remove('expanded');
            }
        });

        // Sidebar lock functionality - attached to logo button
        const logoBtn = document.getElementById('logo-btn');
        const lockIndicator = document.getElementById('lock-indicator');
        const sidebar = document.getElementById('sidebar');

        // Check for saved sidebar state
        if (localStorage.getItem('sidebarLocked') === 'true') {
            sidebar.classList.add('locked', 'expanded');
            lockIndicator.classList.remove('hidden');
        }

        logoBtn.addEventListener('click', function (e) {
            // Prevent triggering when clicking on the logo itself (only want the button)
            if (e.target === logoBtn || e.target.closest('#logo-btn')) {
                sidebar.classList.toggle('locked');

                if (sidebar.classList.contains('locked')) {
                    // Lock the sidebar in expanded state
                    sidebar.classList.add('expanded');
                    lockIndicator.classList.remove('hidden');
                    localStorage.setItem('sidebarLocked', 'true');
                } else {
                    // Unlock the sidebar
                    sidebar.classList.remove('expanded');
                    lockIndicator.classList.add('hidden');
                    localStorage.setItem('sidebarLocked', 'false');
                }
            }
        });

        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function () {
                // Toggle active class on the clicked dropdown
                this.classList.toggle('active');

                // Get the corresponding content
                const content = this.nextElementSibling;

                // Toggle the content visibility
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.style.maxHeight = content.scrollHeight + 'px';
                } else {
                    content.style.maxHeight = '0';
                    // Wait for transition to complete before adding hidden class
                    setTimeout(() => {
                        content.classList.add('hidden');
                    }, 300);
                }

            });
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @livewireScripts
</body>

</html>