<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                sidebarOpen: true,
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                    localStorage.setItem('sidebarOpen', this.sidebarOpen);
                },
                init() {
                    const savedState = localStorage.getItem('sidebarOpen');
                    if (savedState !== null) {
                        this.sidebarOpen = savedState === 'true';
                    }
                }
            }));
        });
    </script>
    {!! ToastMagic::styles() !!}
</head>
<body class="bg-white" x-data="app" x-init="init()">
    <!-- Top Navigation -->
    @include('manager.components.navbar')
    <!-- Sidebar and Main Content -->
    <div class="flex pt-16">
        <!-- Sidebar -->
        @include('manager.components.sidebar')
        <!-- Main Content -->
        <main 
            class="flex-1 p-6 transition-all duration-300 ease-in-out"
            :class="sidebarOpen ? 'ml-[18%]' : 'ml-20'"
        >
            <div class="bg-[#F4EEFF] rounded-lg shadow-sm p-2">
                @section('content')
                @show
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    {!! ToastMagic::scripts() !!}
</body>
</html>