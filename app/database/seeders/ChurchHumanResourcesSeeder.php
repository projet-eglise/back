<?php

namespace Database\Seeders;

use App\Models\ChurchHumanRessources\Christian;
use App\Models\ChurchHumanRessources\Church;
use App\Models\ChurchHumanRessources\Member;
use App\Models\ChurchHumanRessources\Role;
use App\Models\ChurchHumanRessources\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChurchHumanResourcesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Christian::factory()->create([
            'id' => 1,
            'uuid' => 'a507d910-6f29-4d68-9b82-1afa2da8524d',
            'firstname' => 'Florence',
            'lastname' => 'HOFMANN',
            'email' => 'florence@projet-eglise.fr',
            'phone' => '+33 6 00 00 00 00',
            'birthdate' => '1987-01-01',
            'profile_picture' => '',
        ]);

        Christian::factory()->create([
            'id' => 2,
            'uuid' => '5c0f6b19-e031-41bb-a700-7c09c486c4c3',
            'firstname' => 'Timothé',
            'lastname' => 'HOFMANN',
            'email' => 'timothe@projet-eglise.fr',
            'phone' => '+33 7 00 00 00 00',
            'birthdate' => '2001-01-01',
            'profile_picture' => '',
        ]);

        Christian::factory()->create([
            'id' => 3,
            'uuid' => 'b676230c-05c7-4aeb-b30b-9aff6229ba57',
            'firstname' => 'Timothé',
            'lastname' => 'HOFMANN',
            'email' => 'timothe@hofmann.fr',
            'phone' => '+33 7 00 00 00 00',
            'birthdate' => '2011-11-11',
            'profile_picture' => '',
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
    }
}
