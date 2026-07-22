<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('device');

            // Foreign Keys relacionando com as tabelas de Fabricantes e Modelos
            $table->foreignId('manufacturer_id')->constrained()->onDelete('restrict');
            $table->foreignId('device_model_id')->constrained()->onDelete('restrict');

            $table->string('storage')->nullable();
            $table->string('ram')->nullable();

            $table->string('condition');
            $table->string('grade')->nullable();
            $table->unsignedTinyInteger('battery')->nullable();
            $table->string('color')->nullable();
            $table->string('repairs')->nullable();
            $table->string('accessories')->nullable();

            $table->string('imei')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('account_status')->default('Liberado')->nullable();

            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2);
            $table->integer('quantity')->default(1);

            $table->json('images')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
