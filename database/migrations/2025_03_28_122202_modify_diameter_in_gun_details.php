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
        Schema::table('gun_details', function (Blueprint $table) {
            $table->decimal('diameter', 8, 2)->change();//最大8桁（整数6桁＋小数2桁）
            $table->decimal('full_weight', 8, 2)->change();//最大8桁（整数6桁＋小数2桁）
            $table->decimal('full_length', 8, 2)->change();//最大8桁（整数6桁＋小数2桁）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gun_details', function (Blueprint $table) {
            $table->integer('diameter')->change();
            $table->integer('full_weight')->change();
            $table->integer('full_length')->change();
        });
    }
};
