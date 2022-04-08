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
        Schema::create('profile_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporter');
            $table->unsignedBigInteger('reported');
            $table->foreign('reporter')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('reported')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('profile_reports');
    }
};
