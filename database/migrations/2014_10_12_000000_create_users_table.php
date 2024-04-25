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
        Schema::create('users', function (Blueprint $table) {
            $table->id();


            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', ['0','1','2','3','4','5','6','7','user'])->default('user')->comment('0 = SuperAdmin, 1 = Admin, 2 = hr, 3 = chief editor, 4 = sub editor, 5 = reading, 6 = reporting, 7 = graphics, user');
            $table->boolean('type')->default(0);
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
