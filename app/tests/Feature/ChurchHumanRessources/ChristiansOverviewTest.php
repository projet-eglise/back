<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\ChurchHumanRessources\Christian;
use Tests\TestCase;

class ChristiansOverviewTest extends TestCase
{
    const EMAIL = 'timothe@projet-eglise.fr';

    /** @test */
    public function retrieve_all_data()
    {
        $response = $this
            ->getJson('/church-human-ressources/christians/all', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    [
                        'firstname',
                        'lastname',
                        'email',
                        'phone',
                        'birthdate',
                        'profile_picture',
                    ]
                ]
            ]);

        $content = json_decode($response->getContent(), true);

        $this->assertCount(count(Christian::all()->toArray()), $content['data']);
    }
}
