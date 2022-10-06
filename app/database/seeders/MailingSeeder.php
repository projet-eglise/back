<?php

namespace Database\Seeders;

use App\Models\Mailing\From;
use App\Models\Mailing\MailHistory;
use Illuminate\Database\Seeder;
use Src\Domain\Shared\Timestamp;

class MailingSeeder extends Seeder
{
    public function run()
    {
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
            'sending_time' => 16620268113513,
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