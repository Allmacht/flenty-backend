<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IssueTypeSeeder::class);
        $this->call(ProjectTypeSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(PrioritiesSeeder::class);
    }
}
