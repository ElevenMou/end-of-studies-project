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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->longText('description')->nullable();
            $table->string('filiere');
            $table->string('semestre');
            $table->boolean('lock')->default(false);
            $table->string('password')->nullable();
            $table->string('thumbnail')->default('images/thumbnails/default-thumbnail.jpg');
            $table->unsignedBigInteger('enseignant');
            $table->foreign('enseignant')->references('id')->on('users')->onUpdate('cascade')
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
        Schema::dropIfExists('modules');
    }
};
