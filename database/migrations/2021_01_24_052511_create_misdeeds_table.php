<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisdeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misdeeds', function (Blueprint $table) {
            $table->id();
            $table->string('offender_name');
            $table->string('offender_mobile');
            $table->string('license_number')->nullable();
            $table->string('car_model');
            $table->string('car_registration');
            $table->string('offence_location');
            $table->dateTime('time');
            $table->boolean('offender_decision');
            $table->unsignedBigInteger('offence')->index();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->unsignedBigInteger('court')->nullable()->index();
            $table->unsignedBigInteger('agent')->index();
            $table->unsignedBigInteger('prosecutor')->nullable()->index();
            $table->unsignedBigInteger('magistrate')->nullable()->index();
            $table->boolean('prosecutor_decision')->nullable();
            $table->boolean('magistrate_decision')->nullable();
            $table->boolean('bail_payment_status')->default('0');
            $table->boolean('fine_payment_status')->default('0');
            $table->foreign('offence')->references('id')->on('offences')->onDelete('cascade');
            $table->foreign('court')->references('id')->on('courts')->onDelete('cascade');
            $table->foreign('agent')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('prosecutor')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('magistrate')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('misdeeds');
    }
}
