<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfils extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->string('streetAddress');
            $table->string('postCodeAddress');
            $table->string('cityAddress');
            $table->string('country');
            $table->string('mobilePhone');
            $table->string('businessPhone');
            $table->string('job');
            $table->string('businessSegment');
            $table->integer('user_id');
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
        Schema::dropIfExists('profils');
    }
}
