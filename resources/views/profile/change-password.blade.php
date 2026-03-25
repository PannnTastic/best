@extends('layouts.app')

@section('title', 'Ubah Password - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">UBAH PASSWORD</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Current Password -->
                    <div class="mb-6">
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini <span class="text-red-500">*</span></label>
                        <input type="password" name="current_password" id="current_password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('current_password') border-red-500 @enderror">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru <span class="text-red-500">*</span></label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('password') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075]">
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-[#0F3075] hover:bg-blue-900 text-white font-semibold py-3 px-4 rounded-lg transition">
                            Ubah Password
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
