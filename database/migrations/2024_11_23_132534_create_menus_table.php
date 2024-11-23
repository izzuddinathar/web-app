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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('menu_id'); // Primary Key
            $table->string('nama_menu'); // Menu name
            $table->text('deskripsi')->nullable(); // Optional description
            $table->decimal('harga', 10, 2); // Price with precision
            $table->enum('kategori', ['cemilan', 'makanan', 'minuman']); // Enum for category
            $table->string('gambar')->nullable(); // Image path
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
