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
        Schema::create('course_module_results', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('student_id')->nullable();
            $table->BigInteger('course_id')->nullable();
            $table->string('module_id')->nullable();
            $table->decimal('marks', 8,2)->nullable();
            $table->integer('grade')->nullable();
            $table->tinyInteger('status')->nullable()->default(1)->comment('1=Active, 0=Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_module_results');
    }
};
