<?php

namespace App\Http\Requests\IssuesPerSprint;

use App\Models\Issue;
use App\Models\Project;
use App\Models\Sprint;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        $project = Project::whereUuid($this->route()->project)->first();
        $sprint  = Sprint::whereProjectId($project->id)->where('key', $this->route()->sprint)->first();
        $issue   = Issue::whereProjectId($project->id)->where('key', $this->route()->issue)->first();

        if(null !== $project && null !== $sprint && null !== $issue)
        {
            $this->merge([
                'project_id'  => $project->id,
                'sprint_id'   => $sprint->id,
                'issue_id'    => $issue->id,
                'assignee_id' => $issue->assignee_id,
                'owner_id'    => $project->owner_id,
                'reporter_id' => $issue->reporter_id,
            ]);
        }
    }

    public function authorize()
    {
        $usr = $this->user()->id;
        return $usr === $this->assignee_id || $usr === $this->owner_id || $usr === $this->reporter_id;
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
            'sprint_id'   => 'required|numeric',
            'issue_id'    => 'required|numeric',
            'assignee_id' => 'required|numeric',
            'owner_id'    => 'required|numeric',
            'reporter_id' => 'required|numeric',
            'workflow'    => 'required|numeric|exists:workflows,id'
        ];
    }
}
