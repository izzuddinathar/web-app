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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id('inventory_id'); // Primary Key
            $table->string('nama_bahan_pokok'); // Raw Material Name
            $table->integer('jumlah'); // Quantity
            $table->string('satuan'); // Unit
            $table->string('supplier'); // Supplier Name
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
