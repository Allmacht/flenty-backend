<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priority::create(['name' => 'Muy alta', 'image' => '/images/priorities/highest.svg']);
        Priority::create(['name' => 'Alta',     'image' => '/images/priorities/high.svg']);
        Priority::create(['name' => 'Media',    'image' => '/images/priorities/medium.svg']);
        Priority::create(['name' => 'Baja',     'image' => '/images/priorities/low.svg']);
        Priority::create(['name' => 'Muy baja', 'image' => '/images/priorities/lowest.svg']);
    }
}
