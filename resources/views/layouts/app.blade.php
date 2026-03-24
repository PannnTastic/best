<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Best - Toko Bangunan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F9FAFB] text-slate-800">

    <!-- Header -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="container mx-auto px-4 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo-best.png') }}" alt="BEST Logo" class="h-10 w-auto">
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex gap-2 items-center text-sm font-medium">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded {{ request()->routeIs('home') ? 'bg-[#0F3075] text-white' : 'text-[#0F3075] hover:bg-gray-100' }}">
                    HOME
                </a>
                <span class="text-orange-400">/</span>
                <a href="{{ route('products.index') }}" class="px-4 py-2 rounded {{ request()->routeIs('products.*') ? 'bg-[#0F3075] text-white' : 'text-[#0F3075] hover:bg-gray-100' }}">
                    PRODUK
                </a>
                <span class="text-orange-400">/</span>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded {{ request()->routeIs('blog.*') ? 'bg-[#0F3075] text-white' : 'text-[#0F3075] hover:bg-gray-100' }}">
                    BLOG
                </a>
                <span class="text-orange-400">/</span>
                <a href="#" class="px-4 py-2 rounded text-[#0F3075] hover:bg-gray-100">
                    CONTACT US
                </a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="relative text-[#0F3075] hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(request()->user() && request()->user()->cart && request()->user()->cart->products->count() > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">
                            {{ request()->user()->cart->products->count() }}
                        </span>
                    @endif
                </a>
                <a href="#" class="text-[#0F3075] hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @if(session('success'))
            <div class="container mx-auto px-4 mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#0F3075] text-white pt-16 pb-8 mt-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Brand -->
                <div>
                    <div class="mb-4">
                        <img src="{{ asset('images/logo-best-white.png') }}" alt="BEST Logo" class="h-16 w-auto">
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        Solusi lengkap kebutuhan konstruksi Anda. PT. Berkah Sekawan Tangguh hadir memberikan material bangunan pilihan yang teruji kualitasnya, siap melayani pengiriman untuk proyek skala kecil hingga besar.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Navigasi -->
                <div>
                    <h3 class="text-orange-400 font-semibold mb-6">Navigasi</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Homepage</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white">Produk</a></li>
                        <li><a href="#" class="hover:text-white">Services</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                    </ul>
                </div>

                <!-- Akses Cepat -->
                <div>
                    <h3 class="text-orange-400 font-semibold mb-6">Akses Cepat</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li><a href="{{ route('products.index') }}" class="hover:text-white">Produk Terlaris</a></li>
                        <li><a href="{{ route('brosur') }}" class="hover:text-white">Brosur</a></li>
                        <li><a href="#" class="hover:text-white">Lorem Ipsum</a></li>
                        <li><a href="#" class="hover:text-white">Lorem Ipsum</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="text-orange-400 font-semibold mb-6">Kontak</h3>
                    <ul class="space-y-4 text-sm text-gray-300">
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            +62856 4567 6696
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            best.bsekawantangguh@gmail.com
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.083A1 1 0 006 4.586V4a1 1 0 00-1-1h-1a1 1 0 00-1 1v.586c0 .25.062.492.177.707.254.472.527 1.353.706 2.707zM3 10v6a1 1 0 001 1h1a1 1 0 001-1v-1.414l1.707 1.707a1 1 0 001.414 0L10 14.414l1.879 1.879a1 1 0 001.414 0L16 14.414V16a1 1 0 001 1h1a1 1 0 001-1v-6h-2c-.053 0-.105.003-.156.009A6.003 6.003 0 0110 17c-2.973 0-5.437-2.167-5.906-5.009A1.027 1.027 0 004 11.991V10H3z" clip-rule="evenodd"/></svg>
                            www.best.com
                        </li>
                        <li class="flex gap-3">
                            <svg class="w-4 h-4 text-orange-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span>Pergudangan Meiko Abadi 7, Blok E12, Wonoayu, Sidoarjo, East Java</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 text-center text-xs text-gray-400">
                &copy;2025 PT. Berkah Sekawan Tangguh
            </div>
        </div>
    </footer>
</body>
</html>
