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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("number");
            $table->integer("quantity");
            $table->float("purchase_price", 10, 2);
            $table->float("selling_price", 10, 2);
            $table->string("image");
            $table->integer("sgst");
            $table->integer("cgst");
            $table->integer("igst");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
