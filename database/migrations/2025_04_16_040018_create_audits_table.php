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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('storage');
            $table->string('barang');
            $table->integer('dus');
            $table->integer('btl');
            $table->integer('total');
            $table->integer('total_real');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
