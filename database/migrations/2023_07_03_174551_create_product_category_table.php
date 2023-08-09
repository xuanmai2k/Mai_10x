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
        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->unique()->nullable();
            $table->string('slug',255)->unique()->nullable();
            $table->integer('minimum_limit_age')->unsigned()->nullable();
            $table->integer('maximum_limit_age')->unsigned()->nullable();
            $table->integer('quantity_for_injection')->unsigned()->nullable();
            $table->boolean('status')->default(1)->nullable(); // ẩn hiện
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
};
