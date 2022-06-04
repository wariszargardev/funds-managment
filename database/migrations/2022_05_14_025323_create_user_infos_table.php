<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('received_from');
            $table->string('company_name');
            $table->string('email')->nullable();
            $table->text('address');
            $table->text('bank_name');
            $table->double('amount');
            $table->string('deposited_by');
            $table->string('amount_type');
            $table->integer('user_id');
            $table->text('image');
            $table->date('date')->default(now());
            $table->text('cheque_pay_order_no');
            // new fields
            $table->string('payment_in');//pkr or usd
            $table->string('reference_by');
            $table->string('street');
            $table->string('province');
            $table->string('city');
            $table->string('country');

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
        Schema::dropIfExists('user_infos');
    }
}
