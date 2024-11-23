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
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id('report_id'); // Primary Key
            $table->date('tanggal'); // Date of sale
            $table->unsignedBigInteger('menu_id'); // Foreign Key to Menus.menu_id
            $table->decimal('harga', 10, 2); // Price of the menu item
            $table->decimal('total', 10, 2); // Total sales amount
            $table->timestamps(); // Created at and Updated at

            // Foreign Key Constraints
            $table->foreign('menu_id')->references('menu_id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_reports');
    }
};
