<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->integer('transaction_type');
            $table->string('payment_method');
            $table->double('amount');
            $table->string('ccy');
            $table->string('country_code');
            $table->integer('status');
            $table->unsignedInteger('to_user_id');
            $table->string('intent');
            $table->string('payer_id');
            $table->string('payee_email');
            $table->string('given_name');
            $table->string('surname');
            $table->string('merchant_id');
            $table->string('payer_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_transaction');
    }
}
