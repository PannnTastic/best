<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Picture;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        // Ensure we have categories
        if ($categories->isEmpty()) {
            return;
        }

        $products = [
            [
                'nama_produk' => 'Onduline Classic Red',
                'harga' => 185000.00,
                'stok' => 100,
                'deskripsi' => 'Atap bitumen bergelombang yang ramah lingkungan, ringan, dan kuat. Terbuat dari serat selulosa yang diresapi bitumen.',
            ],
            [
                'nama_produk' => 'Onduvilla 3D Terracotta',
                'harga' => 58000.00,
                'stok' => 50,
                'deskripsi' => 'Genteng bitumen ringan dengan estetika genteng keramik tradisional. Tahan karat dan korosi.',
            ],
            [
                'nama_produk' => 'Bardoline Pro Asphalt Shingle',
                'harga' => 125000.00,
                'stok' => 75,
                'deskripsi' => 'Atap shingle bitumen berkualitas tinggi untuk tampilan atap bergaya modern dan minimalis.',
            ],
            [
                'nama_produk' => 'Insulasi Aluminium Foil Bubble',
                'harga' => 450000.00,
                'stok' => 20,
                'deskripsi' => 'Peredam panas atap dengan teknologi bubble foil ganda yang efektif memantulkan radiasi panas.',
            ],
             [
                'nama_produk' => 'Sekrup Roofing 5cm (Pack 100)',
                'harga' => 35000.00,
                'stok' => 200,
                'deskripsi' => 'Sekrup khusus pemasangan atap dengan karet seal anti bocor dan lapisan anti karat.',
            ],
            [
                'nama_produk' => 'Nok Atap Metal Pasir',
                'harga' => 55000.00,
                'stok' => 40,
                'deskripsi' => 'Aksesoris nok/wuwungan untuk atap metal pasir, memberikan perlindungan ekstra pada sambungan atap.',
            ]
        ];

        foreach ($products as $p) {
            $category = $categories->random();
            $product = Product::create([
                'category_id' => $category->category_id,
                'nama_produk' => $p['nama_produk'],
                'harga' => $p['harga'],
                'stok' => $p['stok'],
                'deskripsi' => $p['deskripsi']
            ]);

            // Create fake picture
            Picture::create([
                'product_id' => $product->product_id,
                'nama_gambar' => $product->nama_produk,
                'path_gambar' => 'products/sample-' . rand(1, 3) . '.jpg' // Mock path
            ]);
        }
    }
}
