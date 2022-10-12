<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Logs;

use App\Models\Logs\ErrorTopic;
use App\Models\Logs\Request;
use Tests\Feature\Logs\TestCase;

class TopicOverviewTest extends TestCase
{
    /** @test */
    public function retrieve_one()
    {
        $this
            ->getJson('/logs/error-with-requests-and-traces/4c9af8c9-949f-4ba3-8337-9136232616a4', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    'uuid',
                    'code',
                    'message',
                    'error',
                    'file',
                    'line',
                    'requests' => [[
                        'code',
                        'message',
                        'user',
                        'ip',
                        'start',
                        'method',
                        'route',
                        'params',
                        'response'
                    ]],
                    'traces' => [[
                        'file',
                        'line',
                        'function',
                    ]],
                ],
            ]);
    }
}
