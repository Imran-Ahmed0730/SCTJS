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
        Schema::create('branch_applies', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('father_name');
            $table->string('nid_number');
            $table->string('institution_name_en');
            $table->string('institution_name_bn');
            $table->text('address_en');
            $table->text('address_bn');
            $table->string('phone');
            $table->string('email');
            $table->text('head_image');
            $table->text('nid_image');
            $table->text('trade_licence_image');
            $table->string('status')->default('0')->comment('0=>pending,1=>Approved ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_applies');
    }
};
