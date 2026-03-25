@extends('layouts.app')

@section('title', 'Profil Saya - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">PROFIL SAYA</h1>
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

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-20 h-20 bg-[#0F3075] rounded-full flex items-center justify-center text-white text-3xl font-bold">
                        {{ substr($user->nama_lengkap, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $user->nama_lengkap }}</h2>
                        <p class="text-gray-500">{{ $user->email }}</p>
                        <span class="inline-block mt-2 text-xs bg-green-100 text-green-700 px-2 py-1 rounded">{{ ucfirst($user->role) }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t pt-6">
                    <div>
                        <label class="text-sm text-gray-500">Nama Lengkap</label>
                        <p class="font-medium text-slate-900">{{ $user->nama_lengkap }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Email</label>
                        <p class="font-medium text-slate-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Nomor Telepon</label>
                        <p class="font-medium text-slate-900">{{ $user->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Bergabung Sejak</label>
                        <p class="font-medium text-slate-900">{{ $user->created_at->format('d F Y') }}</p>
                    </div>
                </div>

                <div class="flex gap-3 mt-6 pt-6 border-t">
                    <a href="{{ route('profile.edit') }}" class="flex-1 bg-[#0F3075] hover:bg-blue-900 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
                        Edit Profil
                    </a>
                    <a href="{{ route('profile.password') }}" class="flex-1 border border-gray-300 hover:border-[#0F3075] text-gray-700 hover:text-[#0F3075] font-semibold py-3 px-4 rounded-lg transition text-center">
                        Ubah Password
                    </a>
                </div>
            </div>

            <!-- Address Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0F3075]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Alamat Utama
                    </h3>
                    <a href="{{ route('profile.addresses') }}" class="text-[#0F3075] hover:underline text-sm">Kelola Alamat</a>
                </div>

                @if($primaryAddress)
                    <div class="border border-[#0F3075] bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-slate-900">{{ $primaryAddress->label ?? 'Alamat' }}</span>
                            <span class="text-xs bg-[#0F3075] text-white px-2 py-0.5 rounded">Utama</span>
                        </div>
                        <p class="text-gray-600">{{ $primaryAddress->alamat_lengkap }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $primaryAddress->kecamatan }}, {{ $primaryAddress->kota }}</p>
                        <p class="text-gray-500 text-sm">{{ $primaryAddress->provinsi }} {{ $primaryAddress->kode_pos }}</p>
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50 rounded-lg">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-gray-500 mb-4">Anda belum memiliki alamat tersimpan</p>
                        <a href="{{ route('profile.addresses.create') }}" class="inline-block bg-[#0F3075] text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition">
                            Tambah Alamat
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
