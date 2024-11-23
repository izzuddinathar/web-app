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
        Schema::create('sales_programs', function (Blueprint $table) {
            $table->id('program_id'); // Primary Key
            $table->string('nama_program'); // Program Name
            $table->decimal('diskon', 10, 2); // Discount
            $table->dateTime('tanggal_berlaku'); // Validity Date
            $table->time('jam_berlaku'); // Validity Time
            $table->unsignedBigInteger('menu_id')->nullable(); // Optional Foreign Key to Menus.menu_id
            $table->enum('kategori_produk', ['cemilan', 'makanan', 'minuman'])->nullable(); // Optional Product Category
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
        Schema::dropIfExists('sales_programs');
    }
};
