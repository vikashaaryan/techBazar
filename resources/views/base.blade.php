<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechBaza - Electric Shop Management System</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    {!! ToastMagic::styles() !!}

</head>

<body class="">
    <div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>
    <header class="bg-white  border-gray-300  shadow rounded m-3">  
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <a href="#" class="text-2xl font-bold text-gray-800 hover:text-blue-700 transition-colors">
                    Tech<span class="text-blue-700">Bazar</span>
                </a>
            </div>
            <nav class="flex gap-8">
                <a href="#" class="text-gray-700 text-lg font-medium hover:text-blue-700 transition-colors">
                    Home
                </a>
                <a href="#" class="text-gray-700 text-lg font-medium hover:text-blue-700 transition-colors">
                    About
                </a>
                <a href="#" class="text-gray-700 text-lg font-medium hover:text-blue-700 transition-colors">
                    Contact
                </a>
            </nav>
        </div>
    </header>

    @section('content')

    @show
    {!! ToastMagic::scripts() !!}
</body>

</html>
