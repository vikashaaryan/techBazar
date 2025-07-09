<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @livewireStyles
    {!! ToastMagic::styles() !!}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
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
    <!-- Your existing styles -->
</head>

<body class="bg-white" x-data="app" x-init="init()">
    @include('manager.components.navbar')

    <div class="flex ">
        <!-- Sidebar -->
        @include('manager.components.sidebar')
        
        <!-- Main Content -->
        <main 
            class="flex-1 p-6 transition-all duration-300 ease-in-out"
            :class="sidebarOpen ? 'ml-[18%]' : 'ml-20'"
        >
            {{ $slot }}
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @livewireScripts
    {!! ToastMagic::scripts() !!}
</body>
</html>