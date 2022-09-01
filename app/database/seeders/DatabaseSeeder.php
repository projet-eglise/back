<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Authentication\AdminUser;
use App\Models\Authentication\User;
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
        User::factory()->create([
            'id' => 1,
            'uuid' => Str::uuid()->toString(),
            'email' => 'florence@projet-eglise.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        User::factory()->create([
            'id' => 2,
            'uuid' => Str::uuid()->toString(),
            'email' => 'timothe@projet-eglise.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        User::factory()->create([
            'id' => 3,
            'uuid' => Str::uuid()->toString(),
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
