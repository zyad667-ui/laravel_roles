<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(RoleSeeder::class);

        // Then, create the admin user and assign the admin role
        User::factory()->create([
            'name' => 'musiala',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ])->assignRole('admin');
    }
}
