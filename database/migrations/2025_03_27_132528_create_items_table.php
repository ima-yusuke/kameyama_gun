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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('role')->comment('銃0、弾1、その他2');
            $table->string('name')->comment('品名');;
            $table->integer('price')->nullable()->comment('価格');;
            $table->boolean('is_stock')->comment('売約済0、在庫有1');
            $table->unsignedBigInteger('category_id');
            $table->text('note')->nullable()->comment('備考欄');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
