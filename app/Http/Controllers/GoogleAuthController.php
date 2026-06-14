<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    // Melempar user ke halaman login Google
    public function redirect()
    {
        // Tambahkan stateless() untuk mengabaikan error session
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Menangani kembalian data dari Google
    public function callback()
    {
        try {
            // Gabungan stateless() dan Bypass SSL (cURL error 60)
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->user();

            // Simpan atau update data user
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => null
            ]);

            // Login-kan user ke sistem Laravel
            Auth::login($user);

            // Arahkan ke dashboard
            return redirect('/dashboard');

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Clean Code: Tangani error konfigurasi Google secara graceful
            return redirect('/login')->with('error', 'Konfigurasi Google Login belum disetting dengan benar. Silakan hubungi Administrator.');
        } catch (\Exception $e) {
            // Kita kembalikan ke halaman login dengan pesan error rapi
            return redirect('/login')->with('error', 'Gagal login menggunakan Google. Silakan coba lagi.');
        }
    }
}