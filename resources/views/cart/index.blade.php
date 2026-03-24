@extends('layouts.app')

@section('title', 'Keranjang Belanja - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">KERANJANG BELANJA</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4">
        @if($cart && $cart->products->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart->products as $product)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col sm:flex-row gap-6 items-start sm:items-center">
                    <!-- Image -->
                    <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                        @if($product->pictures->first())
                            <img src="{{ asset('storage/' . $product->pictures->first()->path) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Details -->
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-slate-900">
                            <a href="{{ route('products.show', $product->product_id) }}" class="hover:text-[#0F3075]">{{ $product->nama_produk }}</a>
                        </h3>
                        <p class="text-gray-500 text-sm mb-2">{{ $product->category->category_name ?? 'Umum' }}</p>
                        <div class="text-[#0F3075] font-bold">
                            Rp{{ number_format($product->harga, 0, ',', '.') }}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col items-end gap-4">
                        <form action="{{ route('cart.update', $product->product_id) }}" method="POST" class="flex items-center border border-gray-300 rounded-lg">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $product->pivot->jumlah_produk }}" min="1" max="{{ $product->stok }}" class="w-16 p-2 text-center text-sm focus:outline-none rounded-l-lg" onchange="this.form.submit()">
                            <span class="bg-gray-50 text-gray-400 px-3 text-xs border-l">Qty</span>
                        </form>
                        
                        <form action="{{ route('cart.destroy', $product->product_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                    <h2 class="font-bold text-xl text-slate-900 mb-6">Ringkasan Belanja</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Item</span>
                            <span>{{ $cart->products->sum('pivot.jumlah_produk') }} barang</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-slate-900 pt-4 border-t">
                            <span>Total Harga</span>
                            <span>
                                @php
                                    $total = $cart->products->sum(function($product) {
                                        return $product->harga * $product->pivot->jumlah_produk;
                                    });
                                @endphp
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition mb-4">
                        Checkout Sekarang
                    </button>
                    
                    <a href="{{ route('products.index') }}" class="block text-center text-[#0F3075] hover:underline text-sm">
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center max-w-2xl mx-auto">
            <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 text-[#0F3075]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Keranjang Anda Kosong</h2>
            <p class="text-gray-500 mb-8">Wah, sepertinya Anda belum memilih produk apapun.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-[#0F3075] text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-900 transition">
                Mulai Belanja
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
