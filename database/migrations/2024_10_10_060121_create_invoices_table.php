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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer("customer_id");
            $table->integer("invoice_number");
            $table->string("salesman_name");
            $table->date("invoice_date");
            $table->integer("gst_percentage")->nullable();
            $table->float("sub_total", 10, 2);
            $table->float("gst_total", 10, 2);
            $table->float("grand_total", 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
