<?php

namespace App\Http\Requests\IssuesPerSprint;

use App\Models\Project;
use App\Models\Sprint;
use App\Models\UsersPerProject;
use Illuminate\Foundation\Http\FormRequest;

class IssuesRequest extends FormRequest
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

        if(null !== $project && null !== $sprint)
        {
            $this->merge([
                'project_id' => $project->id,
                'sprint_id'  => $sprint->id,
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
            'sprint_id'  => 'required|numeric',
        ];
    }
}
