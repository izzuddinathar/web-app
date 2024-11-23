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
        Schema::create('tables', function (Blueprint $table) {
            $table->id('table_id'); // Primary Key
            $table->integer('nomor_meja')->unique(); // Unique table number
            $table->integer('kapasitas'); // Capacity
            $table->enum('status', ['dipesan', 'tersedia', 'terisi'])->default('tersedia'); // Status with default value
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
