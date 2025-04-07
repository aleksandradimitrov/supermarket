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
        Schema::create('product_special_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity'); // how many items required for discount
            $table->integer('special_price'); // total price for that quantity
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_special_prices');
    }
};
