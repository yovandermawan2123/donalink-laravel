<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'role_id' => 1
            // 'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Yovan',
            'email' => 'yovan@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('rahasia'),
            'role_id' => 2
            // 'remember_token' => Str::random(10),
        ]);

        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'User',
        ]);

        $this->call(CampaignSeeder::class);
        // $this->call(CategorySeeder::class);
    }
}
