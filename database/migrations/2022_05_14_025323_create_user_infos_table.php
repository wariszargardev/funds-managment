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
            $table->string('received_from')->default('');
            $table->string('company_name')->default('');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('bank_name')->nullable();
            $table->double('amount')->nullable();
            $table->string('deposited_by')->nullable();
            $table->string('amount_type')->nullable();
            $table->integer('user_id');
            $table->text('image')->nullable();
            $table->date('date')->default(now());
            $table->text('cheque_pay_order_no')->nullable();
            // new fields
            $table->string('payment_in');//pkr or usd
            $table->string('reference_by');
            $table->string('street')->default('');
            $table->integer('province_id')->default(0);
            $table->integer('city_id')->default(0);
            $table->integer('country_id')->default(0);
            $table->string('land_line_number')->default('');

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
