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
//        Schema::table('anonymous_payments', function (Blueprint $table) {
//            Schema::create('anonymous_payments', function (Blueprint $table) {
//                $table->id();
//                $table->string('currency')->comment('payment currency');
//                $table->decimal('payment_amount')->comment('payment amount');
//                $table->string('payment_method')->comment('recipient issuer bank');
//                $table->string('tokens_amount')->nullable()->comment('recipient issuer bank');
//                $table->string('recipient_address')->nullable()->comment('recipient bank address');
//                $table->string('trc20')->nullable()->comment('trc20 wallet');
//                $table->string('email')->nullable()->comment('email');
//                $table->string('attachment')->nullable()->comment('payment confirmation attachment');
//                $table->string('payment_uuid')->unique()->comment('uuid');
//
//                $table->softDeletesTz();
//                $table->timestampsTz();
//            });
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
