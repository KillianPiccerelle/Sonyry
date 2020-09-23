<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareGroupPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_group_policies', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->unsignedBigInteger('share_group_id');
            $table->foreign('share_group_id')->references('id')->on('share_groups');
            $table->boolean('read');
            $table->boolean('write');
            $table->boolean('execute');
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
        Schema::dropIfExists('share_group_policies');
    }
}
