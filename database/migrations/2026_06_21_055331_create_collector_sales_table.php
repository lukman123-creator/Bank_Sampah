<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collector_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_type_id')->constrained()->onDelete('cascade');
            $table->string('collector_name');
            $table->decimal('weight_kg', 8, 2);
            $table->decimal('price_per_kg', 10, 2);
            $table->decimal('total_sale', 12, 2);
            $table->text('notes')->nullable();
            $table->timestamp('sold_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collector_sales');
    }
};
