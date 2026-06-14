<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

class GoogleAuthController extends Controller
{
    // Melempar user ke halaman login Google
    public function redirect()
    {
        // Tambahkan stateless() untuk mengabaikan error session
        /** @var GoogleProvider $driver */
        $driver = Socialite::driver('google');

        return $driver->stateless()->redirect();
    }

    // Menangani kembalian data dari Google
    public function callback()
    {
        try {
            // Gabungan stateless() dan Bypass SSL (cURL error 60)
            /** @var GoogleProvider $driver */
            $driver = Socialite::driver('google');
            /** @var \Laravel\Socialite\Two\User $googleUser */
            $googleUser = $driver
                ->stateless()
                ->setHttpClient(new Client(['verify' => false]))
                ->user();

            // Cari user berdasarkan email dulu biar nggak bentrok dengan akun manual yang udah ada
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Update google_id kalau belum ada
                $user->update([
                    'google_id' => $googleUser->id,
                ]);
            } else {
                // Bikin user baru kalau belum pernah daftar sama sekali
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => null,
                ]);
            }

            // Login-kan user ke sistem Laravel
            Auth::login($user);

            // Arahkan ke dashboard sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect('/dashboard');

        } catch (ClientException $e) {
            // Clean Code: Tangani error konfigurasi Google secara graceful
            return redirect('/login')->with('error', 'ClientException: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Kita kembalikan ke halaman login dengan pesan error rapi
            return redirect('/login')->with('error', 'Exception: ' . $e->getMessage());
        }
    }
}
