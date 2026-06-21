<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            // Menambahkan kolom stok setelah kolom price
            $table->integer('stock')->default(0)->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn('stock');
        });
    }
};