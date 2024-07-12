<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SosmedController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Ambil data pengguna dari Google OAuth
            $oauthUser = Socialite::driver('google')->user();
            $email = $oauthUser->email ?? null;
            $name = $oauthUser->name ?? null;

            // Pastikan email dan nama tersedia
            if ($email && $name) {
                // Cari pengguna berdasarkan email
                $user = User::where('email', $email)->first();

                // Jika pengguna sudah terdaftar, login dan redirect ke admin.dashboard
                if ($user) {
                    Auth::login($user);
                    return redirect()->route('admin.dashboard');
                } else {
                    // Jika pengguna belum terdaftar, buat akun baru
                    $newUser = new User();
                    $newUser->name = $name;
                    $newUser->email = $email;
                    $newUser->email_verified_at = now();
                    $newUser->password = bcrypt(Str::random(10));
                    $newUser->remember_token = Str::random(60);
                    $newUser->save();

                    // Login user baru dan redirect ke admin.dashboard
                    Auth::login($newUser);
                    return redirect()->route('admin.dashboard');
                }
            } else {
                // Tangani kasus ketika email atau nama tidak ditemukan dalam respon OAuth
                return redirect()->route('login')->withErrors(['email' => 'Unable to retrieve email or name from Google.']);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan yang mungkin terjadi selama proses OAuth
            return redirect()->route('login')->withErrors(['email' => 'Error retrieving user data from Google.']);
        }
    }
}
