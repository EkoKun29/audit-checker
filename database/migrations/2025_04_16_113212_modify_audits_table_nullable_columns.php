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
        Schema::table('audits', function (Blueprint $table) {
            $table->string('storage')->nullable()->change();
            $table->string('barang')->nullable()->change();
            $table->integer('dus')->nullable()->change();
            $table->integer('btl')->nullable()->change();
            $table->integer('total')->nullable()->change();
            $table->integer('total_real')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->string('storage')->nullable(false)->change();
            $table->string('barang')->nullable(false)->change();
            $table->integer('dus')->nullable(false)->change();
            $table->integer('btl')->nullable(false)->change();
            $table->integer('total')->nullable(false)->change();
            $table->integer('total_real')->nullable(false)->change();
        });
    }
};
