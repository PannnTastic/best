<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show user profile
     */
    public function show()
    {
        $user = Auth::user();
        $primaryAddress = $user->primaryAddress;
        
        return view('profile.show', compact('user', 'primaryAddress'));
    }

    /**
     * Show edit profile form
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'phone' => 'required|string|max:20',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'phone.required' => 'Nomor telepon wajib diisi',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Show change password form
     */
    public function showChangePassword()
    {
        return view('profile.change-password');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Verify current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah!');
    }

    /**
     * Show user addresses
     */
    public function addresses()
    {
        $user = Auth::user();
        $addresses = $user->addresses()->orderBy('is_primary', 'desc')->get();
        
        return view('profile.addresses', compact('addresses'));
    }

    /**
     * Show add address form
     */
    public function createAddress()
    {
        return view('profile.address-form');
    }

    /**
     * Store new address
     */
    public function storeAddress(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'is_primary' => 'boolean',
        ], [
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'kota.required' => 'Kota wajib diisi',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'kode_pos.required' => 'Kode pos wajib diisi',
        ]);

        // If this is the first address, make it primary
        if ($user->addresses()->count() === 0) {
            $validated['is_primary'] = true;
        }

        // If new address is set as primary, unset other primary addresses
        if (!empty($validated['is_primary'])) {
            $user->addresses()->update(['is_primary' => false]);
        }

        $user->addresses()->create($validated);

        return redirect()->route('profile.addresses')->with('success', 'Alamat berhasil ditambahkan!');
    }

    /**
     * Show edit address form
     */
    public function editAddress($id)
    {
        $user = Auth::user();
        $address = $user->addresses()->where('address_id', $id)->firstOrFail();
        
        return view('profile.address-form', compact('address'));
    }

    /**
     * Update address
     */
    public function updateAddress(Request $request, $id)
    {
        $user = Auth::user();
        $address = $user->addresses()->where('address_id', $id)->firstOrFail();

        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'is_primary' => 'boolean',
        ], [
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'kota.required' => 'Kota wajib diisi',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'kode_pos.required' => 'Kode pos wajib diisi',
        ]);

        // If address is set as primary, unset other primary addresses
        if (!empty($validated['is_primary']) && !$address->is_primary) {
            $user->addresses()->update(['is_primary' => false]);
        }

        $address->update($validated);

        return redirect()->route('profile.addresses')->with('success', 'Alamat berhasil diperbarui!');
    }

    /**
     * Delete address
     */
    public function destroyAddress($id)
    {
        $user = Auth::user();
        $address = $user->addresses()->where('address_id', $id)->firstOrFail();

        // Don't allow deleting the only primary address if it's the only address
        if ($address->is_primary && $user->addresses()->count() === 1) {
            return redirect()->back()->with('error', 'Anda harus memiliki minimal satu alamat. Tambahkan alamat baru terlebih dahulu.');
        }

        $wasPrimary = $address->is_primary;
        $address->delete();

        // If deleted address was primary, set the first remaining as primary
        if ($wasPrimary) {
            $firstAddress = $user->addresses()->first();
            if ($firstAddress) {
                $firstAddress->update(['is_primary' => true]);
            }
        }

        return redirect()->route('profile.addresses')->with('success', 'Alamat berhasil dihapus!');
    }

    /**
     * Set address as primary
     */
    public function setPrimaryAddress($id)
    {
        $user = Auth::user();
        $address = $user->addresses()->where('address_id', $id)->firstOrFail();

        // Unset all other primary addresses
        $user->addresses()->update(['is_primary' => false]);

        // Set this as primary
        $address->update(['is_primary' => true]);

        return redirect()->back()->with('success', 'Alamat utama berhasil diubah!');
    }
}
