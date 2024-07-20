<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        Role::create([
            'role_name' => 'admin',
        ]);

        Role::create([
            'role_name' => 'user',
        ]);

        User::factory(5)->create();
    }
}
