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
        Schema::create('vnpay_payment', function (Blueprint $table) {
            $table->id();
            $table->string('vnp_amount',255)->nullable();
            $table->string('vnp_bankcode',255)->nullable();
            $table->string('vnp_banktranno',255)->nullable();
            $table->string('vnp_cardtype',255)->nullable();
            $table->string('vnp_orderinfo',255)->nullable();
            $table->string('vnp_paydate',255)->nullable();
            $table->string('vnp_tmncode',255)->nullable();
            $table->string('vnp_transactionno',255)->nullable();
            $table->string('vnp_transactionstatus',255)->nullable();
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
        Schema::dropIfExists('vnpay_payment');
    }
};
