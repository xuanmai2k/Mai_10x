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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name_product',255)->unique()->nullable();
            $table->string('slug',255)->unique()->nullable();
            //foreign key product category
            $table->unsignedbigInteger('product_category_id')->nullable();
            $table->foreign('product_category_id')->references('id')->on('product_category')->onDelete('cascade');
            $table->decimal('price',11,0)->unsigned()->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->string('made_in', 255)->nullable();
            $table->float('dosage')->unsigned()->nullable();//liều lượng
            $table->integer('qty')->unsigned()->nullable();
            $table->string('image_url',255)->nullable();
            $table->boolean('status')->default(1)->nullable();// 1 show, 0 hide
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
