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