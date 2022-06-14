<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\User;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            "name"    => "Posco San Luis",
            "slug"    => "posco-san-luis",
            "address" => "Carrusel 1 Poniente 106 Lote 4 Zona Industrial",
            "city"    => "San Luis Potosí",
            "state"   => "San Luis Potosí",
            "country" => "México",
            "user_id" => User::first()->value('id')
        ]);
    }
}
