<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // TAMBAHKAN: Relasi ke Jenis Sampah
    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }

    // TAMBAHKAN: Relasi ke Hadiah/Reward
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}