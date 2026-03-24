@extends('layouts.app')

@section('title', 'Brosur - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">BROSUR</h1>
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
                <input type="text" name="search" placeholder="Pencarian" value="{{ request('search') }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075]">
            </div>
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-lg transition">
                Cari
            </button>
        </form>
    </div>
</div>

<!-- Brosur Grid -->
<div class="container mx-auto px-4 pb-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @php
            $brosurs = [
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
                ['nama' => 'Brosur Onduline Classic', 'ukuran' => '8 MB', 'tipe' => 'PDF'],
            ];
        @endphp

        @foreach($brosurs as $brosur)
        <div class="bg-white rounded-xl border border-gray-200 p-4 flex gap-4 hover:shadow-md transition">
            <div class="w-24 h-32 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1588854337221-4cf9fa96059c?w=150&h=200&fit=crop" alt="Brosur" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 flex flex-col justify-center">
                <h3 class="font-bold text-slate-900 text-lg mb-1">{{ $brosur['nama'] }}</h3>
                <p class="text-gray-500 text-sm">{{ $brosur['ukuran'] }} - {{ $brosur['tipe'] }}</p>
            </div>
            <div class="flex items-end">
                <button class="text-orange-500 hover:text-orange-600 p-2" title="Download">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center gap-2 mt-12">
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:border-[#0F3075] hover:text-[#0F3075] transition">1</a>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#0F3075] text-white">2</a>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:border-[#0F3075] hover:text-[#0F3075] transition">3</a>
        <span class="text-gray-400">...</span>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:border-[#0F3075] hover:text-[#0F3075] transition">8</a>
    </div>
</div>
@endsection
