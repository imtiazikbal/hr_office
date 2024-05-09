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
        Schema::create('sub_editor_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_editor_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('sub_editor_id')->references('id')->on('sub_editors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_news');
    }
};
