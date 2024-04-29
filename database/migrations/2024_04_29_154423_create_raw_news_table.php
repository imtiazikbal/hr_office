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
        Schema::create('raw_news', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->text('body');
            $table->string('image')->nullable();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
                 
            $table->unsignedBigInteger('reporter_id');
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('news_id');
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');

            $table->string('column_no')->nullable();
            $table->string('page_no')->nullable();

            $table->string('comment')->nullable();
            $table->integer('status')->default(0)->comment('0 = pending, 1 = approved by reading, 2 = pending for approval by graphics, 3 = rejected');

            $table->boolean('complete')->default(0);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_news');
    }
};
