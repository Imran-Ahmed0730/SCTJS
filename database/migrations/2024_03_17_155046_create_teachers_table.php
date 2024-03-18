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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('password');
            $table->text('image')->nullable();
            $table->text('address')->nullable();
            $table->integer('user_id')->unique();
            $table->integer('course_id')->nullable();
            $table->integer('batch_id')->nullable();
            $table->integer('designation')->nullable();
            $table->date('join_date');
            $table->decimal('salary', 8,2)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>Active; 2=>Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
