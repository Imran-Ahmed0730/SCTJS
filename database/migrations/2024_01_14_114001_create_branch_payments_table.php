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
        Schema::create('branch_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->decimal('payment', 8,2)->default(0.00);
            $table->text('comments')->nullable();
            $table->integer('bill_month');
            $table->bigInteger('bill_year');
            $table->string('bill_date')->nullable();
            $table->string('payment_date');
            $table->tinyInteger('status')->default(0)->comment('1=paid, 0=unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_payments');
    }
};
