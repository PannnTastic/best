<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Asumsi relasi user->cart (hasOne) atau kita cari manual
        $cart = Cart::with(['products.pictures'])->where('user_id', $user->user_id)->first();

        return view('cart.index', compact('cart'));
    }

    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $quantity = $request->input('quantity', 1);

        // Cari atau buat cart untuk user ini
        $cart = Cart::firstOrCreate(['user_id' => $user->user_id]);

        // Cek apakah produk sudah ada di cart
        // Perlu diperhatikan nama tabel pivot dan key-nya di model Cart
        // Di Cart.php: $this->belongsToMany(Product::class,'cart_products','cart_id','product_id')
        $existingProduct = $cart->products()->where('products.product_id', $productId)->first();

        if ($existingProduct) {
            // Update quantity jika sudah ada
            $newQuantity = $existingProduct->pivot->jumlah_produk + $quantity;
            $cart->products()->updateExistingPivot($productId, ['jumlah_produk' => $newQuantity]);
        } else {
            // Attach baru
            $cart->products()->attach($productId, ['jumlah_produk' => $quantity]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->first();

        if ($cart) {
            $cart->products()->updateExistingPivot($productId, ['jumlah_produk' => $request->quantity]);
        }

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Remove item from cart.
     */
    public function destroy($productId)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->first();

        if ($cart) {
            $cart->products()->detach($productId);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
