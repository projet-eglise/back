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
        Schema::create('mailing_froms', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('mailing_mail_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->int('template_id');
            $table->unsignedBigInteger('from_id');
            $table->json('to');
            $table->json('params');
            $table->string('reply_to');
            $table->timestamp('sending_time');
            $table->timestamps();
            $table->foreign('from_id')->references('id')->on('mailing_froms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_histories');
        Schema::dropIfExists('mailing_froms');
    }
};
