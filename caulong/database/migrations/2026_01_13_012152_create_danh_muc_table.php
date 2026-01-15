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
        Schema::create('danh_muc', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_muc');
    }
};
Schema::create('DanhMuc', function (Blueprint $table) {
    $table->id('MaDanhMuc');
    $table->string('TenDanhMuc', 255);
    $table->unsignedBigInteger('DanhMucCha')->nullable();
    $table->timestamps();
});
