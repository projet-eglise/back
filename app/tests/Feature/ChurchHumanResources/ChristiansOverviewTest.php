<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\ChurchHumanRessources\Christian;
use Tests\Feature\ChurchHumanResources\TestCase;

class ChristiansOverviewTest extends TestCase
{
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
                        'uuid',
                        'firstname',
                        'lastname',
                        'fullname',
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

    /** @test */
    public function retrieve_a_christian()
    {
        $this
            ->getJson('/church-human-ressources/christian/b676230c-05c7-4aeb-b30b-9aff6229ba57', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertExactJson([
                'code' => 200,
                'message' => 'OK',
                'data' => [
                    'uuid' => 'b676230c-05c7-4aeb-b30b-9aff6229ba57',
                    'firstname' => 'Timothé',
                    'lastname' => 'HOFMANN',
                    'fullname' => 'Timothé HOFMANN',
                    'email' => 'timothe@hofmann.fr',
                    'phone' => '+33 7 00 00 00 00',
                    'birthdate' => '2011-11-11',
                    'profile_picture' => '',
                ]
            ]);
    }
}
