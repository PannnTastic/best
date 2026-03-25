@extends('layouts.app')

@section('title', 'Best - Solusi Lengkap Bangunan Anda')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gray-900 h-[500px] overflow-hidden z-20" x-data="heroSlider()" x-init="init()">
    <!-- Background Images -->
    <div class="absolute inset-0 z-0">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlide === index"
                 x-transition:enter="transition-opacity duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0">
                <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
            </div>
        </template>
    </div>
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#0F3075]/80 to-[#0F3075]/40 z-10"></div>
    
    <!-- Content -->
    <div class="container mx-auto px-4 h-full flex items-center relative z-20">
        <div class="max-w-xl text-white">
            <h2 class="text-orange-400 font-bold uppercase tracking-wide mb-2" x-text="slides[currentSlide].subtitle">Produk Terlaris</h2>
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4" x-text="slides[currentSlide].title">Temukan material terbaik untuk proyek konstruksi Anda</h1>
            <a href="{{ route('products.index') }}" class="inline-block bg-white text-[#0F3075] font-bold py-3 px-8 rounded hover:bg-gray-100 transition">
                Lihat Produk
            </a>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button @click="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white backdrop-blur-sm transition z-30">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white backdrop-blur-sm transition z-30">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Slider Dots -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-30">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="goToSlide(index)" 
                    :class="{'bg-white': currentSlide === index, 'bg-white/50': currentSlide !== index}"
                    class="w-2 h-2 rounded-full transition-all duration-300 hover:bg-white"></button>
        </template>
    </div>
</div>

<script>
function heroSlider() {
    return {
        currentSlide: 0,
        slides: [
            {
                image: 'https://images.unsplash.com/photo-1581094794329-cd8119699f82?q=80&w=2600&auto=format&fit=crop',
                title: 'Temukan material terbaik untuk proyek konstruksi Anda',
                subtitle: 'Produk Terlaris'
            },
            {
                image: 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2600&auto=format&fit=crop',
                title: 'Kualitas Terjamin untuk Bangunan Anda',
                subtitle: 'Garansi Resmi'
            },
            {
                image: 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2600&auto=format&fit=crop',
                title: 'Solusi Lengkap Kebutuhan Konstruksi',
                subtitle: 'One Stop Solution'
            }
        ],
        autoplayInterval: null,
        
        init() {
            this.startAutoplay();
        },
        
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            this.resetAutoplay();
        },
        
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            this.resetAutoplay();
        },
        
        goToSlide(index) {
            this.currentSlide = index;
            this.resetAutoplay();
        },
        
        startAutoplay() {
            this.autoplayInterval = setInterval(() => {
                this.nextSlide();
            }, 5000); // Ganti slide setiap 5 detik
        },
        
        resetAutoplay() {
            clearInterval(this.autoplayInterval);
            this.startAutoplay();
        }
    }
}
</script>

