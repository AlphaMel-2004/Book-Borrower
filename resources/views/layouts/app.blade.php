<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #10b981 0%, #059669 25%, #047857 50%, #065f46 75%, #064e3b 100%);
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .shadow-soft {
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }
            .hover-lift {
                transition: all 0.3s ease;
            }
            .hover-lift:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-emerald-50 to-green-100 min-h-screen">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="gradient-bg text-white shadow-soft">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="glass-effect rounded-2xl p-6 shadow-soft">
                            <h1 class="text-3xl font-bold tracking-tight text-white">
                                {{ $header }}
                            </h1>
                            <p class="mt-2 text-emerald-100 text-lg">
                                Welcome to your Book Borrower dashboard
                            </p>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-soft p-6 hover-lift">
                    {{ $slot }}
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="gradient-bg text-white mt-16">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p class="text-emerald-100">
                            © {{ date('Y') }} {{ config('app.name', 'Book Borrower') }}. All rights reserved.
                        </p>
                        <p class="text-emerald-200 text-sm mt-2">
                            Built with ❤️ using Laravel & Tailwind CSS
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
