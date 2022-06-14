<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Line;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Line::create([
            "name"        => "Linea 1",
            "description" => "descripción de linea 1",
            "company_id"  => Company::first()->value('id')
        ]);
    }
}
