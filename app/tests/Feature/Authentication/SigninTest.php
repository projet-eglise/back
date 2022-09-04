<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SigninTest extends TestCase
{
    /** @test */
    public function user_signin()
    {
        $this
            ->postJson('/authentication/signin', [
                'firstname' => 'Florence',
                'lastname' => 'HOFMANN',
                'email' => 'fgaconcamoz@gmail.com',
                'password' => '@Zertyu1p23',
                'birthdate' => '1987-03-03',
                'phone' => '+33600000000',
                'profile_picture' => UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => ['token']
            ]);

        $this
            ->postJson('/authentication/login', [
                'email' => 'fgaconcamoz@gmail.com',
                'password' => '@Zertyu1p23',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => ['token']
            ]);
    }

        /** @test */
        public function user_signin_without_profile_picture()
        {
            $this
                ->postJson('/authentication/signin', [
                    'firstname' => 'Florence',
                    'lastname' => 'HOFMANN',
                    'email' => 'fgaconcamoz@gmail.com',
                    'password' => '@Zertyu1p23',
                    'birthdate' => '1987-03-03',
                    'phone' => '+33600000000',
                ])
                ->assertStatus(200)
                ->assertJsonStructure([
                    'code',
                    'message',
                    'data' => ['token']
                ]);
    
            $this
                ->postJson('/authentication/login', [
                    'email' => 'fgaconcamoz@gmail.com',
                    'password' => '@Zertyu1p23',
                ])
                ->assertStatus(200)
                ->assertJsonStructure([
                    'code',
                    'message',
                    'data' => ['token']
                ]);
        }

    /** @test */
    public function user_already_exists()
    {
        $this
            ->postJson('/authentication/signin', [
                'firstname' => 'Florence',
                'lastname' => 'HOFMANN',
                'email' => 'florence@projet-eglise.fr',
                'password' => '@Zertyu1p23aze',
                'birthdate' => '1987-03-03',
                'phone' => '+33600000000',
                'profile_picture' => UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertStatus(409)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }
}
