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
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->unique()->nullable();
            $table->string('slug',255)->unique()->nullable();
            $table->decimal('price',11,0)->unsigned()->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url',255)->nullable();
            $table->boolean('status')->default(1);// 1 show, 2 hide
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
