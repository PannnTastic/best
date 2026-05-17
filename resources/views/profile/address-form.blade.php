@extends('layouts.app')

@section('title', isset($address) ? 'Edit Alamat - Best' : 'Tambah Alamat - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">{{ isset($address) ? 'EDIT ALAMAT' : 'TAMBAH ALAMAT' }}</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ isset($address) ? route('profile.addresses.update', $address->address_id) : route('profile.addresses.store') }}" method="POST">
                    @csrf
                    @if(isset($address))
                        @method('PATCH')
                    @endif

                    <!-- Label -->
                    <div class="mb-6">
                        <label for="label" class="block text-sm font-medium text-gray-700 mb-2">Label Alamat (Opsional)</label>
                        <input type="text" name="label" id="label" value="{{ old('label', $address->label ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('label') border-red-500 @enderror"
                            placeholder="Contoh: Rumah, Kantor, Toko">
                        <p class="mt-1 text-xs text-gray-500">Beri nama untuk memudahkan mengenali alamat ini</p>
                        @error('label')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Lengkap -->
                    <div class="mb-6">
                        <label for="alamat_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('alamat_lengkap') border-red-500 @enderror"
                            placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan">{{ old('alamat_lengkap', $address->alamat_lengkap ?? '') }}</textarea>
                        @error('alamat_lengkap')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Provinsi -->
                        <div class="mb-6">
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                            <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', $address->provinsi ?? '') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('provinsi') border-red-500 @enderror"
                                placeholder="Contoh: Jawa Timur">
                            @error('provinsi')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kota -->
                        <div class="mb-6">
                            <label for="kota" class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten <span class="text-red-500">*</span></label>
                            <input type="text" name="kota" id="kota" value="{{ old('kota', $address->kota ?? '') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('kota') border-red-500 @enderror"
                                placeholder="Contoh: Sidoarjo">
                            @error('kota')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kecamatan -->
                        <div class="mb-6">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                            <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', $address->kecamatan ?? '') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('kecamatan') border-red-500 @enderror"
                                placeholder="Contoh: Sidoarjo">
                            @error('kecamatan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kode Pos -->
                        <div class="mb-6">
                            <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos <span class="text-red-500">*</span></label>
                            <input type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos', $address->kode_pos ?? '') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('kode_pos') border-red-500 @enderror"
                                placeholder="61257">
                            @error('kode_pos')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Is Primary -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_primary" value="1" {{ old('is_primary', $address->is_primary ?? false) ? 'checked' : '' }} 
                                class="w-4 h-4 text-[#0F3075] border-gray-300 rounded focus:ring-[#0F3075]">
                            <span class="ml-2 text-gray-700">Jadikan sebagai alamat utama</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-[#0F3075] hover:bg-blue-900 text-white font-semibold py-3 px-4 rounded-lg transition">
                            {{ isset($address) ? 'Simpan Perubahan' : 'Tambah Alamat' }}
                        </button>
                        <a href="{{ route('profile.addresses') }}" class="flex-1 border border-gray-300 hover:border-gray-400 text-gray-700 font-semibold py-3 px-4 rounded-lg transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
