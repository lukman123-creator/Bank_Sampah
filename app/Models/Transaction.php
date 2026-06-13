<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Pastikan ini sudah ada (agar bisa diisi datanya)
    protected $guarded = [];
    // (Atau kalau kamu pakai $fillable, biarkan saja $fillable-nya)

    // ==========================================
    // TAMBAHKAN FUNGSI INI AGAR TIDAK ERROR
    // ==========================================
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
