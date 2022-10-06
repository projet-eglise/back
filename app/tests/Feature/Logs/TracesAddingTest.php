<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Logs;

use App\Models\Logs\Trace;
use Tests\Feature\Logs\TestCase;

class TracesAddingTest extends TestCase
{
    /** @test */
    public function add_traces()
    {
        $start = Trace::all()->count();

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

        $this->assertTrue($start < Trace::all()->count());
    }
}
