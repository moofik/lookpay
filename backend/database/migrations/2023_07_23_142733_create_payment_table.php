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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('currency_from')->nullable()->comment('from currency');
            $table->string('currency_to')->nullable()->comment('to currency');
            $table->string('bank')->nullable()->comment('bank');
            $table->decimal('payment_amount')->nullable()->comment('payment amount');
            $table->string('payment_method')->nullable()->comment('recipient issuer bank');
            $table->string('payment_address')->nullable()->comment('recipient bank address');
            $table->string('attachment')->nullable()->comment('payment confirmation attachment');
            $table->string('payment_uuid')->unique()->comment('uuid');

            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
