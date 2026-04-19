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
        Schema::create('order_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->constrained('orders')->onDelete('cascade');
            $table->foreignId('id_barang')->constrained('barangs')->onDelete('cascade');
            $table->enum('status', ['approve', 'running', 'reject'])->default('running');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_barangs');
    }
};
