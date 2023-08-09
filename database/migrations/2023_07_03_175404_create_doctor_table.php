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
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('slug',255)->unique()->nullable();
            $table->string('email',255)->unique()->nullable();
            $table->string('phone',255)->unique()->nullable();
            $table->date('dob')->nullable();
            $table->string('position',255)->nullable();
            $table->text('short_information')->nullable();
            $table->text('information')->nullable();
            $table->text('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};
