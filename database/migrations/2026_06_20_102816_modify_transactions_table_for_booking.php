<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // 1. Cek dulu, kalau 'trx_code' BELUM ADA, baru buat kolomnya
            if (!Schema::hasColumn('transactions', 'trx_code')) {
                $table->string('trx_code')->unique()->after('id');
            }
            
            // 2. Cek dulu, kalau 'otp_code' BELUM ADA, baru buat kolomnya
            if (!Schema::hasColumn('transactions', 'otp_code')) {
                $table->string('otp_code', 6)->nullable()->after('status');
            }

            // 3. Ubah kolom berat dan harga menjadi boleh kosong (nullable)
            $table->decimal('berat_kg', 8, 2)->nullable()->change();
            $table->integer('total_harga')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Hapus kolom hanya jika kolomnya memang ada (saat rollback)
            if (Schema::hasColumn('transactions', 'trx_code')) {
                $table->dropColumn('trx_code');
            }
            if (Schema::hasColumn('transactions', 'otp_code')) {
                $table->dropColumn('otp_code');
            }
        });
    }
};