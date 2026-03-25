<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/')
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->nama_lengkap . '!');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah',
        ]);
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'kota.required' => 'Kota wajib diisi',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'kode_pos.required' => 'Kode pos wajib diisi',
        ]);

        // Create user
        $user = User::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        // Create primary address
        Address::create([
            'user_id' => $user->user_id,
            'label' => 'Rumah',
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'kecamatan' => $validated['kecamatan'],
            'kode_pos' => $validated['kode_pos'],
            'is_primary' => true,
        ]);

        // Login user
        Auth::login($user);

        return redirect('/')
            ->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->nama_lengkap . '!');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Anda telah keluar dari sistem.');
    }
}
