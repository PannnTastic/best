@extends('layouts.app')

@section('title', 'Edit Profil - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">EDIT PROFIL</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Nama Lengkap -->
                    <div class="mb-6">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-[#0F3075] hover:bg-blue-900 text-white font-semibold py-3 px-4 rounded-lg transition">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('profile.show') }}" class="flex-1 border border-gray-300 hover:border-gray-400 text-gray-700 font-semibold py-3 px-4 rounded-lg transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
