@extends('layouts.app')

@section('title', 'Login - Best')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#F9FAFB] py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('images/logo-best.png') }}" alt="BEST Logo" class="h-16 w-auto mx-auto">
            </a>
            <h2 class="mt-4 text-2xl font-bold text-slate-900">Selamat Datang Kembali</h2>
            <p class="mt-2 text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('email') border-red-500 @enderror"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#0F3075] focus:ring-1 focus:ring-[#0F3075] @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-[#0F3075] border-gray-300 rounded focus:ring-[#0F3075]">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm text-[#0F3075] hover:underline">Lupa password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-[#0F3075] hover:bg-blue-900 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                    Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-[#0F3075] font-semibold hover:underline">Daftar sekarang</a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#0F3075] text-sm inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
