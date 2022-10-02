<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Authentication\AdminUser;
use App\Models\Authentication\PasswordRequest;
use App\Models\Authentication\User;
use App\Models\ChurchHumanRessources\Christian;
use App\Models\ChurchHumanRessources\Church;
use App\Models\ChurchHumanRessources\Member;
use App\Models\ChurchHumanRessources\Role;
use App\Models\ChurchHumanRessources\Service;
use App\Models\Logs\ErrorTopic;
use App\Models\Logs\Request;
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

        $uuid = 'b676230c-05c7-4aeb-b30b-9aff6229ba57';
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

        Church::create([
            'id' => 1,
            'uuid' => Str::uuid()->toString(),
            'name' => 'Eglise du Drapeau',
            'address' => '111 avenue du Drapeau',
            'postal_code' => '21000',
            'city' => 'Dijon',
            'pastor_id' => 2,
            'main_administrator_id' => 1,
        ]);

        Church::create([
            'id' => 2,
            'uuid' => Str::uuid()->toString(),
            'name' => 'Eglise de Timothé',
            'address' => '111 avenue du Drapeau (chez Timothé)',
            'postal_code' => '21000',
            'city' => 'Dijon',
            'pastor_id' => 2,
            'main_administrator_id' => 2,
        ]);

        Member::create([
            'id' => 1,
            'uuid' => Str::uuid()->toString(),
            'christian_id' => 1,
            'church_id' => 1,
        ]);

        Member::create([
            'id' => 2,
            'uuid' => Str::uuid()->toString(),
            'christian_id' => 2,
            'church_id' => 1,
        ]);

        Member::create([
            'id' => 3,
            'uuid' => Str::uuid()->toString(),
            'christian_id' => 3,
            'church_id' => 1,
        ]);

        Member::create([
            'id' => 4,
            'uuid' => Str::uuid()->toString(),
            'christian_id' => 2,
            'church_id' => 2,
        ]);

        Service::create([
            'id' => 1,
            'uuid' => Str::uuid()->toString(),
            'name' => 'Louange',
        ]);

        Role::create([
            'id' => 1,
            'uuid' => Str::uuid()->toString(),
            'name' => 'Musicien',
            'options' => '[ { "uuid": "7670dd4c-1e89-4b74-b87f-d29605a003d5", "name": "Guitare" }, { "uuid": "df44a391-c26f-49cb-9a82-e7c5ba405ae4", "name": "Piano" }, { "uuid": "31d09286-864a-4483-acaa-a0815de17976", "name": "Violon" } ]',
            'service_id' => 1,
        ]);

        ErrorTopic::create([
            'id' => 1,
            'uuid' => '4c9af8c9-949f-4ba3-8337-9136232616a4',
            'code' => 401,
            'message' => 'Invalid credentials',
            'error' => '',
            'file' => 'src/Application/Authentication/CheckCredentials.php',
            'line' => 200,
            'seen' => false,
            'known' => true,
        ]);
        Request::create([
            'id' => 1,
            'user_uuid' => null,
            'start' => microtime(true) * 10000,
            'duration' => (microtime(true) - (microtime(true) - 150)) * 1000,
            'code' => 401,
            'message' => 'Unauthorized',
            'ip' => '0.0.0.0',
            'method' => 'POST',
            'url' => 'admin/login',
            'params' => '{ "email": "user@projet-eglise.fr", "password": "********" }',
            'error_topic_id' => 1,
        ]);
        Request::create([
            'id' => 2,
            'user_uuid' => null,
            'start' => microtime(true) * 10000,
            'duration' => (microtime(true) - (microtime(true) - 150)) * 1000,
            'code' => 401,
            'message' => 'Unauthorized',
            'ip' => '0.0.0.0',
            'method' => 'POST',
            'url' => 'admin/login',
            'params' => '{ "email": "user@projet-eglise.fr", "password": "********" }',
            'error_topic_id' => 1,
        ]);

        ErrorTopic::create([
            'id' => 2,
            'uuid' => '1dc6b226-c041-4889-8c3c-c321fbcf0860',
            'code' => 401,
            'message' => 'Invalid credentials',
            'error' => '',
            'file' => 'src/Application/Authentication/CheckCredentials.php',
            'line' => 100,
            'seen' => true,
            'known' => true,
        ]);

        ErrorTopic::create([
            'id' => 3,
            'uuid' => 'd016eaba-8ab1-47d1-b116-198f14418b98',
            'code' => 401,
            'message' => 'Invalid credentials',
            'error' => '',
            'file' => 'src/Application/Authentication/CheckCredentials.php',
            'line' => 70,
            'seen' => false,
            'known' => false,
        ]);
    }
}
