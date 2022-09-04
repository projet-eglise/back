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
        Schema::create('chr_churches', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->unsignedBigInteger('pastor_id');
            $table->unsignedBigInteger('main_administrator_id');
            $table->string('address');
            $table->string('postal_code', 5);
            $table->string('city');
            $table->timestamps();
            $table->foreign('pastor_id')->references('id')->on('chr_christians');
            $table->foreign('main_administrator_id')->references('id')->on('chr_christians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chr_churches', function (Blueprint $table) {
            $table->dropForeign(['pastor_id', 'main_administrator_id']);
            $table->dropColumn(['pastor_id', 'main_administrator_id']);
        });
        Schema::dropIfExists('chr_churches');
    }
};
