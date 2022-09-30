<?php

use App\Models\Logs\ErrorTopic;
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
        Schema::create('logs_traces', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->integer('line');
            $table->string('function');
            $table->foreignIdFor(ErrorTopic::class);
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
        Schema::dropIfExists('logs_traces');
    }
};
