<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Our Angels Primary School</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles()
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-900 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ route('adminDashboard') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        Our Angels Primary School
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    
                        <span></span>
                        <a href="{{ route('createStudent') }}" class="text-lg font-semibold text-gray-100 no-underline">
                            {{'Student'}}
                        </a>
                        <a href="{{ route('createStaff') }}" class="text-lg font-semibold text-gray-100 no-underline">
                            {{'Canteen Staff'}}
                        </a>
                        <a href="{{ route('verifyParent') }}" class="text-lg font-semibold text-gray-100 no-underline">
                            {{'Verify Parent'}}
                        </a>
                        <a href="{{ route('adminLogout') }}"
                           class="no-underline hover:underline">{{ __('Logout') }}</a>
                    
                    
                </nav>
            </div>
        </header>

        @yield('content')
        @livewireScripts
    </div>
</body>
</html>
