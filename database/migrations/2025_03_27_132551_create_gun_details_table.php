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
        Schema::create('gun_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('image')->nullable()->comment('商品画像');
            $table->string('model')->nullable()->comment('モデル');
            $table->string('country')->nullable()->comment('生産国');
            $table->string('brand')->nullable()->comment('メーカー');
            $table->integer('full_length')->nullable()->comment('全長');
            $table->integer('full_weight')->nullable()->comment('総重量');
            $table->integer('diameter')->nullable()->comment('口径');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gun_details');
    }
};
