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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservasi_id'); // Primary Key
            $table->string('nama_pelanggan'); // Customer Name
            $table->string('nomor_kontak'); // Contact Number
            $table->datetime('waktu_reservasi'); // Reservation DateTime
            $table->integer('nomor_meja'); // Foreign Key to Tables.nomor_meja
            $table->enum('status', ['terjadwal', 'dibatalkan', 'selesai'])->default('terjadwal'); // Status
            $table->timestamps(); // Created at and Updated at

            // Foreign Key Constraint
            $table->foreign('nomor_meja')->references('nomor_meja')->on('tables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
