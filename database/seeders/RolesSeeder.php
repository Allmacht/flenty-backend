<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ 'name' => 'super-admin' ]);
        Role::create([ 'name' => 'Administrator' ]);
        Role::create([ 'name' => 'Project-administrator' ]);
        Role::create([ 'name' => 'Agent' ]);
        Role::create([ 'name' => 'Customers' ]);
        Role::create([ 'name' => 'Collaborator' ]);
    }
}
