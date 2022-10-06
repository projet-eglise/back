<?php

namespace Database\Seeders;

use App\Models\Authentication\AdminUser;
use App\Models\Authentication\PasswordRequest;
use App\Models\Authentication\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthenticationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'id' => 1,
            'uuid' => 'a507d910-6f29-4d68-9b82-1afa2da8524d',
            'email' => 'florence@projet-eglise.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        User::factory()->create([
            'id' => 2,
            'uuid' => '5c0f6b19-e031-41bb-a700-7c09c486c4c3',
            'email' => 'timothe@projet-eglise.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        User::factory()->create([
            'id' => 3,
            'uuid' => 'b676230c-05c7-4aeb-b30b-9aff6229ba57',
            'email' => 'timothe@hofmann.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        AdminUser::factory()->create([
            'id' => 1,
            'uuid' => Str::uuid()->toString(),
            'user_id' => 1,
        ]);

        AdminUser::factory()->create([
            'id' => 2,
            'uuid' => Str::uuid()->toString(),
            'user_id' => 2,
        ]);

        PasswordRequest::create([
            'id' => 1,
            'uuid' => Str::uuid()->toString(),
            'token' => 'aaa',
            'expiration' => 20000000000000,
            'user_id' => 1,
            'is_used' => true,
        ]);

        PasswordRequest::create([
            'id' => 2,
            'uuid' => Str::uuid()->toString(),
            'token' => 'bbb',
            'expiration' => 20000000000000,
            'user_id' => 1,
            'is_used' => false,
        ]);

        PasswordRequest::create([
            'id' => 3,
            'uuid' => Str::uuid()->toString(),
            'token' => 'ccc',
            'expiration' => 16619832000000,
            'user_id' => 1,
            'is_used' => false,
        ]);

        PasswordRequest::create([
            'id' => 4,
            'uuid' => Str::uuid()->toString(),
            'token' => 'ddd',
            'expiration' => 16619832000000,
            'user_id' => 1,
            'is_used' => true,
        ]);
    }
}
