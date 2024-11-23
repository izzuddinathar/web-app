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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // Primary Key
            $table->integer('nomor_meja'); // Foreign Key to Tables.nomor_meja
            $table->unsignedBigInteger('menu_id'); // Foreign Key to Menus.menu_id
            $table->integer('jumlah'); // Quantity
            $table->enum('status_pesanan', ['dipesan', 'diproses', 'disajikan'])->default('dipesan'); // Status
            $table->timestamps(); // Timestamps

            // Foreign Key Constraints
            $table->foreign('nomor_meja')->references('nomor_meja')->on('tables')->onDelete('cascade');
            $table->foreign('menu_id')->references('menu_id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
