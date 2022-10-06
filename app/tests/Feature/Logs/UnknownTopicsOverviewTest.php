<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Logs;

use App\Models\Logs\ErrorTopic;
use Tests\Feature\Logs\TestCase;

class UnknownTopicsOverviewTest extends TestCase
{
    /** @test */
    public function retrieve_all_data()
    {
        $response = $this
            ->getJson('/logs/topics/unknown', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    [
                        'uuid',
                        'code',
                        'message',
                        'error',
                        'file',
                        'line',
                        'last_day',
                        'seen',
                        'occurrences' => [
                            [
                                'start',
                                'end',
                                'number',
                                'percentage',
                            ]
                        ],
                    ]
                ]
            ]);

        $content = json_decode($response->getContent(), true);

        $this->assertEquals(ErrorTopic::where('known', false)->get()->count(), count($content['data']));
        $this->assertEquals(24, count($content['data'][0]['occurrences']));
        
        $count = 0;
        foreach ($content['data'][0]['occurrences'] as $occur) $count += $occur['number'];
        $this->assertEquals($count, $content['data'][0]['last_day']);
    }
}
