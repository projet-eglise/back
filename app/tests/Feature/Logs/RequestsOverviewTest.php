<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\Logs\Request;
use Tests\TestCase;

class RequestsOverviewTest extends TestCase
{
    /** @test */
    public function retrieve_all_data()
    {
        $response = $this
            ->getJson('/logs/requests', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    [
                        'code',
                        'message',
                        'user' => [
                            'uuid',
                            'firstname',
                            'lastname',
                            'fullname',
                            'profile_picture',
                        ],
                        'ip',
                        'start',
                        'method',
                        'route',
                        'params',
                        'response',
                    ]
                ]
            ]);

        $content = json_decode($response->getContent(), true);

        // Plus one for the query that returns the result ;-)
        $this->assertEquals(Request::all()->count(), count($content['data']) + 1);
    }
}
