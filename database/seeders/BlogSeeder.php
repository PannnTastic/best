<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'judul_blog' => 'Tips Memilih Atap Rumah di Iklim Tropis',
                'gambar_blog' => 'https://images.unsplash.com/photo-1632759145351-1d592919f522?q=80&w=2600&auto=format&fit=crop',
                'pdf_blog' => 'docs/tips-atap.pdf',
                'created_at' => now()->subDays(2),
            ],
            [
                'judul_blog' => 'Cara Merawat Genteng Metal Agar Awet',
                'gambar_blog' => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?q=80&w=1000&auto=format&fit=crop',
                'pdf_blog' => 'docs/perawatan-genteng.pdf',
                 'created_at' => now()->subDays(5),
            ],
            [
                'judul_blog' => 'Tren Desain Rumah Minimalis 2026',
                'gambar_blog' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2600&auto=format&fit=crop',
                'pdf_blog' => 'docs/tren-rumah-2026.pdf',
                 'created_at' => now()->subWeeks(1),
            ],
             [
                'judul_blog' => 'Mengenal Kelebihan Atap Onduline',
                'gambar_blog' => 'https://images.unsplash.com/photo-1599809275671-b5942cabc7a2?q=80&w=2600&auto=format&fit=crop',
                'pdf_blog' => 'docs/onduline-guide.pdf',
                 'created_at' => now()->subWeeks(2),
            ],
        ];

        foreach ($blogs as $b) {
            Blog::create($b);
        }
    }
}
