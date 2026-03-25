<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'product_id');
    }

    public function carts(){
        return $this->belongsToMany(Cart::class,'cart_products','product_id','cart_id')
                    ->withPivot('jumlah_produk')
                    ->withTimestamps();
    }
}
