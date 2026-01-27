<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $primaryKey = 'cart_id';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','user_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'cart_products','cart_id','product_id');
    }
}
