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
        Schema::create('chr_christians', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('birthdate');
            $table->string('profile_picture');
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
        Schema::dropIfExists('christians');
    }
};