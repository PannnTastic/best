@extends('layouts.app')

@section('title', $blog->judul_blog . ' - Best Blog')

@section('content')
<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-[#0F3075]">Home</a>
            <span class="mx-2">&gt;</span>
            <a href="{{ route('blog.index') }}" class="hover:text-[#0F3075]">Blog</a>
            <span class="mx-2">&gt;</span>
            <span class="text-gray-900 font-medium truncate max-w-xs">{{ $blog->judul_blog }}</span>
        </nav>

        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">{{ $blog->judul_blog }}</h1>
            
            <div class="flex items-center gap-4 text-gray-500 text-sm mb-8 border-b border-gray-100 pb-8">
                <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $blog->created_at->format('d F Y') }}
                </span>
                <span>•</span>
                <span>Admin Best</span>
            </div>

            @if($blog->gambar_blog)
            <div class="rounded-xl overflow-hidden mb-10 shadow-sm">
                 <img src="{{ Str::startsWith($blog->gambar_blog, 'http') ? $blog->gambar_blog : asset('storage/' . $blog->gambar_blog) }}" alt="{{ $blog->judul_blog }}" class="w-full h-auto object-cover">
            </div>
            @endif

            <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed">
                @if($blog->pdf_blog)
                    <p class="mb-6">Informasi detail mengenai <strong>{{ $blog->judul_blog }}</strong>.</p>
                    <div class="my-8 p-6 bg-gray-50 border border-gray-200 rounded-xl flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Dokumen Terkait</h3>
                            <a href="{{ Str::startsWith($blog->pdf_blog, 'http') ? $blog->pdf_blog : asset('storage/' . $blog->pdf_blog) }}" target="_blank" class="text-[#0F3075] hover:underline text-sm">Download PDF / Baca Selengkapnya</a>
                        </div>
                    </div>
                @else
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p class="mt-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                @endif
            </div>
        </article>

        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-[#0F3075] hover:underline font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Blog
            </a>
        </div>
    </div>
</div>
@endsection
