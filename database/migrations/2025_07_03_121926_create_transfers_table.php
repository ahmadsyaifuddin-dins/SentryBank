<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dari_nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->foreignId('ke_nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->dateTime('waktu_transfer');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