<!-- Features -->
<div class="container mx-auto px-4 pt-12 relative z-10 mb-20">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Feature 1 -->
        <div class="bg-white p-6 rounded-xl shadow-sm flex flex-col justify-center h-48 border border-gray-100">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-[#0F3075] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h3 class="font-bold text-slate-900 mb-1">Katalog Digital</h3>
            <p class="text-gray-500 text-sm">Akses katalog produk kami secara online</p>
        </div>
        <!-- Feature 2 -->
        <div class="bg-white p-6 rounded-xl shadow-sm flex flex-col justify-center h-48 border border-gray-100">
            <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="font-bold text-slate-900 mb-1">Produk Terjamin</h3>
            <p class="text-gray-500 text-sm">Semua produk bergaransi resmi</p>
        </div>
        <!-- Feature 3 -->
        <div class="bg-white p-6 rounded-xl shadow-sm flex flex-col justify-center h-48 border border-gray-100">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-[#0F3075] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="font-bold text-slate-900 mb-1">Harga Kompetitif</h3>
            <p class="text-gray-500 text-sm">Dapatkan harga terbaik dengan sistem pembelian grosir</p>
        </div>
        <!-- Feature 4 -->
        <div class="bg-white p-6 rounded-xl shadow-sm flex flex-col justify-center h-48 border border-gray-100">
            <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <h3 class="font-bold text-slate-900 mb-1">Tips & Inspirasi</h3>
            <p class="text-gray-500 text-sm">Dapatkan ide, panduan, dan artikel bermanfaat dari kami</p>
        </div>
    </div>
</div>

<!-- Promo Banner - Katalog Produk Terlengkap -->
<div class="container mx-auto px-4 mb-20">
    <div class="bg-[#0F3075] rounded-3xl overflow-hidden relative min-h-[400px] flex items-center">
        <!-- Abstract Shape -->
        <div class="absolute right-0 top-0 bottom-0 w-2/3 bg-white skew-x-12 translate-x-20 z-0"></div>
        
        <div class="relative z-10 w-full grid grid-cols-1 md:grid-cols-2 gap-8 items-center p-12">
            <div class="text-white">
                <h2 class="text-4xl font-bold mb-4">Katalog Produk Terlengkap</h2>
                <p class="text-blue-100 mb-8 max-w-md">Akses spesifikasi lengkap, cara pemasangan, dan inspirasi proyek dalam satu genggaman. Unduh katalog resmi kami untuk perencanaan yang lebih matang.</p>
                <a href="{{ route('brosur') }}" class="bg-white text-[#0F3075] font-bold py-3 px-8 rounded hover:bg-gray-100 transition inline-block">
                    Lihat Selengkapnya
                </a>
            </div>
            <div class="hidden md:flex justify-center gap-4">
                 <!-- Catalog Images -->
                 <div class="w-36 h-48 bg-gray-200 rounded-lg shadow-lg transform -rotate-6 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=300&h=400&fit=crop" alt="Katalog" class="w-full h-full object-cover">
                 </div>
                 <div class="w-36 h-48 bg-gray-200 rounded-lg shadow-lg transform -translate-y-4 z-10 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=300&h=400&fit=crop" alt="Katalog" class="w-full h-full object-cover">
                 </div>
                 <div class="w-36 h-48 bg-gray-200 rounded-lg shadow-lg transform rotate-6 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=300&h=400&fit=crop" alt="Katalog" class="w-full h-full object-cover">
                 </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="container mx-auto px-4 mb-20">
    <h2 class="text-3xl font-bold text-[#0F3075] mb-4">Kenapa Memilih BEST?</h2>
    <p class="text-gray-600 max-w-3xl mb-12">
        Kami berkomitmen menjadi mitra konstruksi yang dapat diandalkan. Dengan pengalaman bertahun-tahun, <span class="text-[#0F3075] font-semibold">PT. Berkah Sekawan Tangguh</span> menjamin ketersediaan material berkualitas tinggi yang telah teruji, demi kekokohan dan keindahan bangunan Anda jangka panjang.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-orange-400 to-orange-500 p-8 rounded-2xl text-white">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mb-4">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
               </svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Produk Original</h3>
            <p class="text-orange-100 text-sm">Kami hanya menyediakan produk asli dari merek terkemuka yang telah tersertifikasi SNI dan bergaransi resmi pabrik.</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-8 rounded-2xl text-white transform md:-translate-y-4">
             <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mb-4">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
               </svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Konsultasi Teknis</h3>
            <p class="text-orange-100 text-sm">Bingung menghitung kebutuhan? Tim ahli kami siap membantu estimasi dan pemilihan spesifikasi produk.</p>
        </div>
        <div class="bg-gradient-to-br from-orange-600 to-orange-700 p-8 rounded-2xl text-white">
             <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mb-4">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
               </svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Transaksi Mudah</h3>
            <p class="text-orange-100 text-sm">Proses pemesanan yang fleksibel, respon cepat via WhatsApp, & berbagai metode pembayaran yang memudahkan transaksi Anda.</p>
        </div>
    </div>
</div>

<!-- Product Best Sections -->
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-3xl font-bold text-[#0F3075]">Produk Terlaris</h2>
            <a href="{{ route('products.index') }}" class="border border-gray-300 text-gray-600 hover:border-[#0F3075] hover:text-[#0F3075] font-medium py-2 px-6 rounded-lg transition">
                Lihat Semua
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                <a href="{{ route('products.show', $product->product_id) }}">
                    <div class="aspect-square bg-gray-200 relative overflow-hidden">
                        @if($product->pictures->count() > 0)
                            <img src="{{ asset('storage/' . $product->pictures->first()->path) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        
                        @if($product->stok < 5 && $product->stok > 0)
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Stok Menipis</div>
                        @endif
                    </div>
                </a>
                <div class="p-4">
                    <div class="flex items-center gap-1 mb-2">
                         <span class="text-orange-400 text-xs">★★★★★</span>
                         <span class="text-gray-400 text-xs">(4.8)</span>
                    </div>
                    <h3 class="font-medium text-slate-900 mb-1 truncate">{{ $product->nama_produk }}</h3>
                    <div class="text-slate-900 font-bold text-lg">
                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
