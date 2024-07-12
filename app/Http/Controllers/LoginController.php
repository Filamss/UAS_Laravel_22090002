<?php

namespace App\Http\Controllers;

use App\Mail\VerifEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        // Validasi data login
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        // Mendapatkan kredensial dari permintaan
        $credentials = $request->only('email', 'password');

        // Mencoba untuk login dengan kredensial yang diberikan
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Memeriksa apakah email pengguna telah diverifikasi
            if ($user->email_verified_at !== null) {
                // Arahkan semua pengguna ke admin.dashboard
                return redirect()->route('admin.dashboard');
            } else {
                // Tampilkan pesan kesalahan untuk email yang belum diverifikasi dan logout pengguna
                Auth::logout();
                return redirect()->route('login')->with('Gagal', 'Email belum diverifikasi.');
            }
        } else {
            // Kembali ke halaman login jika kredensial salah
            return redirect()->route('login')->with('Gagal', 'Email atau Password salah.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('Berhasil', 'Kamu Berhasil Keluar');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8',
        ]);

        try {
            // Create the new user
            $user = User::create([
                'name' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role' => 'User', // This sets the role to 'User'
                'email_verified_at' => null, // Set email_verified_at to null initially
            ]);

            // Send verification email
            $verificationUrl = route('verify.email', ['id' => $user->id]);
            Mail::to($user->email)->send(new VerifEmail($user->name, $verificationUrl));

            // Redirect to login with success message
            return redirect()->route('login')->with('Registrasi Berhasil', 'Silahkan Cek Email Untuk Verifikasi');
        } catch (\Exception $e) {
            // If there is an error, redirect with a failure message
            return redirect()->route('login')->with('Registrasi Gagal', 'Your registration failed. Please try again.');
        }
    }

    public function verifyEmail($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if ($user) {
            // Update the email_verified_at field
            $user->email_verified_at = now();
            $user->save();

            // Redirect to login with success message
            return redirect()->route('login')->with('Verifikasi Berhasil', 'Email Anda berhasil diverifikasi.');
        }

        // Redirect to login with failure message
        return redirect()->route('login')->with('Verifikasi Gagal', 'Verifikasi email gagal. Silahkan coba lagi.');
    }
}
