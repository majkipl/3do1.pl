<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname', 128);
            $table->string('lastname', 128);
            $table->date('birthday');
            $table->string('email', 320)->unique();
            $table->string('phone', 32);
            $table->string('shop', 128);
            $table->string('product_code', 16);
            $table->string('img_receipt', 255);
            $table->boolean('legal_1')->default(true);
            $table->boolean('legal_2')->default(true);
            $table->boolean('legal_3')->default(true);
            $table->boolean('legal_4')->default(true);
            $table->boolean('legal_5')->default(false);
            $table->boolean('legal_6')->default(false);

            $table->boolean('is_main_prize')->default(false);
            $table->string('competition_title', 128)->nullable();
            $table->string('competition_audio', 255)->nullable();

            $table->boolean('is_week_prize')->default(false);
            $table->bigInteger('timer')->nullable();
            $table->string('response')->nullable();
            $table->tinyInteger('correct')->nullable();

            $table->string('token', 32)->nullable();

            $table->timestamps();

            $table->unsignedBigInteger('whence_id');

            $table->foreign('whence_id')->references('id')->on('whences')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
