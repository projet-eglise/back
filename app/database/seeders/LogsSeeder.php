<?php

namespace Database\Seeders;

use App\Models\Logs\ErrorTopic;
use App\Models\Logs\Request;
use App\Models\Logs\Trace;
use Illuminate\Database\Seeder;

class LogsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ErrorTopic::create([
            'id' => 1,
            'uuid' => '4c9af8c9-949f-4ba3-8337-9136232616a4',
            'code' => 401,
            'message' => 'Invalid credentials',
            'error' => '',
            'file' => 'src/Application/Authentication/CheckCredentials.php',
            'line' => 200,
            'seen' => false,
            'known' => true,
        ]);
        Request::create([
            'id' => 1,
            'user_uuid' => null,
            'start' => microtime(true) * 10000,
            'duration' => (microtime(true) - (microtime(true) - 150)) * 1000,
            'code' => 401,
            'message' => 'Unauthorized',
            'ip' => '0.0.0.0',
            'method' => 'POST',
            'url' => 'admin/login',
            'params' => '{ "email": "user@projet-eglise.fr", "password": "********" }',
            'error_topic_id' => 1,
        ]);
        Request::create([
            'id' => 2,
            'user_uuid' => null,
            'start' => microtime(true) * 10000,
            'duration' => (microtime(true) - (microtime(true) - 150)) * 1000,
            'code' => 401,
            'message' => 'Unauthorized',
            'ip' => '0.0.0.0',
            'method' => 'POST',
            'url' => 'admin/login',
            'params' => '{ "email": "user@projet-eglise.fr", "password": "********" }',
            'error_topic_id' => 1,
        ]);
        Trace::create([
            'id' => 1,
            'file' => 'hello_world.php',
            'line' => 1,
            'function' => 'hello_world',
            'error_topic_id' => 1,
        ]);

        ErrorTopic::create([
            'id' => 2,
            'uuid' => '1dc6b226-c041-4889-8c3c-c321fbcf0860',
            'code' => 401,
            'message' => 'Invalid credentials',
            'error' => '',
            'file' => 'src/Application/Authentication/CheckCredentials.php',
            'line' => 100,
            'seen' => true,
            'known' => true,
        ]);

        ErrorTopic::create([
            'id' => 3,
            'uuid' => 'd016eaba-8ab1-47d1-b116-198f14418b98',
            'code' => 401,
            'message' => 'Invalid credentials',
            'error' => '',
            'file' => 'src/Application/Authentication/CheckCredentials.php',
            'line' => 70,
            'seen' => false,
            'known' => false,
        ]);
    }
}
