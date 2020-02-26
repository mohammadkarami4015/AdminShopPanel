<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('status')->default('off')->nullable();
            $table->string('type')->default("normal");
            $table->string('phone_number')->nullable();
            $table->string('admin_verification')->nullable()->default("off");
            $table->string('ref_code')->nullable();
            $table->string('caller')->nullable();
            $table->string('photo')->nullable();
            $table->longText('about_me')->nullable();
            $table->string('level')->default('student')->nullable();
            $table->string('card_number')->nullable();
            $table->string('sheba')->nullable();
            $table->string('national_id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
