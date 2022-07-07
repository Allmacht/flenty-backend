<?php

namespace App\Http\Requests\AttachedFile;

use App\Models\AttachedFile;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Project;
use App\Models\Issue;
use App\Models\UsersPerProject;

class DeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function prepareForValidation()
    {
        $project = Project::whereUuid($this->route()->uuid)->first();
        $issue   = Issue::whereProjectId($project->id)->where('key', $this->route()->issue)->first();

        if(null !== $project && null !== $issue){
            
            $this->merge([
                'project_id' => $project->id,
                'issue_id'   => $issue->id,
                'file'       => $this->route()->file,
            ]);

        }

    }

    public function authorize()
    {
        $role  = UsersPerProject::with('role')->whereProjectId($this->project_id)->whereUserId($this->user()->id)->first();
        $issue = Issue::whereId($this->issue_id)->first();

        return $role->role->name === 'Project-administrator' || $issue->assignee_id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [ ];
    }
}
