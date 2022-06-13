<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectType::create(['name' => 'Business Project', 'description' => 'Realice un seguimiento, coordine y gestione el trabajo con estructura y coherencia.']);
        ProjectType::create(['name' => 'Software Project', 'description' => 'Planifique, rastree y lance software excelente.']);
        ProjectType::create(['name' => 'Service Project',  'description' => 'Ofrezca excelentes experiencias de servicio rápidamente.']);
    }
}
