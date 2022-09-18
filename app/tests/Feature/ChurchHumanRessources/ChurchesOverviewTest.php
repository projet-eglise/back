<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\ChurchHumanRessources\Christian;
use App\Models\ChurchHumanRessources\Church;
use Tests\TestCase;

class ChurchesOverviewTest extends TestCase
{
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
                            'fullname',
                        ],
                        'main_administrator' => [
                            'firstname',
                            'lastname',
                            'fullname',
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

    /** @test */
    public function retrieve_joinable_churches()
    {
        $response = $this
            ->getJson('/church-human-ressources/churches/joinable', ['Authorization' => "Bearer {$this->userToken('florence@projet-eglise.fr')}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    [
                        'uuid',
                        'name',
                        'pastor' => [
                            'firstname',
                            'lastname',
                            'fullname',
                        ],
                        'joinable',
                    ]
                ]
            ]);

        $content = json_decode($response->getContent(), true);

        $this->assertCount(count(Church::all()->toArray()), $content['data']);
    }
}
