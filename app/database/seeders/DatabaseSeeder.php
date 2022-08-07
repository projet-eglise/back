<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Authentication\AdminUser;
use App\Models\Authentication\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
    }
}
