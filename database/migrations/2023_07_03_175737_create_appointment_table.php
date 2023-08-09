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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->integer('age')->unsigned()->nullable();
            //foreign key user
            $table->unsignedbigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            //foreign key doctor
            $table->unsignedbigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctor')->onDelete('cascade');
            //foreign key nurse
            $table->unsignedbigInteger('nurse_id')->nullable();
            $table->foreign('nurse_id')->references('id')->on('nurse')->onDelete('cascade');
            //foreign key product
            $table->unsignedbigInteger('product_category_id')->nullable();
            $table->foreign('product_category_id')->references('id')->on('product_category')->onDelete('cascade');
            //foreign key product
            $table->unsignedbigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->date('date_appointment')->nullable();
            $table->time('time_appointment')->nullable();
            $table->decimal('total_price')->unsigned()->nullable();
            $table->integer('status')->default(1)->nullable();//1 book, 2 used, 3 cancel
            $table->integer('pay_by')->default(0)->nullable();//0 hand, 1 momo, 2 vnpay
            $table->integer('rating')->unsigned()->nullable();
            $table->string('comment',255)->nullable();
            $table->string('status_payment',255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
