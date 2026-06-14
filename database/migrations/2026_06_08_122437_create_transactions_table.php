<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique();
            // Menyambungkan transaksi dengan user yang login
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_sampah');
            $table->decimal('berat_kg', 8, 2);
            $table->integer('total_harga');
            $table->string('type')->default('deposit'); // 'deposit' atau 'withdrawal'
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
