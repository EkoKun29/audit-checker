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
        Schema::table('audit_checkers', function (Blueprint $table) {
            $table->string('produk')->nullable()->change();
            $table->integer('dus')->nullable()->change();
            $table->integer('btl')->nullable()->change();
            $table->integer('kotak')->nullable()->change();
            $table->integer('total')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_checkers', function (Blueprint $table) {
            $table->string('produk')->nullable(false)->change();
            $table->integer('dus')->nullable(false)->change();
            $table->integer('btl')->nullable(false)->change();
            $table->integer('kotak')->nullable(false)->change();
            $table->integer('total')->nullable(false)->change();
        });
    }
};
