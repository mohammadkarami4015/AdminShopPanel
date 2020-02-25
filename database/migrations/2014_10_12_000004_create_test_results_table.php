<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('value');
            $table->string('tip');
            $table->string('status')->default('off')->nullable();
            $table->bigInteger('test_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_results');
    }
}
