<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\UsersPerProject;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class ProjectObserver
{

    public function creating(Project $project)
    {
        $project->uuid = Str::orderedUuid()->toString();
        $project->slug = Str::slug($project->name);

        if(Carbon::parse($project->initial_date)->greaterThan(today())):
            $project->status = 'CREATED';
        endif;
    }

    /**
     * Handle the Project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $role = Role::whereName('Project-administrator')->first();

        UsersPerProject::create([
            'project_id' => $project->id,
            'user_id'    => $project->owner_id,
            'role_id'    => $role->id
        ]);
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
