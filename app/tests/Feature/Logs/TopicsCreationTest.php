<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Logs;

use App\Models\Logs\ErrorTopic;
use Tests\Feature\Logs\TestCase;

class TopicsCreationTest extends TestCase
{
    /** @test */
    public function add_topic()
    {
        $start = ErrorTopic::all()->count();

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

        $this->assertEquals($start + 1, ErrorTopic::all()->count());

        $last = ErrorTopic::all()->last();
        $this->assertEquals(403, $last->code);
        $this->assertEquals('You are not an administrator.', $last->message);
    }

    /** @test */
    public function add_topics()
    {
        $start = ErrorTopic::all()->count();

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
            ->postJson('/authentication/login', [
                'email' => 'timothe@hofmannn.fr',
                'password' => 'password',
            ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);

        $this->assertEquals($start + 2, ErrorTopic::all()->count());
    }
}
