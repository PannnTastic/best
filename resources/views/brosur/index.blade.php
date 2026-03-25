@extends('layouts.app')

@section('title', 'Brosur - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">BROSUR</h1>
        <p class="text-blue-100 mt-2">Unduh katalog produk lengkap kami</p>
    </div>
</div>

<!-- Search Section -->
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <form action="{{ route('brosur') }}" method="GET" class="flex w-full max-w-xl gap-3">
            <div class="flex-1 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Cari brosur..." value="{{ request('search') }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075]">
            </div>
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-lg transition">
                Cari
            </button>
        </form>
    </div>
</div>

<!-- Brosur Grid -->
<div class="container mx-auto px-4 pb-16">
    @php
        $brosurs = [
            [
                'id' => 1,
                'nama' => 'Brosur Onduline Classic',
                'deskripsi' => 'Atap bitumen bergelombang dengan garansi 15 tahun',
                'ukuran' => '8 MB',
                'tipe' => 'PDF',
                'gambar' => 'https://images.unsplash.com/photo-1588854337221-4cf9fa96059c?w=300&h=400&fit=crop',
                'file_url' => '#',
                'produk_id' => 1
            ],
            [
                'id' => 2,
                'nama' => 'Brosur Onduvilla',
                'deskripsi' => 'Genteng bitumen dengan tampilan 3D',
                'ukuran' => '6 MB',
                'tipe' => 'PDF',
                'gambar' => 'https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=300&h=400&fit=crop',
                'file_url' => '#',
                'produk_id' => 2
            ],
            [
                'id' => 3,
                'nama' => 'Brosur Onduline Tile',
                'deskripsi' => 'Atap bitumen model genteng flat',
                'ukuran' => '5 MB',
                'tipe' => 'PDF',
                'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=300&h=400&fit=crop',
                'file_url' => '#',
                'produk_id' => 3
            ],
            [
                'id' => 4,
                'nama' => 'Brosur Bata Ringan',
                'deskripsi' => 'Bata ringan AAC berkualitas premium',
                'ukuran' => '4 MB',
                'tipe' => 'PDF',
                'gambar' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=300&h=400&fit=crop',
                'file_url' => '#',
                'produk_id' => null
            ],
            [
                'id' => 5,
                'nama' => 'Katalog Produk BEST 2024',
                'deskripsi' => 'Katalog lengkap semua produk BEST',
                'ukuran' => '25 MB',
                'tipe' => 'PDF',
                'gambar' => 'https://images.unsplash.com/photo-1581094794329-cd8119699f82?w=300&h=400&fit=crop',
                'file_url' => '#',
                'produk_id' => null
            ],
            [
                'id' => 6,
                'nama' => 'Brosur Floordeck',
                'deskripsi' => 'Bondek untuk cor lantai dan dak',
                'ukuran' => '3 MB',
                'tipe' => 'PDF',
                'gambar' => 'https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=300&h=400&fit=crop',
                'file_url' => '#',
                'produk_id' => null
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($brosurs as $brosur)
        <div class="bg-white rounded-xl border border-gray-200 p-4 flex gap-4 hover:shadow-lg hover:border-[#0F3075]/30 transition group">
            <!-- Preview Gambar - Bisa Diklik -->
            <a href="{{ $brosur['file_url'] }}" target="_blank" class="w-24 h-32 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden relative">
                <img src="{{ $brosur['gambar'] }}" alt="{{ $brosur['nama'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center">
                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </a>
            
            <div class="flex-1 flex flex-col justify-center">
                <!-- Judul - Link ke Preview -->
                <a href="{{ $brosur['file_url'] }}" target="_blank" class="font-bold text-slate-900 text-lg mb-1 hover:text-[#0F3075] transition">
                    {{ $brosur['nama'] }}
                </a>
                <p class="text-gray-500 text-sm mb-2">{{ $brosur['deskripsi'] }}</p>
                <div class="flex items-center gap-3">
                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $brosur['ukuran'] }}</span>
                    <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded uppercase">{{ $brosur['tipe'] }}</span>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="flex flex-col items-end justify-between">
                @if($brosur['produk_id'])
                    <a href="{{ route('products.show', $brosur['produk_id']) }}" class="text-[#0F3075] hover:text-blue-800 p-2" title="Lihat Produk">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                @else
                    <span></span>
                @endif
                
                <a href="{{ $brosur['file_url'] }}" download class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center gap-2 mt-12">
        <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#0F3075] text-white">1</span>
        <a href="?page=2" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:border-[#0F3075] hover:text-[#0F3075] transition">2</a>
        <a href="?page=3" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:border-[#0F3075] hover:text-[#0F3075] transition">3</a>
        <span class="text-gray-400">...</span>
        <a href="?page=8" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:border-[#0F3075] hover:text-[#0F3075] transition">8</a>
    </div>
</div>
@endsection
