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
        Schema::table('sub_editors', function (Blueprint $table) {
            $table->unsignedBigInteger('logs_id')->nullable();
            $table->foreign('logs_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_editors', function (Blueprint $table) {
            $table->dropColumn('logs_id');
        });
    }
};
