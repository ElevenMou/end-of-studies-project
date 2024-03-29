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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('identifiant')->unique();
            $table->string('prenom');
            $table->string('nom');
            $table->string('filiere');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('type')->default(0);
            $table->integer('statu')->default(0);
            $table->integer('isModerator')->default(0);
            $table->string('avatar')->default('images/avatars/default-avatar.jpg');
            $table->longText('description')->nullable();
            $table->rememberToken();
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
};
