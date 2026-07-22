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
        Schema::create('working_products', function (Blueprint $table) {
            $table->id();
            // Relaciona com a tabela 'manufacturers'. Se apagar o fabricante, apaga os modelos dele em cascata.
            $table->foreignId('manufacturer_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Ex: iPhone 13 Pro Max, Galaxy S23
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_products');
    }
};
