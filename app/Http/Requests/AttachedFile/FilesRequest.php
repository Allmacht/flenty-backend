<?php

namespace App\Http\Requests\AttachedFile;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UsersPerProject;
use App\Models\Project;
use App\Models\Issue;

class FilesRequest extends FormRequest
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
            'project_id' => 'required|integer|exists:projects,id',
            'issue_id'   => 'required|integer|exists:issues,id',
        ];
    }
}
