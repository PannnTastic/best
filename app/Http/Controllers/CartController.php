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
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->user_id],
            ['jumlah_order' => 0]
        );

        // Cek apakah produk sudah ada di cart
        $existingProduct = $cart->products()->where('products.product_id', $productId)->first();

        if ($existingProduct) {
            // Update quantity jika sudah ada
            $newQuantity = $existingProduct->pivot->jumlah_produk + $quantity;
            $cart->products()->updateExistingPivot($productId, ['jumlah_produk' => $newQuantity]);
        } else {
            // Attach baru
            $cart->products()->attach($productId, ['jumlah_produk' => $quantity]);
        }
        
        // Update jumlah_order di cart
        $totalItems = $cart->products()->sum('jumlah_produk');
        $cart->update(['jumlah_order' => $totalItems]);

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
            
            // Update jumlah_order di cart
            $totalItems = $cart->products()->sum('jumlah_produk');
            $cart->update(['jumlah_order' => $totalItems]);
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
            
            // Update jumlah_order di cart
            $totalItems = $cart->products()->sum('jumlah_produk');
            $cart->update(['jumlah_order' => $totalItems]);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    /**
     * Show checkout page.
     */
    public function checkout()
    {
        $user = Auth::user();
        $cart = Cart::with(['products.pictures', 'products.category'])->where('user_id', $user->user_id)->first();

        if (!$cart || $cart->products->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $addresses = $user->addresses()->orderBy('is_primary', 'desc')->get();
        
        $subtotal = $cart->products->sum(function($product) {
            return $product->harga * $product->pivot->jumlah_produk;
        });

        return view('checkout.index', compact('cart', 'addresses', 'subtotal'));
    }

    /**
     * Process checkout and redirect to WhatsApp.
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,address_id',
            'catatan' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $cart = Cart::with(['products'])->where('user_id', $user->user_id)->first();

        if (!$cart || $cart->products->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $address = $user->addresses()->where('address_id', $request->address_id)->first();
        
        if (!$address) {
            return redirect()->back()->with('error', 'Alamat tidak ditemukan.');
        }

        // Build WhatsApp message
        $message = $this->buildWhatsAppMessage($user, $cart, $address, $request->catatan);
        
        // WhatsApp API URL (gunakan nomor WhatsApp bisnis BEST)
        $whatsappNumber = '6285645676696'; // Nomor WhatsApp BEST dari footer
        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);

        // Clear cart after checkout (optional - bisa juga tidak dihapus sampai konfirmasi)
        // $cart->products()->detach();
        // $cart->update(['jumlah_order' => 0]);

        return redirect()->away($whatsappUrl);
    }

    /**
     * Build WhatsApp message.
     */
    private function buildWhatsAppMessage($user, $cart, $address, $catatan = null)
    {
        $subtotal = $cart->products->sum(function($product) {
            return $product->harga * $product->pivot->jumlah_produk;
        });

        $message = "*PESANAN BARU - BEST*\n";
        $message .= "=====================\n\n";
        
        $message .= "*DATA PEMBELI:*\n";
        $message .= "Nama: {$user->nama_lengkap}\n";
        $message .= "Email: {$user->email}\n";
        $message .= "Telepon: {$user->phone}\n\n";
        
        $message .= "*ALAMAT PENGIRIMAN:*\n";
        $message .= "Label: " . ($address->label ?? 'Alamat') . "\n";
        $message .= "{$address->alamat_lengkap}\n";
        $message .= "Kec. {$address->kecamatan}, {$address->kota}\n";
        $message .= "{$address->provinsi} {$address->kode_pos}\n\n";
        
        $message .= "*PRODUK YANG DIPESAN:*\n";
        $message .= "---------------------\n";
        
        foreach ($cart->products as $index => $product) {
            $no = $index + 1;
            $total = $product->harga * $product->pivot->jumlah_produk;
            $message .= "{$no}. {$product->nama_produk}\n";
            $message .= "   Harga: Rp" . number_format($product->harga, 0, ',', '.') . "\n";
            $message .= "   Qty: {$product->pivot->jumlah_produk}\n";
            $message .= "   Subtotal: Rp" . number_format($total, 0, ',', '.') . "\n\n";
        }
        
        $message .= "---------------------\n";
        $message .= "*TOTAL: Rp" . number_format($subtotal, 0, ',', '.') . "*\n\n";
        
        if ($catatan) {
            $message .= "*CATATAN:*\n{$catatan}\n\n";
        }
        
        $message .= "=====================\n";
        $message .= "Mohon konfirmasi ketersediaan stok dan total ongkir.\n";
        $message .= "Terima kasih!";

        return $message;
    }
}
