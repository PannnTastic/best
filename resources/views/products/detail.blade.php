@extends('layouts.app')

@section('title', $product->nama_produk . ' - Best')

@section('content')
<div class="bg-[#F9FAFB] py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-[#0F3075]">Home</a>
            <span class="mx-2">&gt;</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#0F3075]">Produk</a>
            <span class="mx-2">&gt;</span>
            <span class="text-gray-900 font-medium">{{ $product->nama_produk }}</span>
        </nav>

        <div class="bg-white rounded-2xl p-8 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Gallery Section -->
                <div>
                    <!-- Main Image -->
                    <div class="relative aspect-square bg-gray-100 rounded-xl overflow-hidden mb-4 group">
                        @if($product->pictures->count() > 0)
                            <img id="mainImage" src="{{ asset('storage/' . $product->pictures->first()->path) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Nav Buttons -->
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/30 hover:bg-black/50 text-white rounded-full flex items-center justify-center backdrop-blur-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/30 hover:bg-black/50 text-white rounded-full flex items-center justify-center backdrop-blur-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-5 gap-3">
                        @foreach($product->pictures as $pic)
                            <div onclick="changeImage('{{ asset('storage/' . $pic->path) }}')" class="aspect-square bg-gray-100 rounded-lg cursor-pointer border-2 {{ $loop->first ? 'border-[#0F3075]' : 'border-transparent hover:border-gray-300' }} overflow-hidden">
                                <img src="{{ asset('storage/' . $pic->path) }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                        @if($product->pictures->count() == 0)
                             <div class="aspect-square bg-gray-200 rounded-lg"></div>
                             <div class="aspect-square bg-gray-200 rounded-lg"></div>
                             <div class="aspect-square bg-[#0F3075] rounded-lg"></div>
                             <div class="aspect-square bg-[#0F3075] rounded-lg"></div>
                             <div class="aspect-square bg-[#0F3075] rounded-lg"></div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div>
                    <p class="text-gray-500 text-sm mb-1">{{ $product->category->category_name ?? 'Kategori' }}</p>
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $product->nama_produk }}</h1>
                    
                    <div class="text-4xl font-bold text-slate-900 mb-4">
                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                    </div>

                    <div class="flex items-center gap-2 mb-8 text-sm">
                        <span class="text-gray-600">Stok:</span>
                        @if($product->stok > 0)
                            <span class="text-[#0F3075] font-medium">Tersedia</span>
                            <span class="text-gray-400">/ {{ $product->stok }} Unit</span>
                        @else
                            <span class="text-red-500 font-medium">Habis</span>
                        @endif
                    </div>

                    <!-- Form Add to Cart -->
                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                        @csrf
                        <div class="flex items-center gap-4 mb-8">
                            <span class="text-gray-700 font-medium">Jumlah:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" onclick="decrement()" class="w-10 h-10 flex items-center justify-center text-[#0F3075] hover:bg-gray-50 rounded-l-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stok }}" class="w-16 h-10 text-center border-x border-gray-300 focus:outline-none text-[#0F3075] font-bold">
                                <button type="button" onclick="increment()" class="w-10 h-10 flex items-center justify-center text-[#0F3075] hover:bg-gray-50 rounded-r-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#0F3075] hover:bg-blue-900 text-white font-semibold py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="mt-8">
            <h3 class="text-xl font-bold text-[#0F3075] mb-6 pb-2 border-b-2 border-orange-400 inline-block">Deskripsi Produk</h3>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm space-y-6 text-gray-700 leading-relaxed">
                @if($product->deskripsi)
                    {!! nl2br(e($product->deskripsi)) !!}
                @else
                    <div>
                        <h4 class="font-bold text-[#0F3075] mb-2">{{ $product->nama_produk }} - Atap Berkualitas untuk Hunian Anda</h4>
                        <p class="mb-4">{{ $product->nama_produk }} adalah solusi atap bitumen bergelombang yang ringan, tahan lama, dan mudah dipasang. Terbuat dari serat organik yang diresapi dengan bitumen berkualitas tinggi, produk ini menawarkan perlindungan maksimal dari cuaca ekstrem dan kondisi lingkungan yang keras.</p>
                        
                        <h4 class="font-bold text-[#0F3075] mb-2">Keunggulan Produk:</h4>
                        <ul class="list-disc pl-5 space-y-1 mb-4">
                            <li>Tahan air 100% - Tidak bocor dan kedap air dalam segala kondisi cuaca</li>
                            <li>Ringan - Berat hanya 3.4 kg/lembar, memudahkan instalasi dan mengurangi beban struktur</li>
                            <li>Tahan lama - Garansi hingga 15 tahun dengan ketahanan terhadap korosi</li>
                            <li>Insulasi suara - Meredam suara hujan dan kebisingan eksternal</li>
                            <li>Tahan terhadap suhu ekstrem - Cocok untuk iklim tropis Indonesia</li>
                            <li>Ramah lingkungan - Dapat didaur ulang dan bebas asbes</li>
                        </ul>

                        <h4 class="font-bold text-[#0F3075] mb-2">Spesifikasi Teknis:</h4>
                        <div class="grid grid-cols-2 max-w-2xl gap-y-2">
                            <div class="text-gray-500">Panjang:</div> <div class="font-medium">200 cm</div>
                            <div class="text-gray-500">Lebar:</div> <div class="font-medium">95 cm</div>
                            <div class="text-gray-500">Ketebalan:</div> <div class="font-medium">3 mm</div>
                            <div class="text-gray-500">Berat:</div> <div class="font-medium">3.4 kg/lembar</div>
                            <div class="text-gray-500">Gelombang:</div> <div class="font-medium">10 gelombang</div>
                            <div class="text-gray-500">Luas efektif:</div> <div class="font-medium">1.53 m²</div>
                            <div class="text-gray-500">Material:</div> <div class="font-medium">Serat organik + bitumen</div>
                            <div class="text-gray-500">Warna:</div> <div class="font-medium">Merah, Hijau, Hitam, Coklat</div>
                        </div>

                        <h4 class="font-bold text-[#0F3075] mb-2 mt-6">Aplikasi Penggunaan:</h4>
                        <p>Cocok untuk berbagai jenis bangunan seperti rumah tinggal, gudang, pabrik, kandang ternak, gazebo, carport, dan bangunan komersial lainnya. Dapat dipasang pada rangka kayu maupun baja ringan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
    
    function increment() {
        var input = document.getElementById('quantity');
        var max = parseInt(input.getAttribute('max'));
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }
    function decrement() {
        var input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endsection
