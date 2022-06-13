<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IssueType;

class IssueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IssueType::create(['name' => 'Epic',     'image' => '/images/issue_types/epic.svg',    'description' => 'Una gran historia de usuario que necesita ser desglosada. Las épicas agrupan errores, historias y tareas para mostrar el progreso de una iniciativa más grande.']);
        IssueType::create(['name' => 'Story',    'image' => '/images/issue_types/story.svg',   'description' => 'Una Story de usuario es la unidad de trabajo más pequeña que debe realizarse.']);
        IssueType::create(['name' => 'Bug',      'image' => '/images/issue_types/bug.svg',     'description' => 'Un Bug es un problema que perjudica o impide las funciones de un producto.']);
        IssueType::create(['name' => 'Task',     'image' => '/images/issue_types/task.svg',    'description' => 'Una Task representa el trabajo que debe hacerse.']);
        IssueType::create(['name' => 'Sub-task', 'image' => '/images/issue_types/subtask.svg', 'description' => 'Una Sub-task es un trabajo que se requiere para completar una tarea.']);
    }
}
