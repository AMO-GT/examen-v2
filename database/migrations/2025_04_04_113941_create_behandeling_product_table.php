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
        Schema::create('behandeling_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('behandeling_id')->constrained('behandelingen', 'behandeling_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('producten', 'product_id')->onDelete('cascade');
            $table->integer('aantal')->default(1);
            $table->timestamps();

            $table->unique(['behandeling_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('behandeling_product');
    }
};
