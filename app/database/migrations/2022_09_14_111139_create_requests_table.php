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
        Schema::create('logs_requests', function (Blueprint $table) {
            $table->id();
            $table->string('start', 14);
            $table->integer('duration');
            $table->string('code', 3);
            $table->string('message');
            $table->ipAddress('ip');
            $table->string('method', 7);
            $table->string('url');
            $table->json('params');
            $table->json('response');
            $table->foreignIdFor(ErrorTopic::class)->nullable();
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
        Schema::dropIfExists('logs_requests');
    }
};
