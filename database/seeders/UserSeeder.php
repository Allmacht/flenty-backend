<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'folio' => strtoupper('USR-'),
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => 'admin'
            ]
        )->assignRole('super-admin');

        User::create(
            [
                'folio' => strtoupper('USR-'),
                'name' => 'Ulises Jacob Calva Robledo',
                'email' => 'ulises.jacob.cr@gmail.com',
                'password' => 'admin'
            ]
        )->assignRole('Project-administrator');
    }
}
