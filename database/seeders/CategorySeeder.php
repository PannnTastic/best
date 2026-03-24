<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Atap Bitumen'],
            ['nama_kategori' => 'Genteng Metal'],
            ['nama_kategori' => 'Peredam Panas'],
            ['nama_kategori' => 'Aksesoris Atap'],
            ['nama_kategori' => 'Material Umum'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
