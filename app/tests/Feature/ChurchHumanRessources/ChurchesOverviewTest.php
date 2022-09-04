<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\ChurchHumanRessources\Christian;
use App\Models\ChurchHumanRessources\Church;
use Tests\TestCase;

class ChurchesOverviewTest extends TestCase
{
    const EMAIL = 'timothe@projet-eglise.fr';

    /** @test */
    public function retrieve_all_data()
    {
        $response = $this
            ->getJson('/church-human-ressources/churches/all', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    [
                        'name',
                        'pastor' => [
                            'firstname',
                            'lastname',
                        ],
                        'main_administrator' => [
                            'firstname',
                            'lastname',
                        ],
                        'address',
                        'postal_code',
                        'city',
                    ]
                ]
            ]);

        $content = json_decode($response->getContent(), true);

        $this->assertCount(count(Church::all()->toArray()), $content['data']);
    }
}
