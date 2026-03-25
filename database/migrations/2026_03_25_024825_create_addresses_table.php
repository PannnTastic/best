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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('address_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('label', 50)->nullable(); // Contoh: Rumah, Kantor, dll
            $table->text('alamat_lengkap');
            $table->string('provinsi', 100);
            $table->string('kota', 100);
            $table->string('kecamatan', 100);
            $table->string('kode_pos', 10);
            $table->boolean('is_primary')->default(false); // Alamat utama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
