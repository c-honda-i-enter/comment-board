<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('user_number');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('message_id')->references('message_id')->on('board');
            $table->foreign('user_number')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
