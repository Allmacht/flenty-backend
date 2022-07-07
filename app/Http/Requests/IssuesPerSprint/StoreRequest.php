<?php

namespace App\Http\Requests\IssuesPerSprint;

use App\Models\Issue;
use App\Models\IssuesPerSprint;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Workflow;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        $project  = Project::whereUuid($this->project)->first();
        $sprint   = Sprint::where('key', $this->sprint)->whereProjectId($project->id)->first();
        $issue    = Issue::where('key', $this->issue)->whereProjectId($project->id)->first();
        $workflow = Workflow::whereSprintId($sprint->id)->whereInitialWorkflow(true)->first();

        if(null !== $project && null !== $sprint && null !== $issue && null !== $workflow)
        {
            $this->merge([
                'project_id'  => $project->id,
                'owner_id'    => $project->owner_id,
                'sprint_id'   => $sprint->id,
                'issue_id'    => $issue->id,
                'workflow_id' => $workflow->id,
            ]);
        }
    }

    public function authorize()
    {
        return $this->owner_id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_id'  => 'required|numeric',
            'owner_id'    => 'required|numeric',
            'sprint_id'   => 'required|numeric',
            'issue_id'    => 'required|numeric',
            'workflow_id' => 'required|numeric'
        ];
    }
}
