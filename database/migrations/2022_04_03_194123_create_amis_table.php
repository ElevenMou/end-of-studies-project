<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user1');
            $table->unsignedBigInteger('user2');
            $table->foreign('user1')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');;
            $table->foreign('user2')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');;
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
        Schema::dropIfExists('amis');
    }
};
