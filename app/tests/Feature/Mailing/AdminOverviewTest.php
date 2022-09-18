<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\Mailing\MailHistory as ModelMailHistory;
use Tests\TestCase;

class AdminOverviewTest extends TestCase
{
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

    /** @test */
    public function retrieve_for_a_christian()
    {
        $this
            ->getJson('/mailing/all-for-user/timothe@projet-eglise.fr', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertExactJson([
                'code' => 200,
                'message' => 'OK',
                'data' => [
                    [
                        'templateAddress' => 'https://my.sendinblue.com/camp/template/1/message-setup',
                        'subject' => "Réinitialisation de votre mot de passe Projet d'Eglise",
                        'response' => [
                            'code' => 404,
                            'message' => 'Error message',
                        ],
                        'from' => [
                            'name' => "Projet d'Eglise",
                            'email' => 'password-requests@projet-eglise.fr',
                        ],
                        'to' => [
                            [
                                'email' => 'florence@projet-eglise.fr',
                            ]
                        ],
                        'params' => '{ "url": "https://localhost:3000/reset-password/token" }',
                        'sending_time' => 16620268113513,
                    ]
                ]
            ]);
    }
}
