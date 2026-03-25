@extends('layouts.app')

@section('title', 'Kelola Alamat - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">KELOLA ALAMAT</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Add Address Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-900">Daftar Alamat</h2>
                <a href="{{ route('profile.addresses.create') }}" class="bg-[#0F3075] hover:bg-blue-900 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Alamat
                </a>
            </div>

            <!-- Addresses List -->
            @if($addresses->count() > 0)
                <div class="space-y-4">
                    @foreach($addresses as $address)
                    <div class="bg-white rounded-xl shadow-sm border {{ $address->is_primary ? 'border-[#0F3075]' : 'border-gray-100' }} p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="font-semibold text-slate-900">{{ $address->label ?? 'Alamat' }}</span>
                                    @if($address->is_primary)
                                        <span class="text-xs bg-[#0F3075] text-white px-2 py-0.5 rounded">Utama</span>
                                    @endif
                                </div>
                                <p class="text-gray-600">{{ $address->alamat_lengkap }}</p>
                                <p class="text-gray-500 text-sm mt-1">{{ $address->kecamatan }}, {{ $address->kota }}</p>
                                <p class="text-gray-500 text-sm">{{ $address->provinsi }} {{ $address->kode_pos }}</p>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex flex-col gap-2 ml-4">
                                <a href="{{ route('profile.addresses.edit', $address->address_id) }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                
                                @if(!$address->is_primary)
                                    <form action="{{ route('profile.addresses.primary', $address->address_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Jadikan Utama
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('profile.addresses.destroy', $address->address_id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alamat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="text-gray-500 mb-4">Anda belum memiliki alamat tersimpan</p>
                    <a href="{{ route('profile.addresses.create') }}" class="inline-block bg-[#0F3075] text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition">
                        Tambah Alamat Pertama
                    </a>
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('profile.show') }}" class="text-gray-500 hover:text-[#0F3075] inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Profil
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
