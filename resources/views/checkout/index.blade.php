@extends('layouts.app')

@section('title', 'Checkout - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">CHECKOUT</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Alamat & Produk -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Alamat Pengiriman -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#0F3075]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Alamat Pengiriman
                            </h2>
                            <a href="{{ route('profile.addresses') }}" class="text-sm text-[#0F3075] hover:underline">Kelola Alamat</a>
                        </div>
                        
                        @if($addresses->count() > 0)
                            <div class="space-y-3">
                                @foreach($addresses as $address)
                                <label class="flex items-start gap-3 p-4 border rounded-lg cursor-pointer hover:border-[#0F3075] transition {{ $address->is_primary ? 'border-[#0F3075] bg-blue-50' : 'border-gray-200' }}">
                                    <input type="radio" name="address_id" value="{{ $address->address_id }}" {{ $address->is_primary ? 'checked' : '' }} class="mt-1 w-4 h-4 text-[#0F3075] border-gray-300 focus:ring-[#0F3075]">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-semibold text-slate-900">{{ $address->label ?? 'Alamat' }}</span>
                                            @if($address->is_primary)
                                                <span class="text-xs bg-[#0F3075] text-white px-2 py-0.5 rounded">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-gray-600 text-sm">{{ $address->alamat_lengkap }}</p>
                                        <p class="text-gray-500 text-sm">{{ $address->kecamatan }}, {{ $address->kota }}, {{ $address->provinsi }} {{ $address->kode_pos }}</p>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-lg">
                                <p class="text-gray-500 mb-4">Anda belum memiliki alamat tersimpan</p>
                                <a href="{{ route('profile.addresses.create') }}" class="inline-block bg-[#0F3075] text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition">
                                    Tambah Alamat
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Produk yang Dibeli -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#0F3075]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Produk yang Dibeli
                        </h2>
                        
                        <div class="space-y-4">
                            @foreach($cart->products as $product)
                            <div class="flex gap-4 pb-4 border-b last:border-0">
                                <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($product->pictures->first())
                                        <img src="{{ asset('storage/' . $product->pictures->first()->path) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-slate-900">{{ $product->nama_produk }}</h3>
                                    <p class="text-gray-500 text-sm">{{ $product->category->category_name ?? 'Umum' }}</p>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-gray-600 text-sm">Qty: {{ $product->pivot->jumlah_produk }}</span>
                                        <span class="font-bold text-[#0F3075]">Rp{{ number_format($product->harga * $product->pivot->jumlah_produk, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="text-lg font-bold text-slate-900 mb-4">Catatan Pesanan (Opsional)</h2>
                        <textarea name="catatan" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075]" placeholder="Tambahkan catatan khusus untuk pesanan Anda..."></textarea>
                    </div>
                </div>

                <!-- Right Column - Ringkasan -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <h2 class="font-bold text-xl text-slate-900 mb-6">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Item</span>
                                <span>{{ $cart->products->sum('pivot.jumlah_produk') }} barang</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkir</span>
                                <span class="text-orange-500">Dihitung manual</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-slate-900 pt-4 border-t">
                                <span>Total</span>
                                <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-lg transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Pesan via WhatsApp
                        </button>
                        
                        <p class="text-xs text-gray-500 mt-4 text-center">
                            Dengan mengklik tombol di atas, Anda akan diarahkan ke WhatsApp untuk melanjutkan pembayaran.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
