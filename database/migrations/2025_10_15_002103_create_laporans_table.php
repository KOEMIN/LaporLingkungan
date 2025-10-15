<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Buka file: database/migrations/xxxx_xx_xx_xxxxxx_create_laporans_table.php

public function up(): void
{
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
        $table->string('judul');
        $table->text('deskripsi');
        $table->string('lokasi');
        $table->string('foto')->nullable(); // Foto bisa jadi tidak diupload
        $table->enum('status', ['Dilaporkan', 'Diproses', 'Selesai Ditangani'])->default('Dilaporkan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
