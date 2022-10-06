<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use App\Models\Authentication\PasswordRequest;
use App\Models\Mailing\MailHistory;
use Illuminate\Support\Str;
use Src\Domain\Shared\Timestamp;
use Tests\Feature\Authentication\AuthenticationTestCase;

class RequestNewPasswordTest extends AuthenticationTestCase
{
    /** @test */
    public function error_when_entering_an_invalid_email()
    {
        $this
            ->getJson('/authentication/reset-password/blablabla')
            ->assertStatus(404)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }

    /** @test */
    public function error_when_entering_a_non_existent_email()
    {
        $this
            ->getJson('/authentication/reset-password/foo@bar.fr')
            ->assertStatus(404)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }

    /** @test */
    public function generate_a_new_request()
    {
        $there_are = count(PasswordRequest::all()->toArray());

        $this
            ->getJson('/authentication/reset-password/timothe@projet-eglise.fr')
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data',
            ]);

        $this->assertCount($there_are + 1, PasswordRequest::all()->toArray());
    }

    /** @test */
    public function returns_the_unexpired_request()
    {
        PasswordRequest::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => 2,
            'token' => 'taratata',
            'expiration' => Timestamp::now() + 10000,
            'is_used' => false,
        ]);

        $there_are = count(PasswordRequest::all()->toArray());

        $this->getJson('/authentication/reset-password/timothe@projet-eglise.fr')->assertStatus(200);

        $this->assertCount($there_are, PasswordRequest::all()->toArray());
    }

    /** @test */
    public function the_mail_has_been_sent()
    {
        $there_are = count(MailHistory::all()->toArray());

        $this->getJson('/authentication/reset-password/timothe@projet-eglise.fr')->assertStatus(200);

        $this->assertCount($there_are + 1, MailHistory::all()->toArray());
    }

    /** @test */
    public function returning_an_unexpired_request_sent_two_emails()
    {
        $there_are = count(MailHistory::all()->toArray());

        $this->getJson('/authentication/reset-password/timothe@projet-eglise.fr')->assertStatus(200);
        $this->getJson('/authentication/reset-password/timothe@projet-eglise.fr')->assertStatus(200);

        $this->assertCount($there_are + 2, MailHistory::all()->toArray());
    }

    /** @test */
    public function create_a_new_request_if_the_current_one_has_expired()
    {
        PasswordRequest::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => 2,
            'token' => 'taratata',
            'expiration' => Timestamp::now() - 10000,
            'is_used' => false,
        ]);

        $there_are = count(PasswordRequest::all()->toArray());

        $this->getJson('/authentication/reset-password/timothe@projet-eglise.fr')->assertStatus(200);

        $this->assertCount($there_are + 1, PasswordRequest::all()->toArray());
    }

    /** @test */
    public function create_a_new_request_if_the_current_one_has_used()
    {
        PasswordRequest::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => 2,
            'token' => 'taratata',
            'expiration' => Timestamp::now() + 10000,
            'is_used' => true,
        ]);

        $there_are = count(PasswordRequest::all()->toArray());

        $this->getJson('/authentication/reset-password/timothe@projet-eglise.fr')->assertStatus(200);

        $this->assertCount($there_are + 1, PasswordRequest::all()->toArray());
    }

    /** @test */
    public function returns_a_new_request_if_used()
    {
        PasswordRequest::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => 2,
            'token' => 'taratata',
            'expiration' => Timestamp::now() + 10000,
            'is_used' => true,
        ]);

        $there_are = count(PasswordRequest::all()->toArray());

        $this->getJson('/authentication/reset-password/timothe@projet-eglise.fr')->assertStatus(200);

        $this->assertCount($there_are + 1, PasswordRequest::all()->toArray());
    }
}
