<?php

use App\Models\Logs\Request;
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
        Schema::create('logs_error_topics', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('message');
            $table->string('error');
            $table->string('file');
            $table->integer('line');
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
        Schema::dropIfExists('logs_error_topics');
    }
};
