<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsRole::insert([
            [
                "name" => "admin",
                "guard_name" => "web"
            ],
            [
                "name" => "seller",
                "guard_name" => "web"
            ],
            [
                "name" => "customer",
                "guard_name" => "web"
            ],
        ]);
    }
}
