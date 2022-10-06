<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Logs;

use Tests\Feature\Logs\TestCase;

class SeenTopicTest extends TestCase
{
    /** @test */
    public function see_an_unseen_topic()
    {
        $this
            ->getJson('/logs/seen-topic/4c9af8c9-949f-4ba3-8337-9136232616a4', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data',
            ]);
    }

    /** @test */
    public function see_a_topic_seen()
    {
        $this
            ->getJson('/logs/seen-topic/1dc6b226-c041-4889-8c3c-c321fbcf0860', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(422)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }

    /** @test */
    public function not_found_topic()
    {
        $this
            ->getJson('/logs/seen-topic/45a3fbad-c2c5-4917-8bf2-da52e26a1b1b', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(404)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }
}
