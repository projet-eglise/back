<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Authentication\AdminUser;
use App\Models\Authentication\PasswordRequest;
use App\Models\Authentication\User;
use App\Models\ChurchHumanRessources\Christian;
use App\Models\Mailing\From;
use App\Models\Mailing\MailHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Src\Domain\Shared\Timestamp;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $uuid = Str::uuid()->toString();
        User::factory()->create([
            'id' => 1,
            'uuid' => $uuid,
            'email' => 'florence@projet-eglise.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Christian::factory()->create([
            'id' => 1,
            'uuid' => $uuid,
            'firstname' => 'Florence',
            'lastname' => 'HOFMANN',
            'email' => 'florence@projet-eglise.fr',
            'phone' => '+33 6 00 00 00 00',
            'birthdate' => '1987-01-01',
            'profile_picture' => '',
        ]);

        $uuid = Str::uuid()->toString();
        User::factory()->create([
            'id' => 2,
            'uuid' => $uuid,
            'email' => 'timothe@projet-eglise.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Christian::factory()->create([
            'id' => 2,
            'uuid' => $uuid,
            'firstname' => 'Timothé',
            'lastname' => 'HOFMANN',
            'email' => 'timothe@projet-eglise.fr',
            'phone' => '+33 7 00 00 00 00',
            'birthdate' => '2001-01-01',
            'profile_picture' => '',
        ]);

        $uuid = Str::uuid()->toString();
        User::factory()->create([
            'id' => 3,
            'uuid' => $uuid,
            'email' => 'timothe@hofmann.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Christian::factory()->create([
            'id' => 3,
            'uuid' => $uuid,
            'firstname' => 'Timothé',
            'lastname' => 'HOFMANN',
            'email' => 'timothe@hofmann.fr',
            'phone' => '+33 7 00 00 00 00',
            'birthdate' => '2011-11-11',
            'profile_picture' => '',
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

        From::factory()->create([
            'id' => 1,
            'uuid' => 'fa464b4f-6f58-4c5c-bbd3-7611959c2bab',
            'name' => "Projet d'Eglise",
            'email' => 'password-requests@projet-eglise.fr',
        ]);

        MailHistory::factory()->create([
            'id' => 1,
            'template_id' => 1,
            'from_id' => 1,
            'to' => '[ { "name": "", "email": "timothe@projet-eglise.fr" } ]',
            'params' => '{ "url": "https://localhost:3000/reset-password/token" }',
            'reply_to' => 'password-requests@projet-eglise.fr',
            'sending_time' => Timestamp::now(),
            'api_response_code' => 404,
            'api_response_message' => 'Error message',
        ]);

        MailHistory::factory()->create([
            'id' => 2,
            'template_id' => 1,
            'from_id' => 1,
            'to' => '[ { "name": "", "email": "florence@projet-eglise.fr" } ]',
            'params' => '{ "url": "https://localhost:3000/reset-password/token" }',
            'reply_to' => 'password-requests@projet-eglise.fr',
            'sending_time' => Timestamp::now(),
            'api_response_code' => 200,
            'api_response_message' => 'OK',
        ]);
    }
}
