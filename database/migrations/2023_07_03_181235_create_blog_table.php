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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->unique()->nullable();
            $table->string('slug',255)->unique()->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url',255)->nullable();
            $table->boolean('status')->default(1)->nullable();// 1 show, 0 hide
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
