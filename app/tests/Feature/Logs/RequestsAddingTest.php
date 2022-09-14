<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Logs;

use App\Models\Logs\ErrorTopic;
use App\Models\Logs\Request;
use Tests\TestCase;

class RequestsAddingTest extends TestCase
{
    /** @test */
    public function add_request()
    {
        $start = Request::all()->count();

        $this
            ->postJson('/authentication/admin/login', [
                'email' => 'timothe@hofmann.fr',
                'password' => 'password',
            ])
            ->assertStatus(403)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);

        $this->assertEquals($start + 1, Request::all()->count());
    }

    /** @test */
    public function add_requests()
    {
        $startRequests = Request::all()->count();
        $startTopics = ErrorTopic::all()->count();

        $this
            ->postJson('/authentication/admin/login', [
                'email' => 'timothe@hofmann.fr',
                'password' => 'password',
            ])
            ->assertStatus(403)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);

        $this
            ->postJson('/authentication/admin/login', [
                'email' => 'timothe@projet-eglise.fr',
                'password' => 'password',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data',
            ]);

        $this->assertEquals($startRequests + 2, Request::all()->count());
        $this->assertEquals($startTopics + 1, ErrorTopic::all()->count());
    }
}
