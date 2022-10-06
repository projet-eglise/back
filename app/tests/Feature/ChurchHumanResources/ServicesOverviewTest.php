<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\ChurchHumanRessources\Role;
use App\Models\ChurchHumanRessources\Service;
use Tests\Feature\ChurchHumanResources\TestCase;

class ServicesOverviewTest extends TestCase
{
    /** @test */
    public function retrieve_all_data()
    {
        $response = $this
            ->getJson('/church-human-ressources/services-with-roles-and-options', ['Authorization' => "Bearer {$this->userToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [
                    [
                        'name',
                        "uuid",
                        'roles' => [
                            [
                                "name",
                                "uuid",
                                "options" => [
                                    [
                                        "uuid",
                                        'name',
                                    ]
                                ],
                            ],
                        ],
                    ]
                ]
            ]);

        $content = json_decode($response->getContent(), true);

        $this->assertCount(count(Service::all()->toArray()), $content['data']);

        foreach (Service::all() as $service)
            $roles[] = count(Role::where('service_id', $service->id)->get());

        $this->assertCount(count(Role::all()->toArray()), $roles ?? []);
    }
}
