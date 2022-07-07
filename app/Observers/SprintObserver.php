<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Sprint;
use App\Models\Workflow;
use Exception;
use PhpParser\Node\Stmt\Foreach_;

class SprintObserver
{
    /**
     * Handle the Sprint "created" event.
     *
     * @param  \App\Models\Sprint  $sprint
     * @return void
     */
    public function created(Sprint $sprint)
    {
        $project   = Project::whereId($sprint->project_id)->first();

        $workflows = [
            array(
                'name'             => 'POR HACER',
                'description'      => 'Tareas pendientes dentro del Sprint.',
                'initial_workflow' => true,
            ),

            array(
                'name'             => 'EN CURSO',
                'description'      => 'Tareas iniciadas, pendientes de finalización.',
                'initial_workflow' => false,
            ),

            array(
                'name'             => 'EN REVISIÓN',
                'description'      => 'Tareas finalizadas, pendientes de revisión.',
                'initial_workflow' => false,
            ),

            array(
                'name'             => 'FINALIZADO',
                'description'      => 'Tareas finalizadas y revisadas.',
                'initial_workflow' => false,
                'final_workflow'   => true,
            )
        ];

        try{

            foreach ($workflows as $workflow) {
    
                $workflow_create                   = new Workflow();
                $workflow_create->name             = $workflow['name'];
                $workflow_create->description      = $workflow['description'];
                $workflow_create->user_id          = $project->owner_id;
                $workflow_create->sprint_id        = $sprint->id;
                $workflow_create->initial_workflow = $workflow['initial_workflow'];
                $workflow_create->final_workflow   = $workflow['final_workflow'] ?? false;
    
                $workflow_create->save();
            }
        }

        catch(Exception $err){

            $sprint->delete();
            
        }


    }

    /**
     * Handle the Sprint "updated" event.
     *
     * @param  \App\Models\Sprint  $sprint
     * @return void
     */
    public function updated(Sprint $sprint)
    {
        //
    }

    /**
     * Handle the Sprint "deleted" event.
     *
     * @param  \App\Models\Sprint  $sprint
     * @return void
     */
    public function deleted(Sprint $sprint)
    {
        //
    }

    /**
     * Handle the Sprint "restored" event.
     *
     * @param  \App\Models\Sprint  $sprint
     * @return void
     */
    public function restored(Sprint $sprint)
    {
        //
    }

    /**
     * Handle the Sprint "force deleted" event.
     *
     * @param  \App\Models\Sprint  $sprint
     * @return void
     */
    public function forceDeleted(Sprint $sprint)
    {
        //
    }
}
