<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amount');
            $table->string('type');
            $table->string('card_number')->nullable();
            $table->string('sheba')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('payment_request_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_request_id')->references('id')->on('payment_requests')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_payments');
    }
}
