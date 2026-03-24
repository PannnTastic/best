@extends('layouts.app')

@section('title', 'Blog & Berita - Best')

@section('content')
<!-- Header Section -->
<div class="bg-[#0F3075] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">BLOG & BERITA</h1>
    </div>
</div>

<div class="bg-[#F9FAFB] py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-gray-600 max-w-2xl mx-auto">Dapatkan informasi terkini seputar dunia konstruksi, tips bangunan, dan pembaruan produk dari kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition flex flex-col h-full">
                <a href="{{ route('blog.show', $blog->blog_id) }}" class="block aspect-video bg-gray-200 overflow-hidden relative group">
                    @if($blog->gambar_blog)
                        <img src="{{ Str::startsWith($blog->gambar_blog, 'http') ? $blog->gambar_blog : asset('storage/' . $blog->gambar_blog) }}" alt="{{ $blog->judul_blog }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition"></div>
                </a>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="text-sm text-gray-500 mb-2">{{ $blog->created_at->format('d M Y') }}</div>
                    <h2 class="text-xl font-bold text-slate-900 mb-3 leading-tight">
                        <a href="{{ route('blog.show', $blog->blog_id) }}" class="hover:text-[#0F3075]">{{ $blog->judul_blog }}</a>
                    </h2>
                    <p class="text-gray-600 mb-4 line-clamp-3 text-sm flex-1">
                        Simak artikel lengkap mengenai {{ $blog->judul_blog }}. Temukan wawasan baru untuk proyek konstruksi Anda.
                    </p>
                    <a href="{{ route('blog.show', $blog->blog_id) }}" class="text-[#0F3075] font-semibold text-sm hover:underline inline-flex items-center gap-1 mt-auto">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <p class="text-gray-500">Belum ada artikel yang tersedia.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endsection
