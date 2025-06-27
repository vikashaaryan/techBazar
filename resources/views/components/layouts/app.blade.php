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
</head>

<body>
    @include('manager.components.navbar')

    <div class="flex gap-5 w-full ">
        <div class="w-2/12">
            @include('manager.components.sidebar')
        </div>
        <div class="w-10/12 mt-24">
            {{ $slot }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @livewireScripts
    {!! ToastMagic::scripts() !!}
</body>

</html>