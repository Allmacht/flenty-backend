<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            "name"          => "Cliente uno",
            "business_name" => "Cliente uno S.A. de C.V.",
            "slug"          => "cliente-uno",
            "email"         => "clienteuno@clienteuno.com",
            "phone"         => "0000000000",
            "company_id"    => Company::first()->value('id')

        ]);
    }
}
