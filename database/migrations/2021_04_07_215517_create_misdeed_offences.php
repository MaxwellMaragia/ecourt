<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisdeedOffences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misdeed_offences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('misdeed_id')->index();
            $table->unsignedBigInteger('offence_id')->index();
            $table->foreign('misdeed_id')->references('id')->on('misdeeds')->onDelete('cascade');
            $table->foreign('offence_id')->references('id')->on('offences')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('misdeed_offences');
    }
}
