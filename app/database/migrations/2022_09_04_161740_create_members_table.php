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
        Schema::create('chr_members', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('christian_id');
            $table->unsignedBigInteger('church_id');
            $table->timestamps();
            $table->foreign('christian_id')->references('id')->on('chr_christians');
            $table->foreign('church_id')->references('id')->on('chr_churches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chr_members', function (Blueprint $table) {
            $table->dropForeign(['christian_id', 'church_id']);
            $table->dropColumn(['christian_id', 'church_id']);
        });
        Schema::dropIfExists('chr_members');
    }
};
