@extends('layouts.app')

@section('title', 'Katalog Produk - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">PRODUK KAMI</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-8 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-[#0F3075]">Home</a>
            <span class="mx-2">&gt;</span>
            <span class="text-gray-900 font-medium">Produk</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar Filter -->
            <div class="hidden md:block">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-lg mb-4 text-[#0F3075] border-b pb-2">Kategori</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg text-sm {{ !request('category') ? 'bg-orange-50 text-orange-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                                Semua Kategori
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->query(), ['category' => $cat->category_id, 'page' => null])) }}" class="block px-3 py-2 rounded-lg text-sm {{ request('category') == $cat->category_id ? 'bg-orange-50 text-orange-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $cat->nama_kategori }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="md:col-span-3">
                <!-- Toolbar -->
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500">Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk</p>
                    
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <!-- Search -->
                        <form action="{{ route('products.index') }}" method="GET" class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                             @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                             @endif
                             <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="px-3 py-2 text-sm focus:outline-none w-48">
                             <button type="submit" class="bg-gray-100 hover:bg-gray-200 px-3 py-2 border-l border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                             </button>
                        </form>

                        <!-- Sorting -->
                        <form id="sortForm" action="{{ route('products.index') }}" method="GET">
                             @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                             @endif
                             @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                             @endif
                            <select name="sort" onchange="document.getElementById('sortForm').submit()" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#0F3075]">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group h-full flex flex-col">
                        <a href="{{ route('products.show', $product->product_id) }}">
                            <div class="aspect-square bg-gray-200 relative overflow-hidden">
                                @if($product->pictures->count() > 0)
                                    <img src="{{ asset('storage/' . $product->pictures->first()->path_gambar) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
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
                        <div class="p-4 flex-1 flex flex-col">
                            <div class="mb-2">
                                <span class="text-xs text-gray-500 uppercase">{{ $product->category->nama_kategori ?? 'Umum' }}</span>
                            </div>
                            <h3 class="font-bold text-slate-900 mb-1 truncate">
                                <a href="{{ route('products.show', $product->product_id) }}" class="hover:text-[#0F3075]">{{ $product->nama_produk }}</a>
                            </h3>
                            <div class="mt-auto pt-4 flex items-center justify-between">
                                <div class="text-[#0F3075] font-bold">
                                    Rp{{ number_format($product->harga, 0, ',', '.') }}
                                </div>
                                <a href="{{ route('products.show', $product->product_id) }}" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-[#0F3075] hover:text-white transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 font-medium">Produk tidak ditemukan.</p>
                        <a href="{{ route('products.index') }}" class="text-[#0F3075] hover:underline mt-2 inline-block">Reset Filter</a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
