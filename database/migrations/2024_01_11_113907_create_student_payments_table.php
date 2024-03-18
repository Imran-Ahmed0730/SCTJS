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
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->nullable();
            $table->bigInteger('student_roll')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('comment')->nullable();
            $table->string('payment_date')->nullable();
            $table->integer('payment_month')->nullable();
            $table->string('payment_year')->nullable();
            $table->string('bill_date')->nullable();
            $table->integer('bill_month')->nullable();
            $table->string('bill_year')->nullable();
            $table->integer('added_by')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>Paid, 0=Unpaid')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_payments');
    }
};
