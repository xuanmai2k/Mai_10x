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
        Schema::create('momo_payment', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',255)->nullable();
            $table->string('request_id',255)->nullable();
            $table->string('amount',255)->nullable();
            $table->string('order_info',255)->nullable();
            $table->string('order_type',255)->nullable();
            $table->string('trans_id',255)->nullable();
            $table->string('partner_code',255)->nullable();
            $table->string('pay_type',255)->nullable();
            $table->string('response_time',255)->nullable();
            $table->string('message',255)->nullable();
            $table->unsignedbigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('momo_payment');
    }
};
