<?php

namespace App\Http\Requests\IssuesPerSprint;

use App\Models\{Project, Issue, UsersPerProject};
use Illuminate\Foundation\Http\FormRequest;

class IssueSprintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        $project = Project::whereUuid($this->route()->uuid)->first();
        $issue   = Issue::where('key', $this->route()->issue)->whereProjectId($project->id)->first();

        if(null !== $project && null !== $issue)
        {
            $this->merge([
                'project_id' => $project->id,
                'issue_id'   => $issue->id
            ]);
        }
    }

    public function authorize()
    {
       return UsersPerProject::whereProjectId($this->project_id)->whereUserId($this->user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_id' => 'required|numeric',
            'issue_id'   => 'required|numeric'
        ];
    }
}
