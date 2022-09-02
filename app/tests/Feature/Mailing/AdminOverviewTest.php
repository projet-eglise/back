<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\Mailing\MailHistory as ModelMailHistory;
use Tests\TestCase;

class AdminOverviewTest extends TestCase
{
    const EMAIL = 'timothe@projet-eglise.fr';

    /** @test */
    public function retrieve_all_data()
    {
        $response = $this
            ->getJson('/mailing/all', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    [
                        'templateAddress',
                        'subject',
                        'response' => [
                            'code',
                            'message',
                        ],
                        'from' => [
                            'name',
                            'email',
                        ],
                        'to' => [
                            [
                                'email',
                            ]
                        ],
                        'params',
                        'sending_time',
                    ]
                ]
            ]);

        $content = json_decode($response->getContent(), true);

        $this->assertCount(count(ModelMailHistory::all()->toArray()), $content['data']);
    }
}
